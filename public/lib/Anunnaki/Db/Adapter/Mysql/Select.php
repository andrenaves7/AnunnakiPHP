<?php
/**
 * Sql Class
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

use Anunnaki\Db\Interfaces\Select as SelectInterface;

/**
 * Sql is a class which generates a SQL 
 * query string to run it in a database
 *
 * @package		Anunnaki\Db\Adapter\Mysql
 * @author		Andre Naves
 */
class Select implements SelectInterface
{
	/**
	 * Holds the instance of Action class
	 * 
	 * @var		Action
	 * @see		Anunnaki\Db\Adapter\Mysql\Action
	 * @access	private
	 */
	private $dbTable;
	
	/**
	 * Holds the instance of the class Names
	 * 
	 * @var		Names
	 * @see		Anunnaki\Db\Adapter\Mysql
	 * @access	private
	 */
	private $names;
	
	/**
	 * Holds the name of the table
	 *
	 * @var		array
	 * @access	private
	 */
	private $table = array();
	
	/**
	 * Holds the columns will be listed
	 *
	 * @var		array
	 * @access	private
	 */
	private $columns = array();
	
	/**
	 * Holds the where's clause
	 * 
	 * @var		array
	 * @access	private
	 */
	private $where = array();
	
	/**
	 * Holds the or's clause
	 *
	 * @var		array
	 * @access	private
	 */
	private $orWhere = array();
	
	/**
	 * Holds the order's clause
	 *
	 * @var		array
	 * @access	private
	 */
	private $order = array();
	
	/**
	 * Holds the group's clause
	 *
	 * @var		array
	 * @access	private
	 */
	private $group = array();
	
	/**
	 * Holds the join's clause
	 *
	 * @var		array
	 * @access	private
	 */
	private $join = array();
	
	/**
	 * Holds the limit's clause
	 *
	 * @var		integer
	 * @access	private
	 */
	private $limit = null;
	
	/**
	 * Holds the offset's clause
	 *
	 * @var		integer
	 * @access	private
	 */
	private $offset = null;
	
	/**
	 * Holds the string of the query
	 *
	 * @var		string
	 * @access	private
	 */
	private $sql = '';
	
	/**
	 * The constants that clause join will use
	 */
	const LEFT  = 'LEFT';
	const RIGHT = 'RIGHT';
	const INNER = 'INNER';
	
	/**
	 * The constructor
	 * 
	 * @param	Action $action
	 * @param	Names $names
	 * @access	pulic
	 */
	public function __construct(ActionMysql $action, Names $names)
	{
		$this->dbTable = $action;
		$this->names   = $names;
	}
	
	/**
	 * Returns a string of the query
	 * 
	 * @return	string
	 * @access	public
	 */
	public function __toString()
	{
		return $this->sql;
	}
	
	/**
	 * Format the form clause
	 * 
	 * @param	mixed $table
	 * @param	array $columns
	 * @return	Select
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::from()
	 * @access	public
	 */
	public function from($table, array $columns = array())
	{
		$table = $this->prepareTableName($table);
		if (count($columns) > 0) {
			foreach($columns as $key => $val) {
				if ($this->mysqlFunctions($val)) {
					$columns[$key] = $val;
				} else {
					$columns[$key] = "{$table[1]}.{$val}";
				}
			}
		}
		array_push($this->table, $table[0]);
		$this->columns = array_merge($this->columns, $columns);
		$this->setQuery();
		return $this;
	}
	
	/**
	 * Format the where clause
	 * 
	 * @param	string $condition
	 * @param	string $value
	 * @return	Select
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::where()
	 * @access	public
	 */
	public function where($condition, $value = null)
	{
		if (is_int($value)) {
			$value = (string) $value;
		}
		if ($value != null) {
			$value = $this->dbTable->quote($value);
			$condition = str_replace('?', "'{$value}'", $condition);
		}
		array_push($this->where, "({$condition})");
		$this->setQuery();
		return $this;
	}
	
	/**
	 * Format the or clause
	 * 
	 * @param	string $condition
	 * @param	string $value
	 * @return	Select
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::orWhere()
	 * @access	public
	 */
	public function orWhere($condition, $value = null)
	{
		if ($value != null) {
			$value = $this->dbTable->quote($value);
			$condition = str_replace('?', "'{$value}'", $condition);
		}
		array_push($this->orWhere, "({$condition})");
		$this->setQuery();
		return $this;
	}
	
	/**
	 * Format the order clause
	 * 
	 * @param	string/array $order
	 * @return	Select
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::order()
	 * @access	public
	 */
	public function order($order)
	{
		if (is_array($order) && count($order) > 0) {
			$order = implode($this->names->getCommaSeparator(), $order);
		}
		array_push($this->order, $order);
		$this->setQuery();
		return $this;
	}
	
	/**
	 * Format the group clause
	 * 
	 * @param	string/array $group
	 * @return	Select
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::group()
	 * @access	public
	 */
	public function group($group)
	{
		if (is_array($group) && count($group) > 0) {
			$group = implode($this->names->getCommaSeparator(), $group);
		}
		array_push($this->group, $group);
		$this->setQuery();
		return $this;
	}
	
	/**
	 * Format the limit clause
	 *
	 * @param	integer $limit
	 * @return	Select
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::limit()
	 * @access	public
	 */
	public function limit($limit)
	{
		if (is_numeric($limit)) {
			$this->limit = (int)$limit;
		}
		$this->setQuery();
		return $this;
	}
	
	/**
	 * Format the offset clause
	 *
	 * @param	integer $offset
	 * @return	Select
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::offset()
	 * @access	public
	 */
	public function offset($offset)
	{
		if (is_numeric($offset)) {
			$this->offset = (int)$offset;
		}
		$this->setQuery();
		return $this;
	}
	
	/**
	 * Format the join clause
	 *
	 * @param	string/array $table
	 * @param	string $on
	 * @param	array $columns
	 * @return	Select
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::join()
	 * @access	public
	 */
	public function join($table, $on, array $columns = array())
	{
		$table = $this->prepareTableName($table);
		$this->joinRelationship(self::INNER, $table, $on, $columns);
		$this->setQuery();
		return $this;
	}
	
	/**
	 * Format the left join clause
	 *
	 * @param	string/array $table
	 * @param	string $on
	 * @param	array $columns
	 * @return	Select
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::joinLeft()
	 * @access	public
	 */
	public function joinLeft($table, $on, array $columns = array())
	{
		$table = $this->prepareTableName($table);
		$this->joinRelationship(self::LEFT, $table, $on, $columns);
		$this->setQuery();
		return $this;
	}
	

	/**
	 * Format the right join clause
	 *
	 * @param	string/array $table
	 * @param	string $on
	 * @param	array $columns
	 * @return	Select
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::joinRight()
	 * @access	public
	 */
	public function joinRight($table, $on, array $columns = array())
	{
		$table = $this->prepareTableName($table);
		$this->joinRelationship(self::RIGHT, $table, $on, $columns);
		$this->setQuery();
		return $this;
	}
	
	/**
	 * Format the offset clause
	 *
	 * @return	Select
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::getQuery()
	 * @access	public
	 */
	public function getQuery()
	{
		return $this->sql;
	}
	
	/**
	 * Return the result of the SQL
	 * 
	 * @return	array
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::fetch()
	 * @access	public
	 */
	public function fetch()
	{
		return $this->dbTable->querySQL($this->sql, false);
	}
	
	/**
	 * Return all the results of the SQL
	 *
	 * @return	array
	 * @see		\Anunnaki\Db\Adapter\DbInterface\Select::fetchAll()
	 * @access	public
	 */
	public function fetchAll()
	{
		return $this->dbTable->querySQL($this->sql, true);
	}
	
	/**
	 * Set the relationships
	 * 
	 * @param	string $type
	 * @param	string $table
	 * @param	string $on
	 * @param	string $columns
	 * @access	private
	 */
	private function joinRelationship($type, $table, $on, $columns = array())
	{
		if (count($columns) > 0) {
			foreach ($columns as $key => $val) {
				if ($this->mysqlFunctions($val)) {
					$columns[$key] = $val;
				} else {
					$columns[$key] = "{$table[1]}.{$val}";
				}
			}
		}
		$this->columns = array_merge($this->columns, $columns);
		
		$string  = $type . $this->names->getSpaceSeparator();
		$string .= $this->names->getJoin() . $this->names->getSpaceSeparator();
		$string .= $table[0] . $this->names->getSpaceSeparator();
		$string .= $this->names->getOn();
		$string .= $this->names->getSpaceSeparator() . $on;
		array_push($this->join, $string);
		return;
	}
	
	/**
	 * Prepare the name of the table
	 * 
	 * @param	string/array $table
	 * @throws	\Exception
	 * @return	array
	 * @access	private
	 */
	private function prepareTableName($table)
	{
		$alias     = '';
		$tableName = '';
		if (is_array($table)) {
			$alias = key($table);
			if (is_array($alias)) {
				throw new \Exception('Incorret value to the alias \'' . $alias . '\'', 1013);
			} else {
				$tableName = $table[$alias];
				$string    = $tableName . $this->names->getSpaceSeparator();
				$string   .= $this->names->getAlias();
				$string   .= $this->names->getSpaceSeparator() . $alias;
				return array($string, $alias);
			}
		} else {
			return array($table, $table);
		}
	}
	
	/**
	 * Create the SQL string for this query
	 * 
	 * @access	private
	 * @throws	\Exception
	 * @return	void
	 */
	private function setQuery()
	{
		// Check if the table is defined
		if(count($this->table) > 0) {
			$table = implode($this->names->getCommaSeparator(), $this->table);
		} else {
			throw new \Exception('None table was defined', 1014);
		}
		
		// Check the columns
		if (count($this->columns) > 0) {
			$columns = implode($this->names->getCommaSeparator(), $this->columns);
		} else {
			$columns = '*';
		}
		
		// Define the WHERE clause
		if (count($this->where) > 0) {
			$where  = $this->names->getWhere();
			$where .= $this->names->getSpaceSeparator();
			$where .= implode($this->names->getSpaceSeparator() . $this->names->getAnd() . $this->names->getSpaceSeparator(), $this->where);
		} else {
			$where = '';
		}
		
		// Define the OR clause
		if (count($this->orWhere) > 0) {
			$orWhere  = $this->names->getOr();
			$orWhere .= $this->names->getSpaceSeparator();
			$orWhere .= implode($this->names->getSpaceSeparator() . $this->names->getOr() . $this->names->getSpaceSeparator(), $this->orWhere);
		} else {
			$orWhere = '';
		}
		
		// Define the ORDER clause
		if (count($this->order) > 0) {
			$order  = $this->names->getOrderBy();
			$order .= $this->names->getSpaceSeparator();
			$order .= implode($this->names->getCommaSeparator(), $this->order);
		} else {
			$order = '';
		}
		
		// Define the GROUP clause
		if (count($this->group) > 0) {
			$group  = $this->names->getGroupBy();
			$group .= $this->names->getSpaceSeparator();
			$group .= implode($this->names->getCommaSeparator(), $this->group);
		} else {
			$group = '';
		}
		
		// Define the LIMIT clause
		if ($this->limit != null) {
			$limit  = $this->names->getLimit();
			$limit .= $this->names->getSpaceSeparator();
			$limit .= $this->limit;
		} else {
			$limit = '';
		}
		
		// Define the OFFSET clause
		if ($this->offset != null) {
			$offset  = $this->names->getOffset();
			$offset .= $this->names->getSpaceSeparator();
			$offset .= $this->offset;
		} else {
			$offset = '';
		}
		
		// Define the join Clause
		if (count($this->join) > 0) {
			$join = implode($this->names->getSpaceSeparator(), $this->join);
		} else {
			$join = '';
		}
		
		// Define the SQL
		$sql  = $this->names->getSelect();
		$sql .= $this->names->getSpaceSeparator();
		$sql .= $columns . $this->names->getSpaceSeparator();
		$sql .= $this->names->getFrom() . $this->names->getSpaceSeparator();
		$sql .= $table . $this->names->getSpaceSeparator();
		$sql .= $join . $this->names->getSpaceSeparator();
		$sql .= $where . $this->names->getSpaceSeparator();
		$sql .= $orWhere . $this->names->getSpaceSeparator();
		$sql .= $group . $this->names->getSpaceSeparator();
		$sql .= $limit . $this->names->getSpaceSeparator() . $offset;
		
		$this->sql = trim($sql);
	
		return;
	}
	
	private function mysqlFunctions($field)
	{
		// Funções do Mysql que a classe Select deve ignorar
		$functions[] = 'AVG';
		$functions[] = 'COUNT';
		$functions[] = 'MIN';
		$functions[] = 'MAX';
		$functions[] = 'SDT';
		$functions[] = 'SDTDEV';
		$functions[] = 'SUM';
		$functions[] = 'CONCAT';
		$functions[] = 'COALESCE';
		$functions[] = 'IFNULL';
		$functions[] = 'LTRIM';
		$functions[] = 'RTRIM';
		$functions[] = 'TRIM';
		$functions[] = 'IFNULL';
		
		// Varre as funções do mysaql verificando se a mesma está presente no campo
		foreach ($functions as $function) {
			// Caso encontre alguma das funções na string $field retorna verdadeiro
			if (preg_match('/' . $function . '/', $field)) {
				return true;
			}
			// Caso contrário retorna false
		}
		
		return false;
	}
}