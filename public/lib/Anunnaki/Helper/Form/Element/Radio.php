<?php
/**
 * Radio class
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

class Radio extends Element
{
	/**
	 * Mount the radio button
	 * 
	 * @param	unknown $id
	 * @param	array $elements
	 * @param	string $value
	 * @param	array $options
	 * @return	string
	 * @access	public
	 */
	public function radio($id, array $elements, $value = null, array $options = array())
	{
		$erros      = '';
		$element    = '';
		$val        = $this->getValuesById($id);
		$attributes = $this->mountsOption($options);
		foreach ($elements as $key => $el){
			$checked = '';
			if ($val != '') {
				$checked = ($val == $key)? ' CHECKED': '';
			} else {
				$checked = ($value == $key)? ' CHECKED': '';
			}
			$element .= '<input type="radio" name="' . $id . '" value="' . $key . '" ' . $checked . $attributes . '> <label ' . $attributes . '>' . $el . '</label>';
		}
		$erros = $this->getErrorsListById($id);
		return "{$element}{$erros}";
	}
}