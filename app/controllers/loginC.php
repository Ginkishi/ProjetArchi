<?php

require_once(".." . DS . API_DIRNAME . "/API.php");
require_once("./controllers/homeC.php");

class LoginController
{
    public function construct()
    {
    }

    public function renderview($viewname)
    {
        echo '<!doctype html>';
        echo '<html lang="fr">';
        echo '<head>';
        include VIEWS . DS . 'common' . DS . 'head.php';
        echo '<link href="./views/assets/css/login.css" rel="stylesheet">';
        echo '<link href="./views/assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">';
        echo '</head>';
        echo '<body>';
        include VIEWS . DS . 'login_' . strtolower($viewname) . ".php";

        include VIEWS . DS . 'common' . DS . 'bs_js.php';
        echo '</body></html>';
    }

    public function index()
    {
        $this->renderview('index');
    }

    public function authenticate()
    {
        //var_dump($_POST);
        session_start();
        if ((isset($_POST["username"]) && !empty($_POST["username"])) && isset($_POST["password"]) && !empty($_POST["password"])) {
            $ndc = $_POST["username"];
            $pass = $_POST["password"];
            $record = API::getIdentification($ndc, md5($pass));

            if (sizeof($record) == 1) {
                //var_dump($record[0]);
                $_SESSION["nom"] = $record[0]['P_NOM'];
                $_SESSION["prenom"] = $record[0]['P_PRENOM'];
                $_SESSION["grade"] = $record[0]['P_GRADE'];

                $host = $_SERVER['HTTP_HOST'] . DS;
                $uri = "projetarchi" . DS . ROOT_DIR . "/home";
                $extra = "";

                header("Location: http://$host$uri$extra");
            } else {
                $_SESSION["error_message"] = "Impossible de se connecter!";
                $login = new LoginController();
                $login->index();
            }
        } else {
            $_SESSION["error_message"] = "Veuillez entrez des identifiants de connexion";
            $login = new LoginController();
            $login->index();
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