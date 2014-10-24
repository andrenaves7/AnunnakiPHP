<?php
/**
 * Controller class
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

use Anunnaki\Mvc\Controller\Data;
use Anunnaki\Core\Config;
use Anunnaki\Loader\AutoLoader;

/**
 * App is a class responsiple to start all the application
 * receiving the Data and the configuration of the system
 *
 * @package		Anunnaki\Core
 * @author		Andre Naves
 */
class Controller
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
	 * Holds the view of the application
	 * 
	 * @var		View
	 * @see		Anunnaki\Mvc\View
	 * @access	protected
	 */
	protected $view;
	
	/**
	 * Holds the instance of the AutoLoader
	 *
	 * @var		View
	 * @see		Anunnaki\Loader\AutoLoader
	 * @access	private
	 */
	private $autoLoader;
	
	/**
	 * Holds the params of the request
	 * via $_POST
	 * 
	 * @var		array
	 * @access 	protected
	 */
	protected $params;
	
	/**
	 * The constructor
	 * 
	 * @param	Data $data
	 * @param	Config $config
	 * @access	public
	 * @see		Anunnaki\Mvc\Controller\Data
	 * @see		Anunnaki\Core\Config
	 */
	public function __construct(Data $data, Config $config, AutoLoader $autoLoader)
	{
		$this->data       = $data;
		$this->config     = $config;
		$this->autoLoader = $autoLoader;
		$this->view       = new View($this->data, $this->config, $this->autoLoader);
		
		if ($_POST) {
			$this->params = $_POST;
		}
		
		$this->init();
	}
	
	/**
	 *  You can override this method
	 *
	 *  @access		protected
	 *  @override
	 */
	protected function init()
	{
		
	}
	
	/**
	 * Get the view object
	 * 
	 * @return	\Anunnaki\Mvc\View
	 * @access	public
	 */
	public function getView()
	{
		return $this->view;
	}
}