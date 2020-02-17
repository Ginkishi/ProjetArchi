<div class="vehicule-container">
    <?php
	// var_dump($_SERVER);

	$id = 0;
	$i = 0;

	foreach ($records as $r) {
		if ($r["V_ID"] != $id) {

			if ($id != 0 && $r["V_ID"] != $id) {
				echo "</ul></div></div>";
			}
			$id = $r["V_ID"];
			$i++;
			echo '<div class="vehicule-card"><div class="logo"><i class="fa fa-car fa-3x"></i></div>';
			echo '<a href="#"><div class="title">' . $r["V_INDICATIF"] . '</div></a>';
			echo '<div class="model"><span class="label">Modèle : </span>' . $r["V_MODELE"] . '</div>';
			echo '<div class="imma"><span class="label">Immatriculation : </span>' . $r["V_IMMATRICULATION"] . '</div>';
			echo '<div class="km"><span class="label">Kilometrage : </span>' . $r["V_KM"] . '</div>';
			echo '<div class="compo"><span class="label">Composition : </span><ul>';
			echo '<li>' . utf8_encode($r["ROLE_NAME"]) . '</li>';
		} else {
			echo '<li>' . utf8_encode($r["ROLE_NAME"]) . '</li>';
		}
	}
	?>
</div>