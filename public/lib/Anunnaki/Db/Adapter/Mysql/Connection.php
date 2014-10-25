<?php
/**
 * Connection Interface
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
 * @package		Anunnaki\Db\Adapter\DbInterface
 */

namespace Anunnaki\Db\Adapter\Mysql;

use Anunnaki\Core\App;
/**
 * This class is responsible to
 * connect to the database
 *
 * @package		Anunnaki\Db\Adapter\Mysql
 * @author		Andre Naves
 */
class Connection
{
	/**
	 * Instance of the class Connection
	 * 
	 * @var		Connection
	 * @see		Anunnaki\Db\Adapter\Mysql\Connection
	 * @access	private
	 * @static
	 */
	private static $instance;
	
	/**
	 * Holds the connection
	 * 
	 * @var		\PDO
	 * @see		\PDO
	 * @access	private
	 */
	private $connection;
	
	/**
	 * The constructor
	 * 
	 * @access	private
	 */
	private function __construct()
	{
		$this->connection();
	}
	
	/**
	 * Get the instance of the class Connection
	 * 
	 * @return	\Anunnaki\Db\Adapter\Mysql\Connection
	 * @access	public
	 */
	public static function getInstance()
	{
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c();
		}
		return self::$instance;
	}
	
	/**
	 * This class is not a cloneable class
	 */
	private function __clone()
	{
		throw new \Exception('This is not a cloneable class', 1000);
	}
	
	private function connection()
	{
		try {
			$port = $this->port != ''? " port=$this->port;": '';
			$dsn = 'mysql:host=' . $this->dbHost . ';' . $port . ' dbname=' . $this->dbName;
			$this->connection = new PDO($dsn, $this->dbUsername, $this->dbPassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			App::callOnException($e->getMessage(), $e->getCode());
		}
	}
}