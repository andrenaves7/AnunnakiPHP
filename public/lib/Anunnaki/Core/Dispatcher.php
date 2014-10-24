<?php
/**
 * Dispatcher class
 * 
 * AnunnakiPHP: A simple framework for all kind of projects (https://anunnakiphp.wordpress.com)
 * Copyright (c) Anunnaki software foundation. (https://anunnakiphp.wordpress.com)
 * 
 * Licensed under the MIT license
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 * 
 * @copyright	Copyright (c) Anunnaki software foundation. (https://anunnakiphp.wordpress.com)
 * @link		https://anunnakiphp.wordpress.com AnunnakiPHP
 * @since		AnunnakiPHP v 2.1
 * @license		http://www.opensource.org/licenses/mit-license.php MIT License
 * @package		Anunnaki\Core
 */

namespace Anunnaki\Core;

use Anunnaki\Mvc\Controller\Data;
use Anunnaki\Loader\AutoLoader;

/**
 * Dispacher class is responsible for creating the controller data and
 * dispach it to the App class
 * 
 * @package		Anunnaki\Core
 * @author		Andre Naves
 */
class Dispatcher
{
	/**
	 * Holds the instance of the class Config
	 * 
	 * @var 	Config
	 * @access	private
	 * @see		Anunnaki\Core\Config
	 */
	private $config;
	
	/**
	 * Holds the instance of the class AutoLoader
	 * 
	 * @var		AutoLoader
	 * @access	private
	 * @see		Anunnaki\Loader\AutoLoader
	 */
	private $autoLoader;
	
	/**
	 * Holds the delimiters witch you can use in the URL
	 * 
	 * @access	private
	 * @var		array
	 */
	private $delimiters = array('-', '.', '_');
	
	/**
	 * The constructor
	 */
	public function __construct(AutoLoader $autoLoader)
	{
		$this->autoLoader = $autoLoader;
		$this->config     = new Config();
	}
	
	/**
	 * Format the variables of the front controller
	 * 
	 * @access public
	 */
	public function dispatch()
	{
		// Transform the prepared URL in an array
		$url = explode(DS, $this->prepareURL());
		
		if (isset($url[0]) && $url[0] && $this->isModule($url[0])) {
			// If the modules is not the default module the code execute here!
			$module     = isset($url[0]) && $url[0]? $url[0]: $this->config->getMainModule();
			$controller = isset($url[1]) && $url[1]? $url[1]: $this->config->getMainController();
			$action     = isset($url[2]) && $url[2]? $url[2]: $this->config->getMainAction();
			
			// Unset the non used indexes thus whe have the array of the params
			unset($url[0], $url[1], $url[2]);
		} else {
			// If the modules is the default module the code execute here!
			$module     = $this->config->getMainModule();
			$controller = isset($url[0]) && $url[0]? $url[0]: $this->config->getMainController();
			$action     = isset($url[1]) && $url[1]? $url[1]: $this->config->getMainAction();
		
			// Unset the non used indexes thus whe have the array of the params
			unset($url[0], $url[1]);
		}
		
		// Now we have the params in $params
		$params = $url;
		
		// We are preparing the name of the components
		$module          = $this->prepareModule($module);
		$controllerClass = $this->prepareController($module, $controller);
		$actionMethod    = $this->prepareAction($action);
		$params          = $this->prepareParams($params);
		
		// Now we store it all in the Data class
		$data = new Data();
		$data->setModule($module);
		$data->setController($controller);
		$data->setAction($action);
		$data->setControllerClass($controllerClass);
		$data->setActionMethod($actionMethod);
		$data->setParams($params);
		
		try {
			// We call the class App starting the application
			$app = new App($data, $this->config, $this->autoLoader);
			$app->run();
		} catch (\Exception $e) {
			//@TODO: implements the full catch exception
			echo $e->getCode() . ' - ' . $e->getMessage();
		}
	}
	
	/**
	 * Prepare the URL for separate the modules, controllers and actions
	 * 
	 * @return	string
	 * @access	private
	 */
	private function prepareURL()
	{
		$uri  = explode(DS, $_SERVER['REQUEST_URI']);
		$root = explode(DS, $this->config->root);
	
		for ($i = 0; $i < count($root); $i++) {
			if ($root[$i] == $uri[$i]) {
				unset($uri[$i]);
			}
		}
	
		return implode(DS, $uri);
	}
	
	/**
	 * Verify if the param passed is a valid module
	 * 
	 * @param	string $moduleName
	 * @return	boolean
	 * @access	private
	 */
	private function isModule($moduleName)
	{
		$moduleName = $this->prepareModule($moduleName);
		$dirName    = APP_DIR . $this->config->getModulesDir() . DS . $moduleName;
	
		if (is_dir($dirName)) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Prepare the module transforming it in a understandable module name
	 * 
	 * @param	string $module
	 * @return	string
	 * @access	private
	 */
	private function prepareModule($module)
	{
		$module = explode($this->delimiters[0], str_replace($this->delimiters, $this->delimiters[0], $module));
	
		foreach ($module as $key => $value) {
			$module[$key] = ucfirst($value);
		}
	
		return implode('', $module);
	}
	
	/**
	 * Prepare the controller transforming it in a understandable controller name
	 *  
	 * @param	string $module
	 * @param	string $controller
	 * @return	string
	 * @access	private
	 */
	private function prepareController($module, $controller)
	{
		$controller = explode($this->delimiters[0], str_replace($this->delimiters, $this->delimiters[0], $controller));
	
		foreach ($controller as $key => $value) {
			$controller[$key] = ucfirst($value);
		}
	
		$controllerClass  = $this->config->getModulesDir() . SEPARATOR;
		$controllerClass .= ucfirst(strtolower($module)) . SEPARATOR;
		$controllerClass .= $this->config->getControllersDir() . SEPARATOR;
		$controllerClass .= implode('', $controller) . $this->config->getControllerSuffix();
		
		return $controllerClass;
	}
	
	/**
	 * Prepare the action, transforming it in a understandable action name
	 * 
	 * @param	string $action
	 * @return	string
	 * @access	private
	 */
	private function prepareAction($action)
	{
		$action = explode($this->delimiters[0], str_replace($this->delimiters, $this->delimiters[0], $action));
	
		foreach ($action as $key => $value) {
			$action[$key] = ucfirst($value);
		}
	
		return lcfirst(implode('', $action)) . $this->config->getActionsuffix();
	}
	
	/**
	 * Prepare the params to sent to the action called
	 * 
	 * @param	array $params
	 * @return	array
	 * @access	private
	 */
	private function prepareParams(array $params)
	{
		$return = array();
		foreach ($params as $value) {
			if (!empty($value)) {
				if ($value != $this->config->getDefaultNullValue()) {
					$return[] = $value;
				} else {
					$return[] = null;
				}
			}
		}
	
		return $return;
	}
}