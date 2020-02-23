<?php
require_once("config.php");
require_once(CONTROLLERS . DS . "sessionHandler.php");

error_reporting(E_STRICT | E_ALL);
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

$existingController = ["home", "intervention", "login", "vehicule", "test"];

// =====================  Détermination du controleur à utiliser: Est-ce que j'ai un paramètre 'c' dans mon URL?
if (isset($_GET['c']) && !empty($_GET['c'])) {
	//Il y a un paramètre de précisé: c'est le nom du controleur demandé.
	$controller = strtolower(trim($_GET['c']));

	// Si le controleur qu'on essaye d'acceder n'existe pas, on redirigera vers home/index
	if (!in_array($controller, $existingController)) {
		$controller = "home";
		$_GET['m'] = "index";
	}
} else {
	//Pas de paramètre => le contrôleur par défaut est le contrôleur HOME
	$controller = 'login';
}

// =====================  Détermination de la méthode à appeler: Est-ce que j'ai un paramètre 'm' dans mon URL?
if (isset($_GET['m']) && !empty($_GET['m'])) {
	//Il y a un paramètre de précisé: c'est le nom de la méthode demandée.
	$method = strtolower(trim($_GET['m']));
} else {
	//Pas de paramètre => la méthode par défaut est la méthode INDEX
	$method = 'index';
}


if (isset($_GET['id']) && !empty($_GET['id'])) {
	//Il y a un paramètre de précisé: c'est le nom de la méthode demandée.
	$id = strtolower(trim($_GET['id']));
} else {
	//Pas de paramètre => la méthode par défaut est la méthode INDEX
	$id = null;
}


if ($controller != "login") {
	GestionnaireSession::ouvreSession();
	if (!GestionnaireSession::is_set()) {
		$controller = "login";
		$method = "index";
	}
}

// =====================  Appel
//On construit le nom du fichier qui contient le contrôleur appelé (ou le contrôleur par défaut)
$controllerfilename = $controller . 'C.php';
//On inclut les fichiers nécessaires
include CONTROLLERS . DS . $controllerfilename;
//On construit le nom de la classe que l'on va instancier
$controllerclassname = ucfirst($controller) . 'Controller';
//On instancie cette classe
$c = new $controllerclassname();
//On appelle la méthode demandée (ou la méthode par défaut)
$c->$method($id);