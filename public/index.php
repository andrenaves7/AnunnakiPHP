<?php
/**
 * Requests collector
 * 
 * This file collects requests and load the framework
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
 */

/**
 * Get an AnunnakiPHP's root directory
 */
define('APP_DIR',   'app');
define('DS',        DIRECTORY_SEPARATOR);
define('ROOT',      dirname(__FILE__));
define('LIB_DIR',   'lib');
define('SEPARATOR', '\\');

/**
 * Require the App.php file
 */
require_once LIB_DIR . DS . 'Anunnaki' . DS . 'Loader' . DS . 'AutoLoader.php';

/**
 * Start the autoloader class witch is responsible
 * to load all the classes of AnunnakiPHP framework
 */
$autoLoader = new Anunnaki\Loader\AutoLoader();
$dispacher  = new Anunnaki\Core\Dispatcher($autoLoader);
$dispacher->dispatch($autoLoader);