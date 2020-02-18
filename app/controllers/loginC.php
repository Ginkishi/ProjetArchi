<?php
require_once(VIEWS . DS . "view.php");
require_once(MODELS . DS . "loginM.php");
require_once("./controllers/homeC.php");

class LoginController
{
	public function __construct()
	{
	}
	public function index()
	{
		// Check if PHP session is started (start it if not already started)
		if (version_compare(phpversion(), '5.4.0', '<')) {
			if (session_id() == '') {
				session_start();
			}
		} else {
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
		}

		// Si deja connecter -> redirection vers la home page
		$v = new View();
		if (isset($_SESSION) && isset($_SESSION["nom"]) && !empty($_SESSION["nom"]) && isset($_SESSION["prenom"]) && !empty($_SESSION["prenom"]) && isset($_SESSION["grade"]) && !empty($_SESSION["grade"])) {
			$v->afficher("home_index");
		} else {
			$v->afficherLogin();
		}
	}

	public function authenticate()
	{
		if (version_compare(phpversion(), '5.4.0', '<')) {
			if (session_id() == '') {
				session_start();
			}
		} else {
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
		}

		$modele = new LoginModel();
		$record = $modele->connect($_POST["username"], $_POST["password"]);

		if (sizeof($record) == 1) {
			//var_dump($record[0]);
			$_SESSION["id"] = $record[0]['P_ID'];
			$_SESSION["code"] = $record[0]['P_CODE'];
			$_SESSION["nom"] = $record[0]['P_NOM'];
			$_SESSION["prenom"] = $record[0]['P_PRENOM'];
			$_SESSION["grade"] = $record[0]['P_GRADE'];

			$v = new View();
			$v->ajouterLink("personal", "home");
			$v->afficher("home_index");
		} else {
			$v = new View();
			$v->ajouterVariable("error_message", "Impossible de se connecter!");
			$v->afficherLogin();
		}
	}
	public function disconnect()
	{
		session_start();

		$v = new View();
		if (isset($_SESSION) && isset($_SESSION["id"]) && isset($_SESSION["code"]) && isset($_SESSION["nom"]) && isset($_SESSION["prenom"]) && isset($_SESSION["grade"])) {
			$v->ajouterVariable("sucess_message", "Vous avez bien été déconnecté!");
			unset($_SESSION);
		}
		session_destroy();
		$v->afficherLogin();
	}
}