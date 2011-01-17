<?php

require_once("MinMax.php");

$minMax = new MinMax();

$this->addPlugin($minMax, $minMax->pluginType());

?>