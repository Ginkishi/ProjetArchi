<?php
	// var_dump($_SERVER);

	$id = 0;
	$i = 0;
	foreach ($records as $r) {
		if ($r["V_ID"] != $id) {
			echo "<br>";
			$id = $r["V_ID"];
			$i++;
			echo "Véhicule " . $i . " : <br>";
			echo "Modèle du véhicule : " . $r["V_MODELE"] . "<br>";
			echo "Nom du véhicule : " . $r["V_INDICATIF"] . "<br>";
			echo "Immatriculation : " . $r["V_IMMATRICULATION"] . "<br>";
			echo "Kilomètrages : " . $r["V_KM"] . "<br>";
			echo "Composition :<br>";
			echo utf8_encode($r["ROLE_NAME"]) . "<br>";
		} else {
			echo utf8_encode($r["ROLE_NAME"]) . "<br>";
		}
	}
?>