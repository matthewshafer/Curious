<?php

abstract class BasicPlugin
{
	
	abstract function pluginName();
	
	abstract function acceptXhprofData($data);
	
	abstract function processData();
	
	abstract function getOutput();
	
	public function pluginType()
	{
		return 1;
	}

}

?>