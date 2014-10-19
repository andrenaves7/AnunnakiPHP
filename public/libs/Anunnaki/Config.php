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
 * @package    Anunnaki_Config
 * @license    New BSD License
 * @version    18-10-2014 10:16
 */

/**
 * Class of configurations
 * 
 * @category Anunnaki
 * @package  Anunnaki_Config
 * @author   Andre Naves
 * @see      Config
 */
class Anunnaki_Config extends Config
{
	/**
	 * Instance of this class
	 * 
	 * @var    Anunnaki_Config
	 * @access private
	 * @static
	 */
	private static $instance;
	
	/**
	 * Instance of the class Anunnaki_Message
	 * 
	 * @var    Anunnaki_Message
	 * @see    Anunnaki_Message
	 * @access private
	 */
	private $message;
	
	/**
	 * The constructor
	 * 
	 * @access private
	 */
	private function __construct()
	{
		$this->message = Anunnaki_Message::getInstance($this);
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
		if (!is_object(self::$instance)) {
			$class          = __CLASS__;
			self::$instance = new $class();
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
		throw new Exception($this->message->getMessage('not_cloneable'), 1000);
	}
}