<?php
/**
 * Tag class
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
 * @package		Anunnaki\Helper\App
 */

namespace Anunnaki\Helper\App;

use Anunnaki\Helper\Helper;

/**
 * This class is responsible call a helper
 *
 * @package		Anunnaki\Helper\App
 * @author		Andre Naves
 */
class App extends Helper
{
	/**
	 * Mounts the name of the class
	 *
	 * @access	protected
	 */
	protected function mountClass()
	{
		$string = $this->config->getHelpersDir() . SEPARATOR;
		$this->className = $string;
	}
}