<?php

class MinMax extends BasicPlugin
{

	private $xhprofData;
	private $outputData;
	
	public function pluginName()
	{
		return "MinMax";
	}
	
	public function acceptXhprofData($data)
	{
		$this->xhprofData = $data;
	}
	
	public function processData()
	{
		//
	}
	
	public function getOutput()
	{
		return $outputData;
	}

}

?>