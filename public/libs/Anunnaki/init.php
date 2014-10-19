<?php

/**
 * Start the application
 */
Anunnaki_App::run();

/**
 * Include all the classes the system will use
 * 
 * @param string $class
 * @throws Anunnaki_Load_Exception
 * @return boolean
 */
function __autoload($class) {
	$fileClass = str_replace('_', '/', $class);
	$directory = array(MODELS, VIEWS, CONTROLLERS, LIBS, CONFIGS, HELPERS, VALIDATORS, COMPONENTS);

	foreach ($directory as $dir) {
		$arquivo = $dir . $fileClass . '.php';
		if (file_exists($arquivo)) {
			require_once $arquivo;
			if (class_exists($class) || interface_exists($class)) {
				return true;
			}
		}
	}

	$anunnaki_message = Anunnaki_Message::getInstance();
	throw new Anunnaki_Load_Exception(
			$anunnaki_message->getMessage('class_not_found', array('{class_name}' => $class)), 
			1001
	);
}