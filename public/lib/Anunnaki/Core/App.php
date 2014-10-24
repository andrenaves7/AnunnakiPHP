<?php
/**
 * App class
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
use Environment\Bootstrap;
use Anunnaki\Loader\AutoLoader;

/**
 * App is a class responsiple to start all the application
 * receiving the Data and the configuration of the system
 *
 * @package		Anunnaki\Core
 * @author		Andre Naves
 */
class App
{
	/**
	 * Holds the data of the controller
	 * 
	 * @var		Data
	 * @see		Anunnaki\Mvc\Controller\Data
	 * @access	private
	 */
	private $data;
	
	/**
	 * Holds the configuration of the application
	 * 
	 * @var		Config
	 * @see		Anunnaki\Core\Config;
	 * @access	private
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
	 * The constructor
	 * 
	 * @param	Data $data
	 * @param	Config $config
	 * @see		Anunnaki\Mvc\Controller\Data
	 * @see		Anunnaki\Core\Config
	 * @access	public
	 */
	public function __construct(Data $data, Config $config, AutoLoader $autoLoader)
	{
		$this->config     = $config;
		$this->data       = $data;
		$this->autoLoader = $autoLoader;
	}
	
	public function run()
	{
		// Start the bootstrap
		new Bootstrap($this->data, $this->config);
		
		$controllerClass = $this->data->getControllerClass();
		$actionMethod    = $this->data->getActionMethod();
		$params          = $this->data->getParams();
		
		// Verify the existence of the controller file
		if (!$this->autoLoader->fileExists(APP_DIR, $controllerClass)) {
			$message  = 'The controller \'';
			$message .= str_replace(SEPARATOR, DS, $controllerClass) . $this->config->getClassExtension();
			$message .= '\' was not found';
			throw new \Exception($message, 1004);
		}
		
		// Verify the existence of the controller class
		if (!class_exists($controllerClass)) {
			throw new \Exception('The controller class \'' . $controllerClass . '\' was not found', 1005);
		}
		
		// Start the controller
		$controller = new $controllerClass($this->data, $this->config, $this->autoLoader);
		
		// Verify if the action exists
		if (!method_exists($controller, $actionMethod)) {
			throw new \Exception('The action \'' . $actionMethod . '\' was not found', 1006);
		}
		
		call_user_func_array(array($controller, $actionMethod), $params);
		$controller->getView()->renderView();
	}
}