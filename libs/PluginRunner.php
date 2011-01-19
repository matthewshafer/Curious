<?php

class PluginRunner
{
	private $pluginStore;
	private $xhprofDataAccess;
	
	
	public function __construct(PluginStore $ps, XhprofDataAccess $xda)
	{
		$this->pluginStore = $ps;
		$this->xhprofDataAccess = $xda;
	}
	
	public function runPlugins()
	{
		$currentPlugin = array();
		
		while(($currentPlugin = $this->pluginStore->getNextPlugin()) != null)
		{
			if($currentPlugin["type"] === 1)
			{
				$this->pluginTypeBasic($currentPlugin["plugin"]);
			}
		}
	}
	
	private function pluginTypeBasic($plugin)
	{
		printf("%s\n", $plugin->pluginName());
		
		$plugin->acceptXhprofData($this->xhprofDataAccess);
		$plugin->processData();
		printf("%s\n\n", $plugin->getOutput());
		$this->xhprofDataAccess->resetPositions();
	}
}

?>