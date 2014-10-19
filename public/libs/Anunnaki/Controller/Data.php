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
 * @version    18-10-2014 13:07
 */

/**
 * Class of Controller
 *
 * @category Anunnaki
 * @package  Anunnaki_Controller
 * @author   Andre Naves
 */
class Anunnaki_Controller_Data
{
	/**
	 * Instance of this class
	 *
	 * @var    Anunnaki_Controller_Data
	 * @see    Anunnaki_Controller_Data
	 * @access private
	 * @static
	 */
	private static $instance;
	
	/**
	 * Module name
	 * 
	 * @var    string
	 * @access private
	 */
	private $module = null;
	
	/**
	 * Controller name
	 * 
	 * @var    string
	 * @access private
	 */
	private $controller = null;
	
	/**
	 * Action name
	 * 
	 * @var    string
	 * @access private
	 */
	private $action = null;
	
	/**
	 * Name of controller class
	 * 
	 * @var    string
	 * @access private
	 */
	private $controllerClass = null;
	
	/**
	 * Name of action method
	 * 
	 * @var    string
	 * @access private
	 */
	private $actionMethod = null;
	
	/**
	 * The constructor
	 * 
	 * @access private
	 */
	private function __construct()
	{
	
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
		if (!isset(self::$instance)) {
			$oClass         = __CLASS__;
			self::$instance = new $oClass;
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
		throw new Exception('You can not clone this class');
	}
	
	/**
	 * Set module name
	 * 
	 * @param  string $module
	 * @access public
	 */
	public function setModule($module)
	{
		$this->module = $module;
	}
	
	/**
	 * Set controller name
	 * 
	 * @param  string $controller
	 * @access public
	 */
	public function setController($controller)
	{
		$this->controller = $controller;
	}
	
	/**
	 * Set action name
	 * 
	 * @param  string $action
	 * @access public
	 */
	public function setAction($action)
	{
		$this->action = $action;
	}
	
	/**
	 * Set the controller class name
	 * 
	 * @param  string $controllerClass
	 * @access public
	 */
	public function setControllerClass($controllerClass)
	{
		$this->controllerClass = $controllerClass;
	}
	
	/**
	 * Set the action method name
	 * 
	 * @param  string $actionMethod
	 * @access public
	 */
	public function setActionMethod($actionMethod)
	{
		$this->actionMethod = $actionMethod;
	}
	
	/**
	 * Return the module name
	 * 
	 * @access public
	 * @return string
	 */
	public function getModule()
	{
		return $this->module;
	}
	
	/**
	 * Return the controller name
	 * 
	 * @access public
	 * @return string
	 */
	public function getController()
	{
		return $this->controller;
	}
	
	/**
	 * Return the action name
	 * 
	 * @access public
	 * @return string
	 */
	public function getAction()
	{
		return $this->action;
	}
	
	/**
	 * Return the controller class
	 * 
	 * @access public
	 * @return string
	 */
	public function getControllerClass()
	{
		return $this->controllerClass;
	}
	
	/**
	 * return the action method
	 * 
	 * @access public
	 * @return string
	 */
	public function getActionMethod()
	{
		return $this->actionMethod;
	}
}