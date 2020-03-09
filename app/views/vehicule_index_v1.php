<div class="vehicule-container">
    <?php
	// var_dump($_SERVER);

	$id = 0;
	$i = 0;

	foreach ($records as $r) {
		if ($r["V_ID"] != $id) {

			if ($id != 0 && $r["V_ID"] != $id) {
	?>
    </ul>
</div>
</div>
<?php
			}
			$id = $r["V_ID"];
			$i++; ?>
<div class="vehicule-card">
    <div class="logo"><i class="fa fa-car fa-3x"></i></div>
    <a href="#">
        <div class="title"><?= $r["V_INDICATIF"] ?></div>
    </a>
    <div class="model"><span class="label">Modèle : </span><?= $r["V_MODELE"] ?></div>
    <div class="imma"><span class="label">Immatriculation : </span><?= $r["V_IMMATRICULATION"] ?></div>
    <div class="km"><span class="label">Kilometrage : </span><?= $r["V_KM"] ?></div>
    <div class="compo"><span class="label">Composition : </span>
        <ul>
            <li><?= utf8_encode($r["ROLE_NAME"]) ?></li>
            <?php } else { ?>
            <li><?= utf8_encode($r["ROLE_NAME"]) ?></li>
            <?php }
	}
	?>
    </div>