<?php
/**
 * Action MySQL
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
 * @package		Anunnaki\Db\Adapter\Mysql
 */

namespace Anunnaki\Db\Adapter\Mysql;

use Anunnaki\Db\Interfaces\Action;
use Anunnaki\Core\Config;

/**
 * The Action class will have the methods
 * to manage the datase's data
 *
 * @package		Anunnaki\Db\Adapter\Mysql
 * @author		Andre Naves
 */
class MySQL implements Action
{
	/**
	 * Holds the PDO instance
	 * 
	 * @see		\PDO
	 * @var		\PDO
	 * @access	private
	 */
	private $connection;
	
	/**
	 * Holds the SQL class
	 * 
	 * @see		Anunnaki\Db\Adapter\DbInterface\Select
	 * @access	private
	 * @var		Select
	 */
	private $select;
	
	/**
	 * Holds the instance of the class Names
	 *
	 * @var		Names
	 * @see		Anunnaki\Db\Adapter\Mysql
	 * @access	private
	 */
	private $names;
	
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
	 */
	public function __construct(Config $config)
	{
		$this->config     = $config;
		$this->connection = Connection::getInstance($config)->getConnection();
		$this->names      = new Names();
		$this->select     = new Select($this, $this->names);
	}
	
	/**
	 * Get connection
	 * 
	 * @see		\Anunnaki\Db\Interfaces\Action::getConnection()
	 * @access	public
	 */
	public function getConnection()
	{
		return $this->connection;
	}
	
	/**
	 * Fetch all the results
	 * 
	 * @param 	string/array $table
	 * @param 	string $where
	 * @param 	string $order
	 * @param 	string $limit
	 * @param 	string $offset
	 * @see 	\Anunnaki\Db\Interfaces\Action::fetchAll()
	 * @return	array
	 * @access	public
	 */
	public function fetchAll($table, $where = null, $order = null, $limit = null, $offset = null)
	{
		if ($where instanceof Select) {
			$sql = $where->getQuery();
		} else {
			if ($where != null) {
				$where  = $this->names->getWhere();
				$where .= $this->names->getSpaceSeparator();
				$where .= $where;
			}
			if ($order != null) {
				$order  = $this->names->getOrderBy();
				$order .= $this->names->getSpaceSeparator();
				$order .= $order;
			}
			if ($limit != null) {
				$limit  = $this->names->getLimit();
				$limit .= $this->names->getSpaceSeparator();
				$limit .= $limit;
			}
			if ($offset != null) {
				$offset  = $this->names->getOffset();
				$offset .= $this->names->getSpaceSeparator();
				$offset .= $offset;
			}
			$sql  = $this->names->getSelect();
			$sql .= $this->names->getSpaceSeparator() . '*';
			$sql .= $this->names->getSpaceSeparator();
			$sql .= $this->names->getFrom();
			$sql .= $this->names->getSpaceSeparator() . $table;
			$sql .= $this->names->getSpaceSeparator() . $where;
			$sql .= $this->names->getSpaceSeparator() . $order;
			$sql .= $this->names->getSpaceSeparator() . $limit;
			$sql .= $this->names->getSpaceSeparator() . $offset;
			
			$sql = trim($sql);
		}
		$res = $this->connection->query($sql, PDO::FETCH_ASSOC);
		return $res->fetchAll();
	}
	
	/**
	 * Fetch the result
	 * 
	 * @param	string $table
	 * @param	string $where
	 * @param	string $order
	 * @see		\Anunnaki\Db\Interfaces\Action::fetchRow()
	 * @return	array
	 * @access	public
	 */
	public function fetchRow($table, $where = null, $order = null)
	{
		if ($where instanceof Select) {
			$sql = $where->getQuery();
		} else {
			if($where != null) {
				$where  = $this->names->getWhere();
				$where .= $this->names->getSpaceSeparator();
				$where .= $where;
			}
			if ($order != null) {
				$order  = $this->names->getOrderBy();
				$order .= $this->names->getSpaceSeparator();
				$order .= $order;
			}
			
			$sql  = $this->names->getSelect();
			$sql .= $this->names->getSpaceSeparator() . '*';
			$sql .= $this->names->getSpaceSeparator();
			$sql .= $this->names->getFrom();
			$sql .= $this->names->getSpaceSeparator() . $table;
			$sql .= $this->names->getSpaceSeparator() . $where;
			$sql .= $this->names->getSpaceSeparator() . $order;
			
			$sql = trim($sql);
		}
		$res = $this->connection->query($sql, PDO::FETCH_ASSOC);
		return $res->fetch();
	}
	
	/**
	 * Insert into database
	 * 
	 * @param	string $table
	 * @param	array $data
	 * @see		\Anunnaki\Db\Interfaces\Action::insert()
	 * @access	public
	 */
	public function insert($table, array $data)
	{
		$columns = implode(', ', array_keys($data));
		$values = ':' . implode(', :', array_keys($data));
		$sql = "INSERT INTO {$table}({$columns}) VALUES ({$values})";
		$res = $this->connection->prepare($sql);
	
		foreach ($data as $key => $value) {
			$res->bindValue(":{$key}", $value);
		}
		if ($res->execute()) {
			return $this->connection->lastInsertId();
		} else {
			return false;
		}
	}
	
	/**
	 * Update data on database
	 * 
	 * @param	string $table
	 * @param	array $data
	 * @param	string/array $where
	 * @see		\Anunnaki\Db\Interfaces\Action::update()
	 * @return	boolean
	 * @access	public
	 */
	public function update($table, array $data, $where)
	{
		$cond = array();
		foreach ($data as $key => $value) {
			array_push($cond, "{$key} = :{$key}");
		}
		if (is_array($where)) {
			$where = implode(") AND (", $where);
		}
		$newValues = implode(', ', $cond);
		$sql = "UPDATE {$table} SET {$newValues} WHERE ({$where})";
		$res = $this->connection->prepare($sql);
		foreach ($data as $key => $value) {
			$res->bindValue(":{$key}", $value);
		}
		if ($res->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 
	 * @param	string $table
	 * @param	string/array $where
	 * @see		\Anunnaki\Db\Interfaces\Action::delete()
	 * @return	boolean
	 * @access	public
	 */
	public function delete($table, $where)
	{
		if (is_array($where)) {
			$where = implode(") AND (", $where);
		}
		$sql = "DELETE FROM {$table} WHERE ({$where})";
		$res = $this->connection->prepare($sql);
		if ($res->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Quote a string
	 *
	 * @param	string $string
	 * @see 	\Anunnaki\Db\Adapter\DbInterface\Action::quote()
	 * @access	public
	 * @return	string
	 */
	public function quote($string)
	{
		if (!is_numeric($string)) {
			$string = trim($string);
			$string = addslashes($string);
			$string = get_magic_quotes_gpc()? stripcslashes($string): $string;
		}
	
		return $string;
	}
	
	/**
	 * Get the result of the SQL
	 *
	 * @param	string $sql
	 * @param	boolean $all
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Action::querySQL()
	 * @throws	\Exception
	 * @access	public
	 * @return	array
	 */
	public function querySQL($sql, $all = true)
	{
		if ($this->connection instanceof PDO) {
			$res = $this->connection->query($sql, PDO::FETCH_ASSOC);
			if ($all == true) {
				return $res->fetchAll();
			} else {
				return $res->fetch();
			}
		} else {
			throw new \Exception('The database connection was not established', 1015);
		}
	}
	
	/**
	 * Executes a SQL string
	 * 
	 * @param	unknown $sql
	 * @see		\Anunnaki\Db\Interfaces\Action::executeSQL()
	 * @return	boolean
	 * @access	public
	 */
	public function executeSQL($sql)
	{
		$res = $this->connection->prepare($sql);
		if ($res->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Begin the transaction
	 * 
	 * @see		\Anunnaki\Db\Interfaces\Action::beginTransaction()
	 * @access	public
	 */
	public function beginTransaction()
	{
		$this->connection->beginTransaction();
	}
	
	/**
	 * Commit in a open transaction
	 * 
	 * @see		\Anunnaki\Db\Interfaces\Action::commit()
	 * @access	public
	 */
	public function commit()
	{
		$this->connection->commit();
	}
	
	/**
	 * Rollback in a non well successful transaction
	 * 
	 * @see		\Anunnaki\Db\Interfaces\Action::rollBack()
	 * @access	public
	 */
	public function rollBack()
	{
		$this->connection->rollBack();
	}
	
	/**
	 * Return the object Select
	 * 
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Action::select()
	 * @access	public
	 * @return	Select
	 */
	public function select()
	{
		return $this->select;
	}
}