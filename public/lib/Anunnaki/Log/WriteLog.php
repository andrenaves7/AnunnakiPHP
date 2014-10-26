<?php
/**
 * Write class
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

/**
 * This class is responsible write the log file.
 * You have to extend this class and you can only use this class
 * in this package
 *
 * @package		Anunnaki\Log
 * @author		Andre Naves
 * @abstract
 */
abstract class WriteLog
{
	/**
	 * Holds the configuration of the application
	 *
	 * @var		Config
	 * @see		Anunnaki\Core\Config
	 * @access	protected
	 */
	protected $config;
	
	/**
	 * Holds the code of the error
	 *
	 * @var		integer
	 * @access	protected
	 */
	protected $code;
	
	/**
	 * Holds the message of the error
	 *
	 * @var		string
	 * @access	protected
	 */
	protected $msg;
	
	/**
	 * Holds the directory of the logs
	 *
	 * @var		string
	 * @access	protected
	 */
	protected $dir;
	
	/**
	 * Holds the name of the file
	 *
	 * @var		string
	 * @access	protected
	 */
	protected $file;
	
	/**
	 * Holds the break line string
	 *
	 * @var		string
	 * @access	protected
	 */
	protected $br = "\r\n";
	
	/**
	 * Holds the user IP
	 *
	 * @var		string
	 * @access	protected
	 */
	protected $userIP;
	
	/**
	 * Holds message of the error
	 *
	 * @var		string
	 * @access	protected
	 */
	protected $reportMsg;
	
	/**
	 * Write the log file
	 * 
	 * @access	protected
	 */
	protected function writeFile()
	{
		// Verigy if the log dir exists
		if (!is_dir($this->dir)) {
			// Case there's no a log directory, we create one
			mkdir($this->dir);
		}
			
		// Open the file
		$fp = fopen($this->file, 'a');
			
		// Write the file
		$write = fwrite($fp, $this->reportMsg);
			
		// Close the file
		fclose($fp);
	}
}