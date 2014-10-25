<?php
/**
 * Sql Interface
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
 * @package		Anunnaki\Db\Interfaces
 */

namespace Anunnaki\Db\Interfaces;

/**
 * The interface Select will set the rules
 * to the class Select
 *
 * @package		Anunnaki\Db\Interfaces
 * @author		Andre Naves
 */
interface Select
{
	public function __toString();
	public function from($table, array $columns);
	public function where($condition, $value);
	public function orWhere($condition, $value);
	public function order($order);
	public function group($group);
	public function limit($limit);
	public function offset($offset);
	public function getQuery();
	public function join($table, $on, array $columns = array());
	public function joinLeft($table, $on, array $columns = array());
	public function joinRight($table, $on, array $columns = array());
	public function fetch();
	public function fetchAll();
}