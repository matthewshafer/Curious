<?php

require_once("NinetyNinePercentMeanStdDev.php");

$meanStdDev = new NinetyNinePercentMeanStdDev();

$this->addPlugin($meanStdDev, $meanStdDev->pluginType());

?>