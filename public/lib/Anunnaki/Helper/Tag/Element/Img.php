<?php
/**
 * Img class
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
class Img extends Element
{
	/**
	 * The img helper method
	 * 
	 * @param	string $src
	 * @param	array $options
	 * @return	string
	 * @access	public
	 */
	public function img($src, array $options = array())
	{
		return "<img src=\"{$this->config->root}{$src}\" {$this->mountsOption($options)} />";
	}
}