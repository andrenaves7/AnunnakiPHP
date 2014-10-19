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
 * @version    18-10-2014 14:13
 */

/**
 * @category Anunnaki
 * @package  Anunnaki_Config
 * @author   Andre Naves
 * @see      AppConfig
 * @abstract
 */
abstract class Config extends AppConfig
{
	/**
	 * Set the language of the messages
	 * 
	 * @var    string
	 * @access public
	 * @see    Anunnaki_App
	 */
	public $language = Anunnaki_App::PT_BR;
	
	/**
	 * Set the root path
	 * 
	 * @var    string
	 * @access public
	 */
	public $root = '/';
}