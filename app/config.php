<?php
	// =====================  Initialisation
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', dirname(__FILE__));
	define('ROOT_DIR', basename(__DIR__));
	define('API_DIRNAME', 'api');
	define('CONTROLLERS', ROOT.DS.'controllers');
	define('VIEWS', ROOT.DS.'views');
	define('MODELS', ROOT.DS.'models');
	define('VENDORS', ROOT.DS.'vendors');
    define('API_PATH', ROOT.DS."..".DS."api");
?>