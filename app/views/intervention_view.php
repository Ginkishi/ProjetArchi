<div class="intervention-container">
    <div class="bandeau-title">
        <div class="logo"><i class="far fa-clipboard"></i></div>
        <div class="title">Intervention n°<?= $intervention["NIntervention"] ?></div>
    </div>
    <div class="body">
        <div class="info"></div>
        <div class="vehicule"></div>
    </div>
    <?php

    echo $intervention["DateDeclenchement"] . "<br>";
    echo $intervention["DateFin"] . "<br>";
    echo $intervention["Adresse"] . "<br>";
    echo $intervention["Commune"] . "<br>";
    echo $intervention["Requerant"] . "<br>";
    ?>
    <?php var_dump($vehicules) ?>
</div>