<?php

namespace Anunnaki\View;

use Anunnaki\Config\Configuration;
use Anunnaki\Front\ControllerData;
use Anunnaki\Loader\AutoLoader;

class ViewController
{
	protected $configuration;
	
	protected $data;
	
	private $renderView = true;
	
	private $renderLayout = true;
	
	private $extension = '.phtml';
	
	public function __construct(Configuration $configuration, ControllerData $data)
	{
		$this->configuration = $configuration;
		$this->data          = $data;
	}
	
	public function setRenderView()
	{
		$this->renderView = true;
	}
	
	public function setNoRenderView()
	{
		$this->renderView = false;
	}
	
	public function setRenderLayout()
	{
		$this->renderLayout = true;
	}
	
	public function setNoRenderLayout()
	{
		$this->renderLayout = false;
	}
	
	public function renderView()
	{
		if ($this->renderView) {
			$autoLoad = AutoLoader::getInstance();
			
			$appPath        = $autoLoad->getPath(APP);
			$moduleName     = $this->data->getModule();
			$controllerName = $this->data->getController();
			$actionName     = $this->data->getAction();
			
			$fileName  = $appPath . 'Modules' . DIRECTORY_SEPARATOR;
			$fileName .= $moduleName . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;
			$fileName .= 'scripts' . DIRECTORY_SEPARATOR . $controllerName . DIRECTORY_SEPARATOR;
			$fileName .= $actionName . $this->extension;
			
			if (file_exists($fileName)) {
				require_once $fileName;
			} else {
				throw new ViewException('The view file \'' . $fileName . '\' was not found', 1007);
			}
		}
	}
}