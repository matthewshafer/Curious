<?php

require_once("MeanStdDev.php");

$meanStdDev = new MeanStdDev();

$this->addPlugin($meanStdDev, $meanStdDev->pluginType());

?>