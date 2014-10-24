<?php
/**
 * IndexController class
 * 
 * This is a controller class in the level of the application
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
 * @package		Anunnaki\Mvc\Controller
 */

namespace Modules\Def\Controllers;

use Anunnaki\Mvc\Controller;

/**
 * Bootstrap class
 *
 * @package		Environment
 * @author		Andre Naves
 * @see			Anunnaki\Mvc\Controller
 */
class IndexController extends Controller
{
	/**
	 * Override the method init
	 * 
	 * @access	public
	 * @see		Anunnaki\Front\Controller::init()
	 */
	protected function init()
	{
		
	}
	
	/**
	 * The action index
	 * 
	 * @access public
	 */
	public function indexAction()
	{
		echo 'Hi! I am a controller';
	}
}