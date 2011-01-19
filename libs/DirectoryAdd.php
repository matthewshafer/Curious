<?php

class DirectoryAdd
{
	private $dataStore;
	private $loader;
	private $id = 0;
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param mixed $d
	 * @param mixed $l
	 * @return void
	 */
	public function __construct($d, $l)
	{
		$this->dataStore = $d;
		$this->loader = $l;
	}
	
	/**
	 * parseDir function.
	 * 
	 * parses a directory for files to load
	 * @access public
	 * @param string $dirPath
	 * @return void
	 */
	public function parseDir($dirPath)
	{
		if(is_dir($dirPath) && $dir = opendir($dirPath))
		{
			while(($file = readdir($dir)) !== false)
			{
				if($file != "." && $file != ".." && $file != ".DS_Store")
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