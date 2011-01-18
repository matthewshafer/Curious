<?php

/**
 * Abstract BasicPlugin class.
 * 
 * The plugin gets all the data from all of the different xhprof runs
 * @abstract
 */
abstract class BasicPlugin
{
	private $difference;
	
	public function __construct()
	{
		$this->difference = new WhatsTheDifference();
	}
	/**
	 * pluginName function.
	 * 
	 * @access public
	 * @abstract
	 * @return void
	 */
	abstract function pluginName();
	
	/**
	 * acceptXhprofData function.
	 * 
	 * @access public
	 * @abstract
	 * @param XhprofDataAccess $data
	 * @return void
	 */
	abstract function acceptXhprofData(XhprofDataAccess $data);
	
	/**
	 * processData function.
	 * 
	 * @access public
	 * @abstract
	 * @return void
	 */
	abstract function processData();
	
	/**
	 * getOutput function.
	 * 
	 * @access public
	 * @abstract
	 * @return String
	 */
	abstract function getOutput();
	
	/**
	 * pluginType function.
	 * 
	 * @access public
	 * @return Integer
	 */
	public function pluginType()
	{
		return 1;
	}

}

?>