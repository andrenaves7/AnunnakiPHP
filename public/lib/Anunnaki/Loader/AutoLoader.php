<?php
/**
 * Dispatcher class
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
 * @package		Anunnaki\Loader
 */

namespace Anunnaki\Loader;

/**
 * AutoLoader class is responsible to load all the application classes
 * when it become neened
 *
 * @package		Anunnaki\Loader
 * @author		Andre Naves
 */
class AutoLoader
{
	/**
	 * Holds the locations where the file are placed
	 * 
	 * @var 	array
	 * @access 	private
	 */
	private $loaders = array();
	
	/**
	 * Hold the extensions of the classes
	 * 
	 * @var 	string
	 * @access 	private
	 */
	private $extension = '.php';
	
	/**
	 * Constructor
	 * 
	 * @access 	public
	 */
	public function __construct()
	{
		$this->loaders[APP_DIR] = APP_DIR;
		$this->loaders[LIB_DIR] = LIB_DIR;
		
		spl_autoload_register(array($this, 'loader'));
	}
	
	/**
	 * Loads the class when you use it
	 * 
	 * @param 	string $className
	 * @access 	private
	 */
	private function loader($className)
	{
		foreach ($this->loaders as $value) {
			$fileName  = $value . DS . str_replace(SEPARATOR, DS, $className) . $this->extension;
			if (is_file($fileName)) {
				require_once $fileName;
			}
		}
	}
	
	/**
	 * Add a new loader path
	 * 
	 * @param	 array $loader
	 * @throws 	\Exception
	 * @access	public
	 */
	public function addLoader(array $loader)
	{
		if (!isset($loader['key'])) {
			throw new \Exception('The index \'key\' was not set', 1003);
		}
		
		if (!isset($loader['value'])) {
			throw new \Exception('The index \'value\' was not set', 1003);
		}
		
		$this->loaders[$loader['key']] = $loader['value'];
	}
	
	/**
	 * Get the path of the application
	 * 
	 * @param 	string $key
	 * @throws 	\Exception
	 * @return 	string
	 */
	public function getPath($key)
	{
		if (isset($this->loaders[$key])) {
			return $this->loaders[$key];
		} else {
			throw new \Exception('The index \'key\' was not set', 1003);
		}
	}
	
	/**
	 * Verify the existence of the file
	 * 
	 * @param 	string $key
	 * @param 	string $file
	 * @return 	boolean
	 * @access 	public
	 */
	public function fileExists($key, $file)
	{
		$fileName  = $this->loaders[$key] . DS . str_replace(SEPARATOR, DS, $file);
		$fileName .= $this->extension;
		
		if (file_exists($fileName)) {
			return true;
		} else {
			return false;
		}
	}
}