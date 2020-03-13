<?php
require_once(CLASSES . DS . "sessionHandler.php");
GestionnaireSession::ouvreSession();
setlocale(LC_TIME, "fr_FR");

?>
<div class="bandeau">
    <div class="bandeau-title">
        <div class="logo"><i class="fas fa-dragon"></i></div>
        <div class="title">eIntervention</div>
    </div>
    <div class="clocks">
        <div class="time" id="time">00:00</div>
        <div class="date">03 Mar 2020</div>
    </div>
</div>
<div class="cards-container">
    <div class="cards warn">
        <div class="logo"><a href="#"><i class="far fa-pause-circle"></i></a></div>
        <div class="body">
            <div class="title">En attente :
            </div>
            <div class="number"><?= $numberOfIntervention[0]["nbIntervention"] ?> </div>
        </div>
    </div>
    <div class="cards danger">
        <div class="logo"><a href="#"><i class="far fa-times-circle"></i></a></div>
        <div class="body">
            <div class="title">Non Validé :</div>
            <div class="number"><?= $numberOfIntervention[3]["nbIntervention"] ?> </div>
        </div>
    </div>
    <div class="cards valid">
        <div class="logo"><a href="<?= LOCAL_DIR ?>intervention/listValid"><i class="far fa-check-circle"></i></a></div>
        <div class="body">
            <div class="title">Validé :</div>
            <div class="number"><?= $numberOfIntervention[1]["nbIntervention"] + $numberOfIntervention[4]["nbIntervention"] ?> </div>
        </div>
    </div>
</div>
<div class="last-intervention">
    <div class="title">Derni&egrave;res interventions</div>
    <div class="grille">
        <?php if ($interventionsForUser != null) foreach ($interventionsForUser as $i) { ?>
        <div class="cards">
            <!-- <div class="logo"><i class="far fa-clipboard"></i></div> -->
            <div class="info">
                <div class="number"><?= $i["NIntervention"] ?></div>
                <div class="dateIntervention">
                    <div class="dateDec"><?= $i["DateDeclenchement"] ?></div>
                    <div class="dateFin"><?= $i["DateFin"] ?></div>
                </div>
                <div class="location">
                    <div class="adresse"><?= $i["Adresse"] ?></div>
                    <div class="commune"><?= $i["Commune"] ?></div>
                </div>
                <div class="type"><?= $i["TypeIntervention"] ?></div>
                <!-- <div class="statut">Validé responsable</div> -->
                <a href="<?= LOCAL_DIR ?>intervention/view/<?= $i["IDIntervention"]; ?>" class="see-more">Voir</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>