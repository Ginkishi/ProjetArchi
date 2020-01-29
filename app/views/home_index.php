<main role="main" class="container">
    <div class="starter-template">
        <h1>Page d'accueil par défaut</h1>
        <?php
            session_start();
            if(isset($_SESSION['nom']) && isset($_SESSION['prenom']) && isset($_SESSION['grade']))
            {
                echo "<p class='lead'>Bonjour ".$_SESSION["grade"]." ".$_SESSION['nom']." ".$_SESSION['prenom']."</p>";
            }
        ?>
    </div>
</main><!-- /.container -->