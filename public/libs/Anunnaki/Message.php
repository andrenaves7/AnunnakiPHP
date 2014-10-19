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
 * @package    Anunnaki_Message
 * @license    New BSD License
 * @version    18-10-2014 13:26
 */

/**
 * @category Anunnaki
 * @package  Anunnaki_Message
 * @author   Andre Naves
 */
class Anunnaki_Message
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
	 * Instance of the class Anunnaki_Config
	 * 
	 * @var    Anunnaki_Config
	 * @see    Anunnaki_Config
	 * @access private
	 */
	private $config;
	
	/**
	 * The constructor
	 * 
	 * @param  Anunnaki_Config $config
	 * @access private
	 */
	private function __construct(Anunnaki_Config $config)
	{
		$this->config = $config;
	}
	
	/**
	 * Get instance of 'Anunnaki_Message'
	 * 
	 * @param  Anunnaki_Config $config
	 * @access public
	 * @static
	 */
	public static function getInstance(Anunnaki_Config $config)
	{
		if (!is_object(self::$instance)) {
			$class          = __CLASS__;
			self::$instance = new $class($config);
		}
	
		return self::$instance;
	}
	
	/**
	 * Get message
	 * 
	 * @param  string $key
	 * @param  array  $replace = null
	 * @throws Exception
	 * @return string
	 */
	public function getMessage($key, array $replace = array())
	{
		$file = LANGUAGES . strtolower($this->config->language) . '.php';
		
		if (is_file($file)) {
			require_once $file;
		} else {
			throw new Exception('The language file was not found!');
		}
		
		if (isset($msg[$key])) {
			return $this->replace($msg[$key], $replace);
		} else if (isset($msg['no_message_found'])) {
			return $msg['no_message_found'];
		}
	}
	
	/**
	 * Return the messa with the replaced values
	 * 
	 * @param  string $message
	 * @param  array  $replace
	 * @return string
	 */
	private function replace($message, array $replace = array())
	{
		if (!empty($replace)) {
			$keys   = array_keys($replace);
			$values = array_values($replace);
			
			return str_replace($keys, $values, $message);
		} else {
			return $message;
		}
	}
	
	/**
	 * You can not clone this class
	 *
	 * @access public
	 * @throws Exception
	 */
	public function __clone()
	{
		throw new Exception($this->getMessage('not_cloneable'), 1000);
	}
}