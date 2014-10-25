<?php
/**
 * Names Class
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

/**
 * This class holds the names that we will use
 * in this module
 *
 * @package		Anunnaki\Db\Adapter\Mysql
 * @author		Andre Naves
 */
class Names
{
	/**
	 * Holds the string of the clause select
	 *
	 * @var		string
	 * @access	private
	 */
	private $select = 'SELECT';
	
	/**
	 * Holds the string of the clause from
	 *
	 * @var		string
	 * @access	private
	 */
	private $from = 'FROM';
	
	/**
	 * Holds the string of the clause where
	 *
	 * @var		string
	 * @access	private
	 */
	private $where = 'WHERE';
	
	/**
	 * Holds the string of the clause join
	 *
	 * @var		string
	 * @access	private
	 */
	private $join = 'JOIN';
	
	/**
	 * Holds the string of the clause ON
	 *
	 * @var		string
	 * @access	private
	 */
	private $on = 'ON';
	
	/**
	 * Holds the string of the clause or
	 *
	 * @var		string
	 * @access	private
	 */
	private $or = 'OR';
	
	/**
	 * Holds the string of the clause and
	 *
	 * @var		string
	 * @access	private
	 */
	private $and = 'AND';
	
	/**
	 * Holds the string of the clause order by
	 *
	 * @var		string
	 * @access	private
	 */
	private $orderBy = 'ORDER BY';
	
	/**
	 * Holds the string of the clause group by
	 *
	 * @var		string
	 * @access	private
	 */
	private $groupBy = 'GROUP BY';
	
	/**
	 * Holds the string of the clause limit
	 *
	 * @var		string
	 * @access	private
	 */
	private $limit = 'LIMIT';
	
	/**
	 * Holds the string of the clause offset
	 *
	 * @var		string
	 * @access	private
	 */
	private $offset = 'OFFSET';
	
	/**
	 * Holds the string of the clause alias
	 *
	 * @var		string
	 * @access	private
	 */
	private $alias = 'AS';
	
	/**
	 * Holds the string of the comma separator
	 * 
	 * @var		string
	 * @access	private
	 */
	private $commaSeparator = ', ';
	
	/**
	 * Holds the string of the space separator
	 *
	 * @var		string
	 * @access	private
	 */
	private $spaceSeparator = ' ';
	
	/**
	 * Return the select caluse
	 * 
	 * @access	public
	 * @return	string
	 */
	public function getSelect()
	{
		return $this->select;
	}
	
	/**
	 * Return the from caluse
	 *
	 * @access	public
	 * @return	string
	 */
	public function getFrom()
	{
		return $this->from;
	}
	
	/**
	 * Return the where caluse
	 *
	 * @access	public
	 * @return	string
	 */
	public function getWhere()
	{
		return $this->where;
	}
	
	/**
	 * Return the join caluse
	 *
	 * @access	public
	 * @return	string
	 */
	public function getJoin()
	{
		return $this->join;
	}
	
	/**
	 * Return the on caluse
	 *
	 * @access	public
	 * @return	string
	 */
	public function getOn()
	{
		return $this->on;
	}
	
	/**
	 * Return the or caluse
	 *
	 * @access	public
	 * @return	string
	 */
	public function getOr()
	{
		return $this->or;
	}
	
	/**
	 * Return the and caluse
	 *
	 * @access	public
	 * @return	string
	 */
	public function getAnd()
	{
		return $this->and;
	}
	
	/**
	 * Return the order caluse
	 *
	 * @access	public
	 * @return	string
	 */
	public function getOrderBy()
	{
		return $this->orderBy;
	}
	
	/**
	 * Return the group caluse
	 *
	 * @access	public
	 * @return	string
	 */
	public function getGroupBy()
	{
		return $this->groupBy;
	}
	
	/**
	 * Return the limit caluse
	 *
	 * @access	public
	 * @return	string
	 */
	public function getLimit()
	{
		return $this->limit;
	}
	
	/**
	 * Return the offset caluse
	 *
	 * @access	public
	 * @return	string
	 */
	public function getOffset()
	{
		return $this->offset;
	}
	
	/**
	 * Return the alias caluse
	 *
	 * @access	public
	 * @return	string
	 */
	public function getAlias()
	{
		return $this->alias;
	}
	
	/**
	 * Return the comma separator
	 * 
	 * @access	public
	 * @return	string
	 */
	public function getCommaSeparator()
	{
		return $this->commaSeparator;
	}
	
	/**
	 * Return the space separator
	 *
	 * @access	public
	 * @return	string
	 */
	public function getSpaceSeparator()
	{
		return $this->spaceSeparator;
	}
}