<?php
/**
 * Config class
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

use Environment\Config as Configuration;

/**
 * This class is responsible of the configuration of the application
 * 
 * @package		Anunnaki\Core
 * @author		Andre Naves
 */
class Config extends Configuration
{
	/**
	 * Holds the name of the directory where the scripts are placed
	 *
	 * @var 	string
	 * @access 	private
	 */
	private $scriptsDir = 'scripts';
	
	/**
	 * Holds the name of the directory where the views are placed
	 *
	 * @var 	string
	 * @access 	private
	 */
	private $viewDir = 'views';
	
	/**
	 * Holds the name of the directory where the layouts are placed
	 *
	 * @var 	string
	 * @access 	private
	 */
	private $layoutDir = 'layouts';
	
	/**
	 * Holds the name of the directory where the modules are placed
	 * 
	 * @var 	string
	 * @access 	private
	 */
	private $modulesDir = 'Modules';
	
	/**
	 * Holds the name of the directory where the controllers are placed
	 * 
	 * @var		string
	 * @access	private;
	 */
	private $controllersDir = 'Controllers';
	
	/**
	 * Holds the name of the main module
	 * 
	 * @var 	string
	 * @access 	private
	 */
	private $mainModule = 'Def';
	
	/**
	 * Holds the name of the main error module
	 *
	 * @var 	string
	 * @access 	private
	 */
	private $mainErrorModule = 'Def';
	
	/**
	 * Holds the name of the main controller
	 * 
	 * @var 	string
	 * @access 	private
	 */
	private $mainController = 'index';
	
	/**
	 * Holds the name of the main error controller
	 *
	 * @var 	string
	 * @access 	private
	 */
	private $mainErrorController = 'error';
	
	/**
	 * Holds the name of the main action
	 * 
	 * @var		string
	 * @access	private
	 */
	private $mainAction = 'index';
	
	/**
	 * Holds the name of the main error action
	 *
	 * @var		string
	 * @access	private
	 */
	private $mainErrorAction = 'index';
	
	/**
	 * Holds the controller's suffix
	 * 
	 * @var		string
	 * @access	private
	 */
	private $controllerSuffix = 'Controller';
	
	/**
	 * Holds the actions's suffix
	 * 
	 * @var		string
	 * @access	private
	 */
	private $actionSuffix = 'Action';
	
	/**
	 * Holds the default null value
	 * 
	 * @var		string
	 * @access	private
	 */
	private $nullValue = '_null_';
	
	/**
	 * Holds the extension of classes
	 * 
	 * @var		string
	 * @access	private
	 */
	private $classExtension = '.php';
	
	/**
	 * Holds the extension of layout file
	 *
	 * @var		string
	 * @access	private
	 */
	private $layoutFileExtension = '.phtml';
	
	/**
	 * Return the directory of the scripts
	 *
	 * @access public
	 * @return string
	 */
	public function getScriptsDir()
	{
		return $this->scriptsDir;
	}
	
	/**
	 * Return the directory of the views
	 *
	 * @access public
	 * @return string
	 */
	public function getViewsDir()
	{
		return $this->viewDir;
	}
	
	/**
	 * Return the directory of the layouts
	 *
	 * @access public
	 * @return string
	 */
	public function getLayoutDir()
	{
		return $this->layoutDir;
	}
	
	/**
	 * Return the directory of the modules
	 * 
	 * @access public
	 * @return string
	 */
	public function getModulesDir()
	{
		return $this->modulesDir;
	}
	
	/**
	 * Return the directory of the controllers
	 * 
	 * @access	public
	 * @return	string
	 */
	public function getControllersDir()
	{
		return $this->controllersDir;
	}
	
	/**
	 * Return the main module
	 * 
	 * @access public
	 * @return string
	 */
	public function getMainModule()
	{
		return $this->mainModule;
	}
	
	/**
	 * Return the main error module
	 *
	 * @access public
	 * @return string
	 */
	public function getMainErrorModule()
	{
		return $this->mainErrorModule;
	}
	
	/**
	 * Return the main controller
	 * 
	 * @access public
	 * @return string
	 */
	public function getMainController()
	{
		return $this->mainController;
	}
	
	/**
	 * Return the main error controller
	 *
	 * @access public
	 * @return string
	 */
	public function getMainErrorController()
	{
		return $this->mainErrorController;
	}
	
	/**
	 * Return the main action
	 * 
	 * @access public
	 * @return string
	 */
	public function getMainAction()
	{
		return $this->mainAction;
	}
	
	/**
	 * Return the main error action
	 *
	 * @access public
	 * @return string
	 */
	public function getMainErrorAction()
	{
		return $this->mainErrorAction;
	}
	
	/**
	 * Return the suffix of the controller
	 * 
	 * @access public
	 * @return string
	 */
	public function getControllerSuffix()
	{
		return $this->controllerSuffix;
	}
	
	/**
	 * Return the suffix of the action
	 *
	 * @access public
	 * @return string
	 */
	public function getActionsuffix()
	{
		return $this->actionSuffix;
	}
	
	/**
	 * Return the default null value
	 * 
	 * @access public
	 * @return string
	 */
	public function getDefaultNullValue()
	{
		return $this->nullValue;
	}
	
	/**
	 * Return the default class extension
	 * 
	 * @access public
	 * @return string
	 */
	public function getClassExtension()
	{
		return $this->classExtension;
	}
	
	/**
	 * Return the default layout file extension
	 * 
	 * @access public
	 * @return string
	 */
	public function getLayoutFileExtension()
	{
		return $this->layoutFileExtension;
	}
	
	/**
	 * Return the layout file
	 * 
	 * @access public
	 * @return string
	 */
	public function getLayoutFile()
	{
		if (isset($this->layoutFile)) {
			return $this->layoutFile;
		} else {
			throw new \Exception('The param \'Environment' . SEPARATOR . 'Config::layoutFile\' must be defined');
		}
	}
}