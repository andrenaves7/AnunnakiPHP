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
 * @version    18-10-2014 10:20
 */

/**
 * Class of Controller
 *
 * @category Anunnaki
 * @package  Anunnaki_Controller
 * @author   Andre Naves
 */
class Anunnaki_Controller
{
	/**
	 * Instance of the class Anunnaki_Config
	 * 
	 * @var    Anunnaki_Config
	 * @access protected
	 */
	protected $config;
	
	/**
	 * Instance of the class Anunnaki_Controller_Data
	 * 
	 * @var    Anunnaki_Controller_Data
	 * @see    Anunnaki_Controller_Data
	 * @access protected
	 */
	protected $data;
	
	/**
	 * The class of the messages
	 * 
	 * @var    Anunnaki_Message
	 * @see    Anunnaki_Message
	 * @access protected
	 */
	protected $message;
	
	/**
	 * The constructor
	 * 
	 * @access public
	 */
	public function __construct()
	{
		$this->config  = Anunnaki_Config::getInstance();
		$this->message = Anunnaki_Message::getInstance();
	}
	
	/**
	 * Set the data of the controller
	 * 
	 * @param Anunnaki_Controller_Data $data
	 * @see   Anunnaki_Controller_Data
	 */
	public function setData(Anunnaki_Controller_Data $data)
	{
		$this->data = $data;
	}
}