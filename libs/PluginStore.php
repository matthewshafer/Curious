<?php

class PluginStore
{

	private $pluginArray = array();
	private $pluginCount = 0;
	private $iterPosition = 0;
	
	public function __construct()
	{
		
	}
	
	public function addPlugin($plugin, $type)
	{
		$tmp = array();
		$tmp["type"] = $type;
		$tmp["plugin"] = $plugin;
		
		array_push($this->pluginArray, $tmp);
		
		// saves us from having to do count() later;
		$this->pluginCount++;
	}
	
	public function getNextPlugin()
	{
		$return = null;
		
		if($this->iterPosition < $this->pluginCount)
		{
			$return = $this->pluginArray[$this->iterPosition];
		}
	}
	
	// just for testing and whatnot.
	public function getPluginArray()
	{
		return $this->pluginArray;
	}

}
?>