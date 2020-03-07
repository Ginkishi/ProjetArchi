<div class="title"><?= $vehicule["V_INDICATIF"] ?></div>
<div class="model"><span class="label">Modèle : </span><?= $vehicule["V_MODELE"] ?></div>
<div class="type"><span class="label">Type : </span><?= utf8_encode($vehicule["TV_LIBELLE"]) ?></div>
<div class="imma"><span class="label">Immatriculation : </span><?= $vehicule["V_IMMATRICULATION"] ?></div>
<div class="km"><span class="label">Kilometrage : </span><?= $vehicule["V_KM"] ?></div>
<div class="annee"><span class="label">Ann&eacute;e : </span><?= $vehicule["V_ANNEE"] ?></div>
<div class="statut"><span class="label">Statut : </span><?= utf8_encode($vehicule["VP_LIBELLE"]) ?></div>
<div class="comp"><span class="label">Composition : </span></div>
<ul>
    <?php foreach ($roles as $r) { ?>
    <li class="vehicule-role"><?= utf8_encode($r["ROLE_NAME"]) ?></li>
    <?php } ?>
</ul>