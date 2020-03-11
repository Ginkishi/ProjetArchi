<div class="intervention-container">
    <div class="bandeau-title">
        <div class="logo"><i class="far fa-clipboard"></i></div>
        <div class="title">Intervention n°<?= $intervention["NIntervention"] ?></div>
    </div>
    <div class="body">
        <div class="info">
            <div id="date_dec"><span class="label">Date de d&eacute;clenchement : </span><?= $intervention["DateDeclenchement"] ?></div>
            <div id="date_fin"><span class="label">Date de fin : </span><?= $intervention["DateFin"] ?></div>
            <div id="adresse"><span class="label">Adresse : </span><?= $intervention["Adresse"] ?></div>
            <div id="commune"><span class="label">Commune : </span><?= $intervention["Commune"] ?></div>
            <div id="requerant"><span class="label">Requ&eacute;rant : </span><?= $intervention["Requerant"] ?></div>
            <div id="responsable"><span class="label">Responsable : </span><?= $intervention["IDResponsable"] ?></div>
        </div>
        <div class="vehicule"></div>
    </div>
    <?php


    ?>
    <?php var_dump($vehicules) ?>
</div>