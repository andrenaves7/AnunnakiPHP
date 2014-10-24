<?php

namespace Anunnaki\Front;

use Anunnaki\Config\Configuration;

class Bootstrap
{
	protected $controllerData;
	
	protected $configuration;
	
	public function __construct(ControllerData $controllerData, Configuration $configuration)
	{
		$this->controllerData = $controllerData;
		$this->configuration  = $configuration;
	
		$this->init();
	}
	
	protected function init()
	{
	
	}
}