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
 * @version    18-10-2014 10:16
 */

/**
 * @category Anunnaki
 * @package  Anunnaki_Controller
 * @author   Andre Naves
 */
class Anunnaki_App
{
	/**
	 * Languages
	 */
	const PT_BR = 'PT_BR';
	const EN_US = 'EN_US';
	
	/**
	 * The first method to call
	 * 
	 * @access public
	 * @static
	 */
	public static function run()
	{
		$url        = explode('/', Anunnaki_App::prepareURL());
		$controller = isset($url[0]) && strlen($url[0]) > 0? $url[0]: 'index';
		$action     = isset($url[1]) && strlen($url[1]) > 0? $url[1]: 'index';
		
		
	}
	
	/**
	 * Prepare the string to make it a class
	 *
	 * @param string $controller
	 * @return string
	 * @static
	 */
	static function prepareController($controller)
	{
		$controller = explode(array('-', '.', '_'), $controller);
	
		foreach ($controller as $key => $value) {
			$controller[$key] = ucfirst($value);
		}
	
		return implode('', $controller);
	}
	
	/**
	 *
	 * Prepara a URL
	 *
	 * @return string
	 * @access public
	 * @static
	 */
	public static function prepareURL()
	{
		$anunnaki_config = Anunnaki_Config::getInstance();
		
		$uri  = explode('/', $_SERVER['REQUEST_URI']);
		$root = explode('/', $anunnaki_config->root);
		
		for ($i = 0; $i < count($root); $i++) {
			if ($root[$i] == $uri[$i]) {
				unset($uri[$i]);
			}
		}
	
		return implode('/', $uri);
	}
}