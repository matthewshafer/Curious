<?php

class XhprofDataStore
{
	private $dataArr = array();
	private $currRun = 0;
	private $maxRun;

	public function __construct($diffRunAmount = 2)
	{
		$this->maxRun = $diffRunAmount;
		
		for($i = 0; $i < $diffRunAmount; $i++)
		{
			$this->dataArr[$i] = array();
		}
	}
	
	public function addLoader($loader, $id)
	{
		print_r($this->dataArr);
		$tmpArr = array();
		$tmpArr["overall"] = $loader->getOverall();
		$tmpArr["totals"] = $loader->getTotals();
		
		$loader->clearStored();
		
		array_push($this->dataArr[$id], $tmpArr);
		
		print_r($this->dataArr);
	}


}
?>