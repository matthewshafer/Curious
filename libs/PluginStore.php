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
		$ret = null;
		
		if($this->iterPosition < $this->pluginCount)
		{
			$ret = $this->pluginArray[$this->iterPosition];
		}
		
		$this->iterPosition++;
		
		return $ret;
	}
	
	// just for testing and whatnot.
	public function getPluginArray()
	{
		return $this->pluginArray;
	}

}
?>