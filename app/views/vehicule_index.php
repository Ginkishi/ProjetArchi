<div class="vehicule-container">
    <?php foreach ($records as $r) { ?>
    <div class="vehicule-card">
        <div class="logo"><i class="fa fa-car fa-3x"></i></div>
        <a href="<?= LOCAL_DIR ?>vehicule/view/<?= $r["V_ID"]; ?>">
            <div class="title"><?= $r["V_INDICATIF"] ?></div>
        </a>
        <div class="body">
            <div class="model"><span class="label">Modèle : </span><?= $r["V_MODELE"] ?></div>
            <div class="type"><span class="label">Type : </span><?= $r["TV_LIBELLE"] ?></div>
            <div class="imma"><span class="label">Immatriculation : </span><?= $r["V_IMMATRICULATION"] ?></div>
            <div class="km"><span class="label">Kilometrage : </span><?= $r["V_KM"] ?></div>
            <div class="annee"><span class="label">Ann&eacute;e : </span><?= $r["V_ANNEE"] ?></div>
            <div class="statut"><span class="label">Statut : </span><?= $r["VP_LIBELLE"] ?></div>
        </div>
    </div>
    <?php } ?>
</div>