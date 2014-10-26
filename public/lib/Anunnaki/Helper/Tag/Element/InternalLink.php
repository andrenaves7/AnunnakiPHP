<?php
/**
 * InternalLink class
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
class InternalLink extends Element
{
	/**
	 * The internalLink helper method
	 * 
	 * @param array $link
	 * @param unknown $text
	 * @param array $options
	 * @return string
	 */
	public function internalLink(array $link, $text, array $options = array())
	{
		if (count($link) > 0) {
			$link = implode(DS, $link) . DS;
		} else {
			$link = '';
		}
	
		$url = "href=\"{$this->config->root}{$link}\"";
	
		return "<a {$url}{$this->mountsOption($options)}>{$text}</a>";
	}
}