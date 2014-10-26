<?php
/**
 * Grid class
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

namespace Anunnaki\Helper\Component\Element;

use Anunnaki\Helper\Element;

/**
 * This class is responsible call a helper
 *
 * @package		Anunnaki\Helper\Tag
 * @author		Andre Naves
 */
class Grid extends Element
{
	/**
	 * Mounts the grid
	 * 
	 * @param	string$id
	 * @param	array $indexes
	 * @param	array $values
	 * @param	array $options
	 * @return	string
	 */
	public function grid($id, array $indexes, array $values, array $options = array())
	{
		$html = '';
		if(count($indexes) > 0){
			$attributes = $this->mountsOption($options);
	
			$html .= "<table id=\"{$id}\" {$attributes}><thead><tr>";
	
			foreach($indexes as $ind){
				$preparedKey = strtolower(str_replace(' ', '', $ind));
				$html .= "<th class=\"{$preparedKey}\">{$ind}</th>";
			}
	
			$html .= '</tr></thead><tbody>';
	
			if(count($values) > 0){
				foreach ($values as $key => $vals){
					$html .= '<tr>';
					foreach ($vals as $key => $val){
						$html .= "<td>{$val}</td>";
					}
					$html .= '</tr>';
				}
			}
			$html .= '</tbody></table>';
		}
		return $html;
	}
}