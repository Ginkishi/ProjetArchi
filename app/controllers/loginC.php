<?php
	require_once(VIEWS.DS."view.php");
	require_once(MODELS.DS."loginM.php");
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
				if(session_id() == '') {
				   session_start();
			   	}
		   	}
		   	else
		   	{
			   if (session_status() == PHP_SESSION_NONE) {
				   session_start();
			   	}
		   	}

		   	// Si deja connecter -> redirection vers la home page
		   	$v = new View();
		   	if(isset($_SESSION) && isset($_SESSION["nom"]) && !empty($_SESSION["nom"]) && isset($_SESSION["prenom"]) && !empty($_SESSION["prenom"]) && isset($_SESSION["grade"]) && !empty($_SESSION["grade"]))
		   	{
			   $v->afficher("home_index");
			}
		   	else
		   	{
				$v->afficher("login_index");
		   	}
		}

		public function authenticate()
		{
			if (version_compare(phpversion(), '5.4.0', '<')) {
				if(session_id() == '') {
					session_start();
				}
			}
			else
			{
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
			}

			$modele = new LoginModel();
			$record = $modele->connect($_POST["username"], $_POST["password"]);

			if (sizeof($record) == 1) {
				//var_dump($record[0]);
				$_SESSION["nom"] = $record[0]['P_NOM'];
				$_SESSION["prenom"] = $record[0]['P_PRENOM'];
				$_SESSION["grade"] = $record[0]['P_GRADE'];

				$host = $_SERVER['HTTP_HOST'] . DS;
				$uri = "projetarchi" . DS . ROOT_DIR . "/home";
				$extra = "";

				$v = new View();
				$v->afficher("home_index");
			} else {
				$_SESSION["error_message"] = "Impossible de se connecter!";
				$v = new View();
				$v->afficher("login_index");
			}
		}
		
		public function disconnect()
		{
			session_start();
			unset($_SESSION);
			session_destroy();
			
			$host = $_SERVER['HTTP_HOST'] . DS;
			$uri = "projetarchi" . DS . ROOT_DIR . "/login";
			$extra = "";

			header("Location: http://$host$uri$extra");
		}
	}
?>