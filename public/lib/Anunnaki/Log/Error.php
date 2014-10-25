<?php
/**
 * Error class
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
 * @package		Anunnaki\Log
 */

namespace Anunnaki\Log;

use Anunnaki\Core\Config;
use Anunnaki\Log\Interfaces\Log;

/**
 * This class is responsible to logging the error messages
 * thrown by the application
 *
 * @package		Anunnaki\Log
 * @author		Andre Naves
 */
class Error extends WriteLog implements Log
{
	/**
	 * The Constructor
	 * 
	 * @param	Config $config
	 * @param	integer $code
	 * @param	string $msg
	 * @access	public
	 */
	public function __construct(Config $config, $code, $msg)
	{
		$this->config = $config;
		$this->code   = $code;
		$this->msg    = $msg;
		$this->dir    = ROOT . DS . 'log';
		$this->userIP = $_SERVER['REMOTE_ADDR'];
		$this->file   = $this->dir . DS . 'error.log.' . date('Y-m-d') . '.txt';
	}
	
	/**
	 * Write the log
	 * 
	 * @see		\Anunnaki\Log\Interfaces\Log::write()
	 * @access	public
	 */
	public function write()
	{
		if (isset($this->config->errorLog) && $this->config->errorLog === true) {
			// Create a message string
			$msg  = 'Date.: ' . date('Y-m-d H:i:s') . '; User IP.: ' . $this->userIP . '; ';
			$msg .= 'Code.: ' . $this->code . '; Msg.: ' . $this->msg . ';' . $this->br;
			
			$this->reportMsg = $msg;
			
			// Write the file
			parent::writeFile();
		}
	}
}