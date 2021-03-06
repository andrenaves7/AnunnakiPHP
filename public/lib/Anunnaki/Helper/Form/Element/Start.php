<?php
/**
 * Start class
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
 * @package		Anunnaki\Helper\Form\Element
 */

namespace Anunnaki\Helper\Form\Element;

use Anunnaki\Helper\Element;

/**
 * This class is responsible call a helper
 *
 * @package		Anunnaki\Helper\Form\Element
 * @author		Andre Naves
 */
class Start extends Element
{
	/**
	 * Start the form tag
	 * 
	 * @param	array $action
	 * @param	string $method
	 * @param	array $options
	 * @return	string
	 */
	public function start(array $action = array(), $method = 'post', array $options = array())
	{
		if (count($action) > 0) {
			$action = $this->config->root . implode('/', $action);
		} else {
			$action = '';
		}
		return "<form action=\"{$action}\" method=\"{$method}\"{$this->mountsOption($options)} >";
	}
}