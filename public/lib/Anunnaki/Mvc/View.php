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
use Anunnaki\Helper\Data as HelperData;
use Anunnaki\Mvc\Controller\Data;
use Anunnaki\Loader\AutoLoader;
use Anunnaki\Helper\Tag\Tag;
use Anunnaki\Helper\Component\Component;
use Anunnaki\Helper\Form\Form;

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
	 * Holds the tag helper
	 * 
	 * @var		Tag
	 * @access	public
	 */
	public $tag;
	
	/**
	 * Holds the Component tag
	 * 
	 * @var		Component
	 * @access	public
	 */
	public $component;
	
	/**
	 * Holds the forms tag
	 * 
	 * @var		Form
	 * @access	public
	 */
	public $form;
	
	/**
	 * The constructor
	 * 
	 * @param	HelperData $helperData
	 * @param	Data $data
	 * @param	Config $config
	 * @access	public
	 */
	public function __construct(HelperData $helperData, Data $data, Config $config, AutoLoader $autoLoader)
	{
		$this->data       = $data;
		$this->config     = $config;
		$this->autoLoader = $autoLoader;
		$this->tag        = new Tag($this->config, $helperData);
		$this->component  = new Component($this->config, $helperData);
		$this->form       = new Form($this->config, $helperData);
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
	
	/**
	 * This method render the layout file
	 * for this the specified path
	 *
	 * @access	public
	 * @throws	\Exception
	 */
	public function renderLayout()
	{
		// Check if the layout will be rendered
		if($this->renderLayout) {
			$layoutFile  = $this->autoLoader->getPath(APP_DIR) . DS;
			$layoutFile .= $this->config->getLayoutFile();
			
			// Check if the system will load one file for each module
			if (preg_match('/\[module\]/', $this->config->getLayoutFile())) {
				$path  = $this->autoLoader->getPath(APP_DIR) . DS;
				$path .= $this->config->getModulesDir() . DS;
				
				$layoutFile = '';
				
				// Read the modules directory
				$modules = dir($path);
				while($module = $modules->read()){
					// Loads the layout for this module
					if ($module === $this->data->getModule()) {
						$layoutFile  = $this->autoLoader->getPath(APP_DIR) . DS;
						$layoutFile .= str_replace('[module]', $module, $this->config->getLayoutFile());
					}
				}
			}
			
			// Check if this layout file exists
			if(file_exists($layoutFile)) {
				// Require the layout file
				require_once $layoutFile;
			} else {
				throw new \Exception('The layout file \'' . $layoutFile . '\' was not found', 1011);
			}
		} else {
			// if the system will not load the layout file it try to render the view
			$this->renderView();
		}
	}
	
	public function render($file)
	{
		$fileToLoad  = $this->autoLoader->getPath(APP_DIR) . DS;
		$fileToLoad .= $this->config->getModulesDir() . DS;
		$fileToLoad .= $this->data->getModule() . DS;
		$fileToLoad .= $this->config->getViewsDir(). DS;
		
		$load[0] = $fileToLoad . $this->config->getLayoutDir() . DS . 
			$file . $this->config->getLayoutFileExtension();
		$load[1] = $fileToLoad . $this->config->getScriptsDir() . DS . 
			$file . $this->config->getLayoutFileExtension();
		
		foreach ($load as $value) {
			if (file_exists($value)) {
				require_once $value;
				return;
			}
		}
		
		$msg = $load[0]. '\' nor \'' . $load[1];
		throw new \Exception('The file \'' . $msg . '\' was not found', 1012);
	}
}