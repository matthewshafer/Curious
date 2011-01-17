<?php

class DirectoryAdd
{
	private $dataStore;
	private $loader;
	private $id = 0;
	
	
	public function __construct($d, $l)
	{
		$this->dataStore = $d;
		$this->loader = $l;
	}
	
	public function parseDir($dirPath)
	{
		if(is_dir($dirPath) && $dir = opendir($dirPath))
		{
			while(($file = readdir($dir)) !== false)
			{
				if($file != "." && $file != "..")
				{
					$this->loader->loadXhprofFile($dirPath . "/" . $file);
					
					$this->dataStore->addLoader($this->loader, $this->id);
				}
			}
			
			$this->id++;
		}
	}

}
?>