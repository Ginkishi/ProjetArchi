<?php
    class View 
    {
        private $listevar;
        public function __construct()
        {
            $this->listevar = [];
        }
        public function ajouterVariable($nom,$valeur)
        {
            $this->listevar[$nom] = $valeur;
        }

        public function afficher($displayfile)
        {
            extract($this->listevar);


            echo '<!doctype html>';
			echo '<html lang="fr">';
			echo '<head>';
			include VIEWS . DS . 'common' . DS . 'head.php';

            if($displayfile == "login_index")
            {
                echo '<link href="./views/assets/css/login.css" rel="stylesheet">';
                echo '<link href="./views/assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">';
                echo '</head>';
                echo '<body>';
			    include VIEWS . DS . $displayfile . ".php";
            }
            else
            {
                include VIEWS . DS . 'common' . DS . 'nav.php';
                include VIEWS . DS . strtolower($displayfile) . ".php";
            }

            include VIEWS . DS . 'common' . DS . 'bs_js.php';
			echo '</body></html>';
        }
    }
?>