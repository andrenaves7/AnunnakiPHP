<?php
/**
 * Input class
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

use Anunnaki\Helper\Helper;
use Anunnaki\Helper\Element;

/**
 * This class is responsible call a helper
 *
 * @package		Anunnaki\Helper\Form\Element
 * @author		Andre Naves
 */
class Input extends Element
{
	/**
	 * Mount an input element
	 * 
	 * @param	string $id
	 * @param	string $value
	 * @param	string $type
	 * @param	array $options
	 * @return	string
	 * @example echo $this->form->select('uf', array('GO' => 'Goiás', 'TO' => 'Tocantins')) | deve ser usado na view
	 */
	public function input($id, $value = null, $type = 'text', array $options = array())
	{
		$erros = '';
		if(strlen($value) == 0){
			$value = $this->getValuesById($id);
		}
		$erros = $this->getErrorsListById($id);
		
		$html  = "<input type=\"{$type}\" id=\"{$id}\" name=\"{$id}\" value=\"{$value}\"{$this->mountsOption($options)} />";
		$html .= $erros;
		
		return $html;
	}
}