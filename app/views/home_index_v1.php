<main role="main" class="container">
    <div class="starter-template">
        <h1>Page d'accueil par défaut</h1>
        <?php


		if (version_compare(phpversion(), '5.4.0', '<')) {
			if (session_id() == '') {
				session_start();
			}
		} else {
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
		}


		if (isset($_SESSION['nom']) && isset($_SESSION['prenom']) && isset($_SESSION['grade'])) {
			echo "<p class='lead'>Bonjour " . $_SESSION["grade"] . " " . $_SESSION['nom'] . " " . $_SESSION['prenom'] . "</p>";
		} else {
			$host = $_SERVER['HTTP_HOST'] . DS;
			$uri = "projetarchi" . DS . ROOT_DIR . "/login";
			$extra = "/disconnect";

			header("Location: http://$host$uri$extra");
		}
		?>
    </div>
</main><!-- /.container -->