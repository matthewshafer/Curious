<?php

class PluginStore
{

	private $pluginArray = array();
	
	public function __construct()
	{
		
	}
	
	public function addPlugin($plugin, $type)
	{
		$tmp = array();
		$tmp["type"] = $type;
		$tmp["plugin"] = $plugin;
		
		array_push($this->pluginArray, $tmp);
	}

}
?>