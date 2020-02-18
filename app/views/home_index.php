<?php
setlocale(LC_TIME, "fr_FR");

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

?>
<div class="home-container">
    <h2 class="home-title"><img class="home-logo" src="../vendors/personal/img/CH-ENF-192_white.png" alt=""> eIntervention</h2>
    <h3 class="datenow"> Aujourd'hui, nous sommes le <?= utf8_encode(strftime(" %A %e %B %Y")); ?></h3>
    <?= "<p class='lead'>Bonjour " . $_SESSION["grade"] . " " . $_SESSION['nom'] . " " . $_SESSION['prenom'] . "</p>";  ?>
    <div class="intervention-container">
        <div class="valid-intervention">
            <div class="intervention-title">Interventions validées</div>
            <div class="icon">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
            </div>
            <div class="see-more"><a href="#">Voir plus</a></div>
        </div>
        <div class="public-intervention">
            <div class="intervention-title">Dernières interventions</div>
            <div class="icon">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
            </div>
            <div class="see-more"><a href="#">Voir plus</a></div>
        </div>
        <div class="warning-intervention">
            <div class="intervention-title">Interventions en attente</div>
            <div class="icon">
                <i class="fa fa-clock" aria-hidden="true"></i>
            </div>
            <div class="number">53</div>
            <div class="see-more"><a href="#">Voir plus</a></div>
        </div>
        <div class="fail-intervention">
            <div class="intervention-title">Interventions non validé</div>
            <div class="icon">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
            </div>
            <div class="see-more"><a href="#">Voir plus</a></div>
        </div>
    </div>
</div>
<?php
} else {
    $host = $_SERVER['HTTP_HOST'] . DS;
    $uri = "projetarchi" . DS . ROOT_DIR . "/login";
    $extra = "/disconnect";

    header("Location: http://$host$uri$extra");
}
?>