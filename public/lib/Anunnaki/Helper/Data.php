<?php
/**
 * Data class
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

/**
 * This class is responsible call a helper
 *
 * @package		Anunnaki\Helper
 * @author		Andre Naves
 */
class Data
{
	/**
	 * Holds the request values
	 *
	 * @var		array
	 * @access	protected
	 */
	private $values = array();
	
	/**
	 * Holds the request errors
	 * 
	 * @var		array
	 * @access	private
	 */
	private $errors = array();
	
	/**
	 * Return the values
	 * 
	 * @return	array
	 * @access	public
	 */
	public function getValues()
	{
		return $this->values;
	}
	
	/**
	 * Set the values
	 * 
	 * @param	array $values
	 * @access	public
	 */
	public function setValues(array $values = array())
	{
		$this->values = $values;
	}
	
	/**
	 * Return the erros
	 * 
	 * @return array
	 */
	public function getErrors()
	{
		return $this->errors;
	}
	
	/**
	 * Set errors
	 * 
	 * @param array $erros
	 */
	public function setErrors(array $erros = array())
	{
		$this->errors = $erros;
	}
}