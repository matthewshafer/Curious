<?php

class XhprofLoader
{

	private $loadedFile;
	private $withExclusive = array();
	private $overall = array();
	
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		
	}
	
	/**
	 * loadXhprofFile function.
	 * 
	 * Loads an Xhprof file at the specified file location
	 * @access public
	 * @param string $fileLoc
	 * @return True if xhprof file was able to be loaded, False if not
	 */
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
	
	/**
	 * clearStored function.
	 * 
	 * clears the stored Xhprof data
	 * @access public
	 * @return void
	 */
	public function clearStored()
	{
		$this->withExclusive = array();
		$this->overall = array();
	}
	
	/**
	 * getOverall function.
	 * 
	 * returns the overall data for the current Xhprof file
	 * @access public
	 * @return Array (empty if nothing)
	 */
	public function getOverall()
	{
		return $this->overall;
	}
	
	/**
	 * getTotals function.
	 * 
	 * returns the totals for the current Xhprof file
	 * @access public
	 * @return Array (empty if nothing)
	 */
	public function getTotals()
	{
		return $this->withExclusive;
	}

}
?>