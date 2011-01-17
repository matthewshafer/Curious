<?php

class PluginLoader
{

	private $pluginStore;
	
	public function __construct($pluginStore)
	{
		$this->pluginStore = $pluginStore;
	}
	
	
	public function loadPlugins($dirPath)
	{
		if(is_dir($dirPath) && $dir = opendir($dirPath))
		{
			while($file = readdir($dir))
			{
				if($file != "." && $file != ".." && filetype($dirPath . $file) == "dir")
				{
					if(file_exists($dirPath . $file . "/" . $file . ".Loader.php"))
					{
						include($dirPath . $file . "/" . $file . ".Loader.php");
					}
				}
			}
		}
	}
	
	
	public function addPlugin($plugin, $type)
	{
		$this->pluginStore->addPlugin($plugin, $type);
	}


}
?>