<?php

class XhprofLoader
{

	private $loadedFile;
	private $withExclusive = array();
	private $overall = array();

	public function __construct()
	{
		
	}
	
	public function loadXhprofFile($fileLoc)
	{
		$ret = false;
		
		
		if(file_exists($fileLoc))
		{
			$file = fopen($fileLoc, 'r');
			flock($file, LOCK_SH);
			$size = filesize($fileLoc);
			if($size != 0)
			{
				// need to find out what unseralize returns when it doesnt work
				$this->loadedFile = unserialize(fread($file, filesize($fileLoc)));
				
				if($this->loadedFile != false)
				{
					$ret = true;
				
					$this->withExclusive = xhprof_compute_flat_info($this->loadedFile, $this->overall);
				}
			}
			flock($file, LOCK_UN);
			fclose($file);
			
			//print_r($this->loadedFile);

		}
		
		return $ret;
	}
	
	public function clearStored()
	{
		$this->withExclusive = array();
		$this->overall = array();
	}
	
	public function getOverall()
	{
		return $this->overall;
	}
	
	public function getTotals()
	{
		return $this->withExclusive;
	}

}
?>