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
 * @package    Anunnaki_Bootstrap
 * @license    New BSD License
 * @version    19-10-2014 12:27
 */

/**
 * Class of bootstrap
 *
 * @category Anunnaki
 * @package  Anunnaki_Bootstrap
 * @author   Andre Naves
 * @see      Anunnaki_Bootstrap_Interface
 */
class Anunnaki_Bootstrap
{
	/**
	 * Instance of the class Anunnaki_Controller_Data
	 * 
	 * @var    Anunnaki_Controller_Data
	 * @see    Anunnaki_Controller_Data
	 * @access protected
	 */
	protected $controllerData;
	
	/**
	 * Instance of the class Anunnaki_Config
	 *
	 * @var    Anunnaki_Config
	 * @see    Anunnaki_Config
	 * @access protected
	 */
	protected $config;
	
	/**
	 * Instance of the class Anunnaki_Message
	 *
	 * @var    Anunnaki_Message
	 * @see    Anunnaki_Message
	 * @access protected
	 */
	protected $message;
	
	/**
	 * The constructor
	 * 
	 * @param  Anunnaki_Controller_Data $controllerData
	 * @param  Anunnaki_Config $config
	 * @param  Anunnaki_Message $message
	 * @access public
	 */
	public function __construct(Anunnaki_Controller_Data $controllerData, Anunnaki_Config $config, Anunnaki_Message $message)
	{
		$this->controllerData = $controllerData;
		$this->config         = $config;
		$this->message        = $message;
		
		$this->init();
	}
	
	/**
	 * The first method to runn
	 * 
	 * @access protected
	 */
	protected function init()
	{
		
	}
}