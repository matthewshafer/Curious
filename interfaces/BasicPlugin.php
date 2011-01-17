<?php

interface BasicPlugin
{
	
	public function pluginName();
	
	public function acceptXhprofData($data);
	
	public function processData();
	
	public function getOutput();

}

?>