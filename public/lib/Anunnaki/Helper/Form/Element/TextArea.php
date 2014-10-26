<?php
/**
 * TextArea class
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
class TextArea extends Element
{
	/**
	 * Mount the textarea element
	 * 
	 * @param	string $id
	 * @param	array $options
	 * @param	string $value
	 * @return	string
	 */
	public function textArea($id, array $options = array(), $value = null)
	{
		$erros = '';
		if (strlen($value) == 0) {
			$value = $this->getValuesById($id);
		}
		$erros = $this->getErrorsListById($id);
		return "<textarea  id=\"{$id}\" name=\"{$id}\"{$this->mountsOption($options)}>{$value}</textarea>{$erros}";
	}
}