<?php

class XhprofDataAccess
{

	private $xhprofData;
	private $batches;
	private $currentBatch = -1;
	private $currentRun = -1;
	private $currentTotalRuns = 0;
	
	
	public function __construct(XhprofDataStore $data)
	{
		$this->xhprofData = $data->getDataArray();
		$this->batches = count($this->xhprofData);
	}
	
	public function nextBatch()
	{
		$ret = false;
		if(++$this->currentBatch < $this->batches)
		{
			$ret = true;
			$this->currentTotalRuns = count($this->xhprofData[$this->currentBatch]);
			$this->currentRun = -1;
		}
		else
		{
			// just incase someone decides to call this function a bunch it shouldn't lead to the array being out of bounds
			$this->currentBatch--;
		}
		
		return $ret;
	}
	
	public function haveNextRun()
	{
		$ret = false;
		
		if(++$this->currentRun < $this->currentTotalRuns)
		{
			$ret = true;
		}
		else
		{
			// just incase someone decides to call this function a bunch it shouldn't lead to the array being out of bounds
			$thos->currentRun--;
		}
		
		return $ret;
	}
	
	public function getCurrentRunTotals()
	{
		$ret = null;
		
		if(isset($this->xhprofData[$this->currentBatch][$this->currentRun]["totals"]))
		{
			$ret = $this->xhprofData[$this->currentBatch][$this->currentRun]["totals"];
		}
		
		return $ret;
	}
	
	public function getCurrentRunOverall()
	{
		$ret = null;
		
		if(isset($this->xhprofData[$this->currentBatch][$this->currentRun]["overall"]))
		{
			$ret = $this->xhprofData[$this->currentBatch][$this->currentRun]["overall"];
		}
		
		return $ret;
	}

}
?>