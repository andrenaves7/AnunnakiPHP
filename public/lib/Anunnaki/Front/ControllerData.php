<?php

namespace Anunnaki\Front;

class ControllerData
{
	private static $instance;
	
	private $module = null;
	
	private $controller = null;
	
	private $action = null;
	
	private $controllerClass = null;
	
	private $actionMethod = null;
	
	private $params = array();
	
	private function __construct()
	{
	
	}
	
	public static function getInstance()
	{
		if (!isset(self::$instance)) {
			$oClass         = __CLASS__;
			self::$instance = new $oClass;
		}
	
		return self::$instance;
	}
	
	public function __clone()
	{
		throw new Exception('You can not clone this class');
	}
	
	public function setModule($module)
	{
		$this->module = $module;
	}
	
	public function setController($controller)
	{
		$this->controller = $controller;
	}
	
	public function setAction($action)
	{
		$this->action = $action;
	}
	
	public function setControllerClass($controllerClass)
	{
		$this->controllerClass = $controllerClass;
	}
	
	public function setActionMethod($actionMethod)
	{
		$this->actionMethod = $actionMethod;
	}
	
	public function setParams(array $params)
	{
		$this->params = $params;
	}
	
	public function getModule()
	{
		return $this->module;
	}
	
	public function getController()
	{
		return $this->controller;
	}
	
	public function getAction()
	{
		return $this->action;
	}
	
	public function getControllerClass()
	{
		return $this->controllerClass;
	}
	
	public function getActionMethod()
	{
		return $this->actionMethod;
	}
	
	public function getParams()
	{
		return $this->params;
	}
}