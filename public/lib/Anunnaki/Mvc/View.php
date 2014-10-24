<?php
/**
 * View class
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
 * @package		Anunnaki\Mvc
 */

namespace Anunnaki\Mvc;

use Anunnaki\Core\Config;
use Anunnaki\Mvc\Controller\Data;
use Anunnaki\Loader\AutoLoader;

/**
 * View is a class responsible to controll 
 * the view of the application
 *
 * @package		Anunnaki\Core
 * @author		Andre Naves
 */
class View
{
	/**
	 * Holds the data of the controller
	 *
	 * @var		Data
	 * @see		Anunnaki\Mvc\Controller\Data
	 * @access	protected
	 */
	protected $data;
	
	/**
	 * Holds the configuration of the application
	 * 
	 * @var		Config
	 * @see		Anunnaki\Core\Config
	 * @access	protected
	 */
	protected $config;
	
	/**
	 * Holds the instance of the AutoLoader
	 *
	 * @var		View
	 * @see		Anunnaki\Loader\AutoLoader
	 * @access	protected
	 */
	protected $autoLoader;
	
	/**
	 * Whether or not to render the view
	 * 
	 * @var		boolean
	 * @access	private
	 */
	private $renderView = true;
	
	/**
	 * Whether or not to render the layout
	 * 
	 * @var		boolean
	 * @access	private
	 */
	private $renderLayout = true;
	
	/**
	 * The constructor
	 * 
	 * @param	Data $data
	 * @param	Config $config
	 * @access	public
	 */
	public function __construct(Data $data, Config $config, AutoLoader $autoLoader)
	{
		$this->data       = $data;
		$this->config     = $config;
		$this->autoLoader = $autoLoader;
	}
	
	/**
	 * Says it will render the view
	 * 
	 * @access	public
	 */
	public function setRenderView()
	{
		$this->renderView = true;
	}
	
	/**
	 * Says it will not render the view
	 * 
	 * @access	public
	 */
	public function setNoRenderView()
	{
		$this->renderView = false;
	}
	
	/**
	 * Says it will render the layout
	 * 
	 * @access	public
	 */
	public function setRenderLayout()
	{
		$this->renderLayout = true;
	}
	
	/**
	 * Says it will not render the layout
	 * 
	 * @access	public
	 */
	public function setNoRenderLayout()
	{
		$this->renderLayout = false;
	}
	
	/**
	 * This method render the view file
	 * for this module/controller/action
	 * 
	 * @access	public
	 * @throws	\Exception
	 */
	public function renderView()
	{
		// Check if the view will be rendered
		if ($this->renderView) {
			$appPath        = $this->autoLoader->getPath(APP_DIR);
			$moduleName     = $this->data->getModule();
			$controllerName = $this->data->getController();
			$actionName     = $this->data->getAction();
			
			// Creating the path to the view file
			$fileName  = $appPath . DS . $this->config->getModulesDir() . DS;
			$fileName .= $moduleName . DS . $this->config->getViewsDir() . DS;
			$fileName .= $this->config->getScriptsDir() . DS . $controllerName . DS;
			$fileName .= $actionName . $this->config->getLayoutFileExtension();
			
			// If file exists include it
			if (file_exists($fileName)) {
				require_once $fileName;
			} else {
				throw new \Exception('The view file \'' . $fileName . '\' was not found', 1007);
			}
		}
	}
}