<?php

namespace Anunnaki\Front;

use Anunnaki\Config\Configuration;
use Anunnaki\View\ViewController;

class Controller
{
	protected $configuration;
	
	protected $data;
	
	protected $params;
	
	public $view;
	
	public function __construct()
	{
		if ($_POST) {
			$this->params = $_POST;
		}
	}
	
	public function init()
	{
	
	}
	
	public function setData(ControllerData $data)
	{
		$this->data = $data;
	}
	
	public function setConfig(Configuration $configuration)
	{
		$this->configuration = $configuration;
	}
	
	public function startViewController()
	{
		$this->view = new ViewController($this->configuration, $this->data);
	}
}