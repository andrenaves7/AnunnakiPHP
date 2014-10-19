<?php

/**
 * Start the session
 */
session_start();

/**
 * Define timezone
 */
date_default_timezone_set('America/Sao_Paulo');

/**
 * Define the system's environment
 */
define('LIBS',        'libs/');
define('COMPONENTS',  'app/components/');
define('HELPERS',     'app/helpers/');
define('VALIDATORS',  'app/validators/');
define('LANGUAGES',   'app/languages/');
define('MODULES',     'app/modules/');

/**
 * Define the module's environment
 */
define('CONTROLLERS', 'app/modules/default/controllers/');
define('MODELS',      'app/modules/default/models/');
define('VIEWS',       'app/modules/default/views/');
define('CONFIGS',     'app/modules/default/application/');

/**
 * Import the init file
 */
require_once LIBS . 'Anunnaki/init.php';