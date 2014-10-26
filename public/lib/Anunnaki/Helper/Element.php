<?php
/**
 * Element class
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
 * @package		Anunnaki\Helper
 */

namespace Anunnaki\Helper;

use Anunnaki\Core\Config;

/**
 * This class is responsible call a helper
 *
 * @package		Anunnaki\Helper
 * @author		Andre Naves
 * @abstract
 */
abstract class Element
{
	/**
	 * Holds the Data object
	 *
	 * @var		Data
	 * @access	protected
	 */
	protected $data;
	
	/**
	 * Holds the configuration of the application
	 *
	 * @var		Config
	 * @see		Anunnaki\Core\Config
	 * @access	protected
	 */
	protected $config;
	
	/**
	 * The constructor
	 *
	 * @param	Config $config
	 * @param	Data $data
	 * @access	public
	 */
	public function __construct(Config $config, Data $data)
	{
		$this->config = $config;
		$this->data = $data;
	}
	
	/**
	 * Get values by id
	 *
	 * @param	string $id
	 * @return	string|NULL
	 * @access	public
	 */
	public function getValuesById($id)
	{
		if (count($this->data->getValues()) > 0) {
			foreach ($this->data->getValues() as $key => $val) {
				if ($key == $id) {
					return $val;
				}
			}
		}
		return null;
	}
	
	/**
	 * Get the error list by id
	 * 
	 * @param	string $id
	 * @access	public
	 */
	public function getErrorsListById($id)
	{
		$html = '';
		if (count($this->data->getErrors()) > 0) {
			foreach ($this->data->getErrors() as $key => $errors) {
				if($key == $id) {
					$html .= '<ul class="error">';
					foreach ($errors as $error) {
						$html .= "<li>{$error}</li>";
					}
					$html .= '</ul>';
				}
			}
		}
		
		return $html;
	}
	
	/**
	 * Mounts the options
	 * 
	 * @param	array $option
	 * @return	string
	 * @access	protected
	 */
	protected function mountsOption(array $options = array())
	{
		$attributes = '';
		if (count($options) > 0) {
			foreach ($options as $url =>$opt) {
				$attributes .= " {$url}=\"{$opt}\"";
			}
		}
		
		return $attributes;
	}
}