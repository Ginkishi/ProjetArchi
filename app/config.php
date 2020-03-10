<?php
	// =====================  Initialisation
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', dirname(__FILE__));
	define('ROOT_DIR', basename(__DIR__));
	define('API_DIRNAME', 'ComAPI');
	define('CONTROLLERS', ROOT . DS . 'controllers');
	define('VIEWS', ROOT . DS . 'views');
	define('MODELS', ROOT . DS . 'models');
	define('CLASSES', ROOT.DS.'classes');
	define('VENDORS', ROOT . DS . 'vendors');
	define('LOCAL_DIR', 'http://' . $_SERVER["HTTP_HOST"] . DS . "projetarchi" . DS . ROOT_DIR . DS);
	define('LOCAL_VENDORS', LOCAL_DIR . "vendors");
	define('LOCAL_ASSETS', LOCAL_DIR . "views" . DS . "assets");
	define('API_PATH', CLASSES . DS . API_DIRNAME . DS . "API.php");
	//// base interne
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'eintervention');
?>