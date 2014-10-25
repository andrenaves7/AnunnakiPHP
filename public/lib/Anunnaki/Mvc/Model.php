<?php
/**
 * Model class
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
 * @package		Anunnaki\Mvc
 */

namespace Anunnaki\Mvc;

use Anunnaki\Db\Adapter\Mysql\ActionMysql;
use Anunnaki\Core\Config;

/**
 * Model is a class responsible to controll
 * the access to the databases
 *
 * @package		Anunnaki\Core
 * @author		Andre Naves
 */
class Model
{
	/**
	 * Holds the class to magane the database
	 *
	 * @var		Action
	 * @see		Anunnaki\Db\Adapter\Mysql
	 * @access	protected
	 */
	protected $action;
	
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
	 * @access	public
	 */
	public function __construct()
	{
		$this->config = new Config();
		if (isset($this->config->db['adapter'])) {
			switch (strtolower($this->config->db['adapter'])) {
				case 'mysql':
					$this->action = new ActionMysql($this->config);
					break;
				default:
					throw new \Exception('You must define the proprety \'Environment\Config::$db[adapter]\'', 1016);
					break;
			}
		} else {
			throw new \Exception('You must define the proprety \'Environment\Config::$db[adapter]\'', 1016);
		}
	}
}