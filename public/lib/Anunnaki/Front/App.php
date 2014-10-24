<?php

namespace Anunnaki\Front;

use Anunnaki\Config\Configuration;
use Anunnaki\Loader\AutoLoader;

class App
{
	const PT_BR = 'PT_BR';
	
	const EN_US = 'EN_US';
	
	const SEP = '\\';
	
	private static $instance;
	
	private $delimiters = array('-', '.', '_');
	
	private $configuration;
	
	private function __construct()
	{
		session_start();
		
		$this->configuration = Configuration::getInstance();
		
		date_default_timezone_set($this->configuration->timeZone);
	}
	
	public static function getInstance()
	{
		if (!is_object(self::$instance)) {
			$class          = __CLASS__;
			self::$instance = new $class();
		}
		
		return self::$instance;
	}
	
	public function __clone()
	{
		throw new FrontException('This is not a cloneable class', 1000);
	}
	
	public function run()
	{
		$url = explode('/', $this->prepareURL());
	
		if (isset($url[0]) && $url[0] && $this->isModule($url[0])) {
			$module     = isset($url[0]) && $url[0]? $url[0]: 'def';
			$controller = isset($url[1]) && $url[1]? $url[1]: 'index';
			$action     = isset($url[2]) && $url[2]? $url[2]: 'index';
				
			unset($url[0], $url[1], $url[2]);
		} else {
			$module     = 'def';
			$controller = isset($url[0]) && $url[0]? $url[0]: 'index';
			$action     = isset($url[1]) && $url[1]? $url[1]: 'index';
				
			unset($url[0], $url[1]);
		}
	
		$params = $url;
		
		$module          = $this->prepareModule($module);
		$controllerClass = $this->prepareController($module, $controller);
		$actionMethod    = $this->prepareAction($action);
		$params          = $this->prepareParams($params);
	
		$controllerData = ControllerData::getInstance();
		$controllerData->setModule($module);
		$controllerData->setController($controller);
		$controllerData->setAction($action);
		$controllerData->setControllerClass($controllerClass);
		$controllerData->setActionMethod($actionMethod);
		$controllerData->setParams($params);
		
		new Bootstrap($controllerData, $this->configuration);
		$this->startController($controllerData);
	}
	
	private function prepareURL()
	{
		$uri  = explode('/', $_SERVER['REQUEST_URI']);
		$root = explode('/', $this->configuration->root);
	
		for ($i = 0; $i < count($root); $i++) {
			if ($root[$i] == $uri[$i]) {
				unset($uri[$i]);
			}
		}
	
		return implode('/', $uri);
	}
	
	private function isModule($moduleName)
	{
		$moduleName = $this->prepareModule($moduleName);
		
		$dirName = APP . 'Modules/' . $moduleName;
		
		if (is_dir($dirName)) {
			return true;
		} else {
			return false;
		}
	}
	
	private function prepareModule($module)
	{
		$module = explode(
				$this->delimiters[0],
				str_replace($this->delimiters, $this->delimiters[0], $module));
		
		foreach ($module as $key => $value) {
			$module[$key] = ucfirst($value);
		}
		
		return implode('', $module);
	}
	
	private function prepareController($module, $controller)
	{
		$controller = explode(
				$this->delimiters[0],
				str_replace($this->delimiters, $this->delimiters[0], $controller));
	
		foreach ($controller as $key => $value) {
			$controller[$key] = ucfirst($value);
		}
		
		$controllerClass  = 'Modules' . self::SEP;
		$controllerClass .= ucfirst(strtolower($module)) . self::SEP;
		$controllerClass .= 'Controllers' . self::SEP; 
		$controllerClass .= implode('', $controller) . 'Controller';
		
		return $controllerClass;
	}
	
	private function prepareAction($action)
	{
		$action = explode(
				$this->delimiters[0], 
				str_replace($this->delimiters, $this->delimiters[0], $action));
	
		foreach ($action as $key => $value) {
			$action[$key] = ucfirst($value);
		}
	
		return lcfirst(implode('', $action)) . 'Action';
	}
	
	private function prepareParams(array $params)
	{
		$return = array();
		foreach ($params as $value) {
			if (!empty($value)) {
				if ($value != '_null_') {
					$return[] = $value;
				} else {
					$return[] = null;
				}
			}
		}
		
		return $return;
	}
	
	private function startController(ControllerData $controllerData)
	{
		$controllerClass = $controllerData->getControllerClass();
		$actionMethod    = $controllerData->getActionMethod();
		$params          = $controllerData->getParams();
		
		$autoLoader = AutoLoader::getInstance();
		if (!$autoLoader->fileExists(APP, $controllerClass)) {
			throw new FrontException('The controller file \'' . $controllerClass . '\' was not found', 1004);
		}
		
		if (!class_exists($controllerClass)) {
			throw new FrontException('The controller class \'' . $controllerClass . '\' was not found', 1005);
		}
		
		$controller = new $controllerClass();
		$controller->setData($controllerData);
		$controller->setConfig($this->configuration);
		$controller->startViewController();
		$controller->init();
		
		if (!method_exists($controller, $actionMethod)) {
			throw new FrontException('The action \'' . $actionMethod . '\' was not found', 1006);
		}
		
		call_user_func_array(array($controller, $actionMethod), $params);
		$controller->view->renderView();
	}
}