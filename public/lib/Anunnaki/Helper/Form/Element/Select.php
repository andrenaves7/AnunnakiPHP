<?php
/**
 * Select class
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
class Select extends Element
{
	/**
	 * Mount the select element
	 * 
	 * @param	string $id
	 * @param	array $values
	 * @param	array $options
	 * @param	string $selected
	 * @return	string
	 * @access	public
	 */
	public function select($id, array $values = array(), array $options = array(), $selected = null)
	{
		$erros    = $this->getErrorsListById($id);
		$select   = "<select id=\"{$id}\" name=\"{$id}\" {$this->mountsOption($options)}>";
		$selected = $selected != null? $selected: $this->getValuesById($id);
		if (count($values) > 0) {
			foreach ($values as $url => $val) {
				$complemento = '';
				if ($selected == $url) {
					$complemento = ' selected="selected"';
				}
				$select .=  "<option value=\"{$url}\"{$complemento}>{$val}</option>";
			}
		}
		$select .= "</select>{$erros}";
	
		return $select;
	}
}