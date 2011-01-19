<?php

class MinMax extends BasicPlugin
{

	private $xhprofDataAccess;
	private $outputData = "";
	
	public function pluginName()
	{
		return "MinMax";
	}
	
	public function acceptXhprofData(XhprofDataAccess $data)
	{
		$this->xhprofDataAccess = $data;
	}
	
	public function processData()
	{
		$runArr = array();
		$i = 1;
		
		while($this->xhprofDataAccess->nextBatch())
		{
			while($this->xhprofDataAccess->haveNextRun())
			{
				$tmp = $this->xhprofDataAccess->getCurrentRunOverall();
				array_push($runArr, $tmp["cpu"]);
			}
			
			$this->outputData = sprintf("%sRun %d had a min cpu time of %d and a max cpu time of %d\n", $this->outputData, $i, min($runArr), max($runArr));
			$runArr = array();
			$j = 0;
			$i++;
		}
	}
	
	public function getOutput()
	{
		return $this->outputData;
	}

}

?>