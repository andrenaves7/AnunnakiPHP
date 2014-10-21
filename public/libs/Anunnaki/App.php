<?php
/**
 * Anunnaki PHP 2
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to andrenavesiii@gmail.com so we can send you a copy immediately.
 *
 * @category   Anunnaki
 * @package    Anunnaki_Controller
 * @license    New BSD License
 * @version    18-10-2014 10:16
 */

/**
 * @category Anunnaki
 * @package  Anunnaki_Controller
 * @author   Andre Naves
 */
class Anunnaki_App
{
	/**
	 * Languages
	 */
	const PT_BR = 'PT_BR';
	const EN_US = 'EN_US';
	
	/**
	 * Instance of this class
	 *
	 * @var    Anunnaki_App
	 * @see    Anunnaki_App
	 * @access private
	 * @static
	 */
	private static $instance;
	
	/**
	 * Delimiters to split an string
	 * 
	 * @var    array
	 * @access private
	 */
	private $delimiters = array('-', '.', '_');
	
	/**
	 * Instance of Anunnaki_Message
	 * 
	 * @var    Anunnaki_Message
	 * @access private
	 */
	private $message;
	
	/**
	 * Instance of Anunnaki_Config
	 * 
	 * @var    Anunnaki_Config
	 * @access private
	 */
	private $config;
	
	/**
	 * The constructor
	 *
	 * @access private
	 */
	private function __construct()
	{
		$this->config  = Anunnaki_Config::getInstance();
		$this->message = Anunnaki_Message::getInstance($this->config);
	}
	
	/**
	 * Get instance of 'Anunnaki_Config'
	 *
	 * @return Anunnaki_Config
	 * @access public
	 * @static
	 */
	public static function getInstance()
	{
		if (!is_object(self::$instance)) {
			$class          = __CLASS__;
			self::$instance = new $class();
		}
	
		return self::$instance;
	}
	
	/**
	 * You can not clone this class
	 *
	 * @throws Exception
	 * @access public
	 */
	public function __clone()
	{
		throw new Exception($this->message->getMessage('not_cloneable'), 1000);
	}
	
	/**
	 * The first method to call
	 * 
	 * @access public
	 */
	public function run()
	{
		$url = explode('/', $this->prepareURL());
		
		if (isset($url[0]) && $url[0] && $this->isModule($url[0])) {
			$module     = isset($url[0]) && $url[0]? $url[0]: 'default';
			$controller = isset($url[1]) && $url[1]? $url[1]: 'index';
			$action     = isset($url[2]) && $url[2]? $url[2]: 'index';
			
			unset($url[0], $url[1], $url[2]);
		} else {
			$module     = 'default';
			$controller = isset($url[0]) && $url[0]? $url[0]: 'index';
			$action     = isset($url[1]) && $url[1]? $url[1]: 'index';
			
			unset($url[0], $url[1]);
		}
		
		$params = $url;
		
		$controllerClass = $this->prepareController($module, $controller);
		$actionMethod    = $this->prepareAction($action) . 'Action';
		$params          = $this->prepareParams($params);
		
		$controllerData = Anunnaki_Controller_Data::getInstance();
		$controllerData->setModule($module);
		$controllerData->setController($controller);
		$controllerData->setAction($action);
		$controllerData->setControllerClass($controllerClass);
		$controllerData->setActionMethod($actionMethod);
		$controllerData->setParams($params);
		
		new Bootstrap($controllerData, $this->config, $this->message);
		$this->startController($controllerData);
	}
	
	private function startController(Anunnaki_Controller_Data $controllerData)
	{
		$controllerClass = $controllerData->getControllerClass();
		
		try {
			$controller = new $controllerClass();
			$controller->setData($controllerData);
			$controller->setConfig($this->config);
			$controller->setMessage($this->message);
		} catch (Exception $e) {
			//@TODO: implements
			echo $e->getMessage();
		}
	}
	
	/**
	 * Verify is this is a module
	 * 
	 * @param  string $moduleName
	 * @access private
	 * @return boolean
	 */
	private function isModule($moduleName)
	{
		$dirName = MODULES . $moduleName;
		
		if (is_dir($dirName)) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Prepare the string to make it a class
	 *
	 * @param  string $module
	 * @param  string $controller
	 * @access private
	 * @return string
	 */
	private function prepareController($module, $controller)
	{
		$controller = explode(
				$this->delimiters[0], 
				str_replace($this->delimiters, $this->delimiters[0], $controller));
	
		foreach ($controller as $key => $value) {
			$controller[$key] = ucfirst($value);
		}
	
		$controller  = implode('', $controller);
		$controller .= 'Controller';
		
		return ucfirst(strtolower($module)) . '_' . $controller;
	}
	
	/**
	 * Prepare the string with the action's name and format it
	 *
	 * @param  string $action
	 * @access private
	 * @return string
	 */
	private function prepareAction($action)
	{
		$action = explode(
				$this->delimiters[0], 
				str_replace($this->delimiters, $this->delimiters[0], $action));
	
		foreach ($action as $key => $value) {
			$action[$key] = ucfirst($value);
		}
	
		return lcfirst(implode('', $action));
	}
	
	/**
	 *
	 * Prepara a URL
	 *
	 * @return string
	 * @access private
	 */
	private function prepareURL()
	{
		$uri  = explode('/', $_SERVER['REQUEST_URI']);
		$root = explode('/', $this->config->root);
		
		for ($i = 0; $i < count($root); $i++) {
			if ($root[$i] == $uri[$i]) {
				unset($uri[$i]);
			}
		}
	
		return implode('/', $uri);
	}
	
	/**
	 * Prepare the params from URL
	 *
	 * @param  array
	 * @return array
	 * @access private
	 */
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
}