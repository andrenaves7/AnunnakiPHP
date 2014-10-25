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
use Anunnaki\Core\Config;

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
	 * Holds the configuration of the application
	 *
	 * @var		Config
	 * @see		Anunnaki\Core\Config
	 * @access	protected
	 */
	protected $config;
	
	/**
	 * The host of the database
	 * 
	 * @var		string
	 * @access	private
	 */
	private $host;
	
	/**
	 * The port of the database
	 *
	 * @var		string
	 * @access	private
	 */
	private $port;
	
	/**
	 * The schema of the database
	 *
	 * @var		string
	 * @access	private
	 */
	private $schema;
	
	/**
	 * The user of the database
	 *
	 * @var		string
	 * @access	private
	 */
	private $user;
	
	/**
	 * The password of the database
	 *
	 * @var		string
	 * @access	private
	 */
	private $pass;
	
	/**
	 * The constructor
	 * 
	 * @access	private
	 */
	private function __construct(Config $config)
	{
		$this->host   = $config->db['host'];
		$this->port   = $config->db['port'];
		$this->schema = $config->db['schema'];
		$this->user   = $config->db['user'];
		$this->pass   = $config->db['pass'];
		
		$this->config = $config;
		
		$this->connection();
	}
	
	/**
	 * Get the instance of the class Connection
	 * 
	 * @return	\Anunnaki\Db\Adapter\Mysql\Connection
	 * @access	public
	 */
	public static function getInstance(Config $config)
	{
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c($config);
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
	
	/**
	 * Connect to the database
	 * 
	 * @access	private
	 */
	private function connection()
	{
		try {
			$port = $this->port != ''? " port=$this->port;": '';
			$dsn  = 'mysql:host=' . $this->host . ';' . $port . ' dbname=' . $this->schema;
			$this->connection = new \PDO($dsn, $this->user, $this->pass, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			App::callOnException($e->getMessage(), $e->getCode());
		}
	}
	
	/**
	 * Get the instance of the PDO connection
	 * 
	 * @access	public
	 */
	public function getConnection()
	{
		return $this->connection;
	}
}