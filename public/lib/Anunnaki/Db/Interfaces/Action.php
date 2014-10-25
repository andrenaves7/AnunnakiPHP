<?php
/**
 * Action Interface
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
 * The interface Action will set the rules
 * to the class Select
 *
 * @package		Anunnaki\Db\Interfaces
 * @author		Andre Naves
 */
interface Action
{
	public function getConnection();
	public function fetchAll($table, $where, $order, $limit, $offset);
	public function fetchRow($table, $where, $order);
	public function insert($table, array $data);
	public function update($table, array $data, $where);
	public function delete($table, $where);
	public function quote($string);
	public function querySQL($sql, $all = true);
	public function executeSQL($sql);
	public function beginTransaction();
	public function commit();
	public function rollBack();
	public function select();
}