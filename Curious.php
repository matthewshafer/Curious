<?php

require_once("config.php");

$xhprofLibDir .= "utils/xhprof_lib.php";


// the xhprof_lib.php is procedural, not oo.  So we can bring it in here and then use it in other places in the app.
require_once($xhprofLibDir);

require_once("./libs/PluginStore.php");
require_once("./libs/PluginLoader.php");
$pluginStore = new PluginStore();
$pluginLoader = new PluginLoader($pluginStore);
$pluginLoader->loadPlugins("plugins/");

require_once("./libs/XhprofLoader.php");
require_once("./libs/XhprofDataStore.php");
require_once("./libs/DirectoryAdd.php");

$dataStore = new XhprofDataStore();
$loader = new XhprofLoader();
$directoryAdder = new DirectoryAdd($dataStore, $loader);
$directoryAdder->parseDir("./first");



?>