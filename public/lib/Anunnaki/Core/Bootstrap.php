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

/**
 * Bootstrap is responsible to start the bootstrap of the application
 *
 * @package		Anunnaki\Core
 * @author		Andre Naves
 */
class Bootstrap
{
	/**
	 * Holds the controller's data
	 * 
	 * @var		Data
	 * @see		Anunnaki\Core\Data
	 * @access	protected
	 */
	protected $data;
	
	/**
	 * Holds the configuration of the application
	 * 
	 * @var		Congig
	 * @see		Anunnaki\Core\Config
	 * @access	protected
	 */
	protected $config;
	
	/**
	 * The constructor
	 * 
	 * @param	ControllerData $controllerData
	 * @param	Configuration $configuration
	 * @access	public
	 */
	public function __construct(Data $data, Config $config)
	{
		$this->data   = $data;
		$this->config = $config;
	
		$this->init();
	}
	
	/**
	 *  You must override this method
	 *  
	 *  @access	protected
	 *  @override
	 */
	protected function init()
	{
		throw new \Exception('You must override the method \'Anunnaki\Core\Bootstrap::init()\'', 1009);
	}
}