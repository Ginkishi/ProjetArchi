<div class="vehicule-container">
    <?php foreach ($records as $r) { ?>
    <div class="vehicule-card">
        <div class="logo"><i class="fa fa-car fa-3x"></i></div>
        <a href="<?= LOCAL_DIR ?>vehicule/view/<?= $r["ID"]; ?>">
            <div class="title"><?= $r["Nom"] ?></div>
        </a>
        <div class="body">
            <div class="model"><span class="label">Modèle : </span><?= $r["Modele"] ?></div>
            <div class="type"><span class="label">Type : </span><?= utf8_encode($r["Type"]) ?></div>
            <div class="imma"><span class="label">Immatriculation : </span><?= $r["Immatriculation"] ?></div>
            <div class="km"><span class="label">Kilometrage : </span><?= $r["Kilometrage"] ?></div>
            <div class="annee"><span class="label">Ann&eacute;e : </span><?= $r["Annee"] ?></div>
            <div class="statut"><span class="label">Statut : </span><?= utf8_encode($r["Statut"]) ?></div>
        </div>
    </div>
    <?php } ?>
</div>