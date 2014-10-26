<?php
/**
 * Helper class
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
 * @package		Anunnaki\Helper
 */

namespace Anunnaki\Helper;

use Anunnaki\Core\Config;

/**
 * This class is responsible call a helper
 *
 * @package		Anunnaki\Helper
 * @author		Andre Naves
 * @abstract
 */
abstract class Helper
{
	/**
	 * Holds the request values
	 * 
	 * @var		Data
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
	 * Holds the name of the class
	 * 
	 * @var		string
	 * @access	protected
	 */
	protected $className;
	
	/**
	 * The constructor
	 * 
	 * @param	Data $helperData
	 * @param	Config $config
	 * @access	public
	 */
	public function __construct(Config $config, Data $helperData)
	{
		$this->config = $config;
		$this->data   = $helperData;
		$this->mountClass();
	}
	
	/**
	 * Must be override
	 * 
	 * @access		protected
	 * @override
	 */
	protected function init()
	{
		// Must be rewritten
	}
	
	/**
	 * Mounts a class
	 * 
	 * @throws		\Exception
	 * @override
	 */
	protected function mountClass()
	{
		throw new \Exception('You must override the method \'Anunnaki\Helper\Action::mountClass()\'', 1009);
	}
	
	/**
	 * The magic mathod responsible to call a helper
	 *
	 * @param	unknown $method
	 * @param	unknown $args
	 * @throws	\Exception
	 * @return	mixed|boolean
	 * @access	public
	 */
	public function __call($method, $args)
	{
		$class     = $this->className . ucfirst($method);
		$component = new $class($this->config, $this->data);
		if (method_exists($component, $method)) {
			return call_user_func_array(array($component, $method), $args);
		} else {
			throw new \Exception('The method \'' . $method . '\' of helper \'' . $class . '\' was not found', 1017);
		}
	
		return false;
	}
}