<?php

class NinetyNinePercentMeanStdDev extends BasicPlugin
{
	private $xhprofDataAccess;
	private $outputData = "";
	
	public function pluginName()
	{
		return "Ninety Nine Percent Mean and Standard Deviation";
	}
	
	
	public function acceptXhprofData(XhprofDataAccess $data)
	{
		$this->xhprofDataAccess = $data;
	}
	
	public function getOutput()
	{
		return $this->outputData;
	}
	
	public function processData()
	{
		$runArr = array();
		$runArrCt = 0;
		
		while($this->xhprofDataAccess->nextBatch())
		{
			while($this->xhprofDataAccess->haveNextRun())
			{
				$tmp = $this->xhprofDataAccess->getCurrentRunOverall();
				array_push($runArr, $tmp["cpu"]);
				$runArrCt++;
			}
			
			sort($runArr, SORT_NUMERIC);
			
			// only keeping the fastest 99% of the data
			$nine = $this->ninetyNinePercent($runArr, $runArrCt);
			
			$mean = $this->findMean($runArr, $runArrCt);
			
			$stdDev = $this->findStandardDeviation($runArr, $runArrCt, $mean);
			
			$stdDevPercent = $this->findStandardDeviationPercent($runArr, $runArrCt, $mean, $stdDev);
			
			$format = "%s99%% of the runs happened in under %d.\n".
					"The mean of the 99%% was %d.\n".
					"The standard deviation of 99%% of the data was %d.\n".
					"The standard deviation fell within %d%% of the data.\n\n";
			
			$this->outputData = sprintf($format, $this->outputData, $nine, $mean, $stdDev, $stdDevPercent);
			$runArr = array();
			$runArrCt = 0;
		}
	}
	
	private function findMean($arr, $ct)
	{
		$tot = 0;
		
		for($i = 0; $i < $ct; $i++)
		{
			$tot += (int)$arr[$i];
		}
		
		$fin = $tot / $ct;
		
		return $fin;
	}
	
	private function findStandardDeviation($arr, $ct, $mean)
	{
		$tot = 0;
		
		if($ct > 1)
		{
			for($i = 0; $i < $ct; $i++)
			{
				$tmp = $arr[$i] - $mean;
				$tot += pow($tmp, 2);
			}
		
			$tmp = $tot / ($ct - 1);
			
			$fin = sqrt($tmp);
		
		}
		else
		{
			$fin = 0;
		}
		return $fin;
	}
	
	private function ninetyNinePercent($runArr, &$ct)
	{
		$ret = null;
		
		if($ct === 1)
		{
			$ct = 1;
			$ret = $runArr[0];
		}
		else
		{
			$ct = floor($ct * .99);
			$ret = $runArr[$ct - 1];
		}
		
		return $ret;
	}
	
	private function findStandardDeviationPercent($arr, $ct, $mean, $stdDev)
	{
		$found = 0;
		
		$plus = $mean + $stdDev;
		$minus = $mean - $stdDev;
		
		for($i = 0; $i < $ct; $i++)
		{
			if($arr[$i] >= $minus && $arr[$i] <= $plus)
			{
				$found++;
			}
		}
		
		$fin = ($found / $ct) * 100;
		
		return $fin;
	}
}

?>