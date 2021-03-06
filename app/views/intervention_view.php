<div class="intervention-container">
    <div class="bandeau-title">
        <div class="logo"><i class="far fa-clipboard"></i></div>
        <div class="title">Intervention n°<?= $intervention["NIntervention"] ?></div>
    </div>
    <div class="body">
        <div class="info">
            <div class="title">Informations</div>
            <div id="date_dec"><span class="label">Date de d&eacute;clenchement : </span><?= $intervention["DateDeclenchement"] ?></div>
            <div id="date_fin"><span class="label">Date de fin : </span><?= $intervention["DateFin"] ?></div>
            <div id="adresse"><span class="label">Adresse : </span><?= $intervention["Adresse"] ?></div>
            <div id="commune"><span class="label">Commune : </span><?= $intervention["Commune"] ?></div>
            <div id="type"><span class="label">Type d'intervention : </span><?= $intervention["TypeInterventionInfo"][0]["TI_DESCRIPTION"] ?></div>
            <div id="requerant"><span class="label">Requ&eacute;rant : </span><?= $intervention["Requerant"] ?></div>
            <div id="responsable"><span class="label">Responsable : </span><a
                    href="<?= LOCAL_DIR ?>pompier/view/<?= $intervention["IDResponsable"] ?>"><?= $intervention["Responsable"] ?></a></div>
            <div id="important"><span class="label">Important : </span><?= $intervention["Important"] ?></div>
            <div id="opm"><span class="label">OPM : </span><?= $intervention["OPM"] ?></div>
        </div>
        <div class="vehicule-container">
            <div class="title">V&eacute;hicule(s)</div>
            <?php foreach ($vehicules as $v) { ?>
            <div class="vehicule">
                <div class="nom"><span class="label">Nom : </span><?= $v["infoVehicule"]["V_INDICATIF"] ?></div>
                <div class="modele"><span class="label">Modèle : </span><?= $v["infoVehicule"]["V_MODELE"] ?></div>
                <div class="immatriculation"><span class="label">Immatriculation : </span><?= $v["infoVehicule"]["V_IMMATRICULATION"] ?></div>
                <div class="comp"><span class="label">Composition :</div>
                <?php foreach ($v["vehicule"] as $ve) { ?>
                <div class="poste">
                    <span class="label"><?= $ve["ROLE_NAME"] ?> : </span>
                    <?php if ($ve["pompier"] != "") { ?>
                    <a href="<?= LOCAL_DIR ?>pompier/view/<?= $ve["IDPompier"] ?>"><?= $ve["pompier"] ?></a>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php //var_dump($vehicules[0]["vehicule"])
    ?>
</div>