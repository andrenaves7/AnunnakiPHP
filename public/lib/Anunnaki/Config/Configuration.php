<?php

namespace Anunnaki\Config;

use Environment\Config;

class Configuration extends Config
{
	private static $instance;
	
	private function __construct()
	{
		
	}
	
	public static function getInstance()
	{
		if (!is_object(self::$instance)) {
			$class          = __CLASS__;
			self::$instance = new $class();
		}
		
		return self::$instance;
	}
	
	public function __clone()
	{
		throw new ConfigException('This is not a cloneable class', 1000);
	}
}