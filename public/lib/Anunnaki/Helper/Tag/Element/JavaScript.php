<?php
/**
 * JavaScript class
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
 * @package		Anunnaki\Helper\Tag
 */

namespace Anunnaki\Helper\Tag\Element;

use Anunnaki\Helper\Element;

/**
 * This class is responsible call a helper
 *
 * @package		Anunnaki\Helper\Tag
 * @author		Andre Naves
 */
class JavaScript extends Element
{
	/**
	 * The JavaScript helper method
	 * 
	 * @param	string $link
	 * @return	string
	 */
	public function javaScript($link)
	{
		$link = $this->config->root . $link;
		return "<script src=\"{$link}\" type=\"text/javascript\"></script>";
	}
}