<?php

class WhatsTheDifference
{

	public function __construct()
	{
	
	}
	
	
	public function percentDifferenceFromArray(array $arr, $fromFirst = true)
	{
		$len = count($arr);
		$ret = array();
		$tmp;
		
		if($len > 1)
		{
			for($i = 0; $i < $len; $i++)
			{
				if($i === 1)
				{
					$tmp = floatval($arr[$i]);
				}
				else
				{
					// we shouldn't need to check for negative values because you shouldn't have a negative value as the run time of a function
					// that would mean it finished before you called it.
					// you can have a negative percent, which means things got slower.
					
					if(floatval($arr[$i]) > $tmp)
					{
						$push = $this->makeNegative(floatval($arr[$i]) / $tmp);
						array_push($ret, $push);
					}
					else
					{
						array_push($ret, $tmp / floatval($arr[$i]));
					}
				}
				
				// I relaize we would hit this twice on the first run, but that shouldnt be a huuuuuuuge deal.
				if(!$fromFirst)
				{
					$tmp = $arr[$i];
				}
			}
		}
		else
		{
			throw new Exception("Array has less than two elements.");
		}
		
		return $ret;
	}
	
	public function percentDifference($var1, $var2)
	{
		$float1 = floatval($var1);
		$float2 = floatval($var2);
		
		$ret;
		
		if($float2 > $float1)
		{
			$ret = $this->makeNegative($float2 / $float1);
		}
		else
		{
			$ret = $float1 / $float2;
		}
		
		return $ret;
	}
	
	private function makeNegative(float $val)
	{
		// would be sweet if this works, I have yet to test it though
		$tmp = sprintf("-%f", $val);
		
		return floatval($tmp);
	}
}

?>