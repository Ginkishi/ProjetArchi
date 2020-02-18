<main role="main" class="container">
    <div class="starter-template">
        <h1>Page d'accueil par défaut</h1>
        <?php
            require_once(CONTROLLERS.DS."sessionHandler.php");
            require_once(VIEWS.DS."view.php");
			GestionnaireSession::ouvreSession();
			
            if(GestionnaireSession::is_set())
            {
                echo "<p class='lead'>Bonjour ".$_SESSION["grade"]." ".$_SESSION['nom']." ".$_SESSION['prenom']."</p>";
            }
			else
			{
				$host = $_SERVER['HTTP_HOST'] . DS;
				$uri = "projetarchi" . DS . ROOT_DIR . "/login";
				$extra = "";

				header("Location: http://$host$uri$extra");
			}
        ?>
    </div>
</main><!-- /.container -->