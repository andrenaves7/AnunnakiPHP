<?php
/**
 * Data class
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
 * @package		Anunnaki\Mvc\Controller
 */

namespace Anunnaki\Mvc\Controller;

/**
 * Store the controller class data
 *
 * @package		Anunnaki\Mvc\Controller
 * @author		Andre Naves
 */
class Data
{
	/**
	 * The name of the module
	 * 
	 * @var		string
	 * @access	private
	 */
	private $module = null;
	
	/**
	 * The name of the controller
	 *
	 * @var		string
	 * @access	private
	 */
	private $controller = null;
	
	/**
	 * The name of the action
	 *
	 * @var		string
	 * @access	private
	 */
	private $action = null;
	
	/**
	 * The name of the controller class
	 *
	 * @var		string
	 * @access	private
	 */
	private $controllerClass = null;
	
	/**
	 * The name of the action method
	 *
	 * @var		string
	 * @access	private
	 */
	private $actionMethod = null;
	
	/**
	 * Holds the params sent via URL
	 * 
	 * @var	array
	 */
	private $params = array();
	
	/**
	 * Set the module value
	 * 
	 * @param	string $module
	 * @access	public
	 */
	public function setModule($module)
	{
		$this->module = $module;
	}
	
	/**
	 * Set the module controller
	 *
	 * @param	string $controller
	 * @access	public
	 */
	public function setController($controller)
	{
		$this->controller = $controller;
	}
	
	/**
	 * Set the action value
	 *
	 * @param	string $action
	 * @access	public
	 */
	public function setAction($action)
	{
		$this->action = $action;
	}
	
	/**
	 * Set the controller class value
	 *
	 * @param	string $controllerClass
	 * @access	public
	 */
	public function setControllerClass($controllerClass)
	{
		$this->controllerClass = $controllerClass;
	}
	
	/**
	 * Set the action method value
	 *
	 * @param	string $actionMethod
	 * @access	public
	 */
	public function setActionMethod($actionMethod)
	{
		$this->actionMethod = $actionMethod;
	}
	
	/**
	 * Set the params
	 *
	 * @param	string $params
	 * @access	public
	 */
	public function setParams(array $params)
	{
		$this->params = $params;
	}
	
	/**
	 * Get the module
	 * 
	 * @access	public
	 * @return	string
	 */
	public function getModule()
	{
		return $this->module;
	}
	
	/**
	 * Get the Controller
	 *
	 * @access	public
	 * @return	string
	 */
	public function getController()
	{
		return $this->controller;
	}
	
	/**
	 * Get the action
	 *
	 * @access	public
	 * @return	string
	 */
	public function getAction()
	{
		return $this->action;
	}
	
	/**
	 * Get the controller class
	 *
	 * @access	public
	 * @return	string
	 */
	public function getControllerClass()
	{
		return $this->controllerClass;
	}
	
	/**
	 * Get the action method
	 *
	 * @access	public
	 * @return	string
	 */
	public function getActionMethod()
	{
		return $this->actionMethod;
	}
	
	/**
	 * Get the params
	 *
	 * @access	public
	 * @return	array
	 */
	public function getParams()
	{
		return $this->params;
	}
}