<?php

require_once(VIEWS . DS . "view.php");

class InterventionController
{

	public function __construct()
	{
	}
	
	
	
	public function index()
	{
		$v = new View();
		$v->ajouterLink("personal", "intervention");
		$v->afficher("intervention_ajoute");
	}
	
	public function add()
	{
		echo '<!doctype html>';
		echo '<html lang="fr">';
		echo '<head>';
		include VIEWS . DS . 'common' . DS . 'head.php';
		echo '<link href="' . LOCAL_VENDORS . DS . "personal" . DS . "css" . DS . "intervention" . '.css" rel="stylesheet">';
		echo '</head>';
		echo '<body>';
		echo '<div class="contain shadow">';
		include VIEWS . DS . 'common' . DS . 'nav.php';
		echo '<div class="main">';
		include VIEWS . DS . "intervention_add.php";
		echo '</div>';
		echo '</div>';
		include VIEWS . DS . 'common' . DS . 'bs_js.php';
		echo '</body></html>';
	}
	
	
	
	public function addInterventionToBDD()
	{

		$array = array_keys($_POST);

		foreach ($array as $value) {
			echo $value;
			echo '<br />';
		}


		include_once dirname(__FILE__) . "\..\models\InterventionM.php";
		// 1- recuperer le type d'equipe pour chaque vehicule
		$InterventionModel = new InterventionM();

		// recuperer le nombre de vehicule dans la base
		$nbv = $InterventionModel->Nbvehicule();
		// creer un tableau pour garder le nombre de vehicules du meme type utilisé lors d'une intervention
		$incremant = array();
		for ($i = 0; $i <= $nbv - 1; $i++) {
			array_push($incremant, 0);
		}
		//la composition d'equipe pour chaque vehicule 
		$composition = array();
		for ($i = 0; $i <= $nbv; $i++) {

			$composition[$i] = array();
			$team = $InterventionModel->getVehiculeById($i);
			foreach ($team as $r) {
				array_push($composition[$i], str_replace(" ", "_", (utf8_encode($r["ROLE_NAME"]))));
				//	echo $i." ".str_replace(" ","_",(utf8_encode($r["ROLE_NAME"])))."<br>";
			}
		}


		// 2- ajout a la table interventions
		if ((isset($_POST["numIntervention"]) && !empty($_POST["numIntervention"]))
			&& isset($_POST["adresse"]) && !empty($_POST["adresse"])
			&& (isset($_POST["commune"]) && !empty($_POST["commune"]))
			&& (isset($_POST["typeIntervention"]) && !empty($_POST["typeIntervention"]))
			&& (isset($_POST["dateDeclenchement"]) && !empty($_POST["dateDeclenchement"]))
			&& (isset($_POST["heureDeclenchement"]) && !empty($_POST["heureDeclenchement"]))
			&& (isset($_POST["dateFin"]) && !empty($_POST["dateFin"]))
			&& (isset($_POST["heureFin"]) && !empty($_POST["heureFin"]))
			&& (isset($_POST["responsable"]) && !empty($_POST["responsable"]))
		) {

			//"opm"
			if (isset($_POST["opm"])) {
				$opm = 1;
			} else {
				$opm = 0;
			}
			//opm
			if (isset($_POST["important"])) {
				$important = 1;
			} else {
				$important = 0;
			}

			$numIntervention = $_POST["numIntervention"];
			$adresse = $_POST["adresse"];
			$commune = $_POST["commune"];
			$typeIntervention = $_POST["typeIntervention"];
			$dateDeclenchement = $_POST["dateDeclenchement"];
			$heureDeclenchement = $_POST["heureDeclenchement"];
			$dateFin = $_POST["dateFin"];
			$heureFin = $_POST["heureFin"];
			$responsable = $_POST["responsable"];
			$requerant = $_POST["requerant"];

			/// le format de la date yyyy-mm-dd 
			/// le format de l'heure hh:mm:ss
                $status=1;
			$IDintervention = $InterventionModel->AddIntervention($numIntervention, $adresse, $commune, $opm, $typeIntervention, $important, $requerant, $dateDeclenchement, $heureDeclenchement, $dateFin, $heureFin, $responsable,$_SESSION['id'],$status);
			//  echo "id".$IDintervention."<br>";
			//3- partie ajout vehicule et equipe
			$n = $_POST["dateDepart"];
			$nbvehicule = sizeof($n);
			/// ajout vehicule
			for ($i = 0; $i < $nbvehicule; $i++) {
				$IDvehicule = isset($_POST["typeEngin"][$i]) ? $_POST["typeEngin"][$i] : NULL;

				$datedepart = $_POST["dateDepart"][$i];
				$heuredepart = $_POST["heureDepart"][$i];

				$datearrive = $_POST["dateArrivee"][$i];
				$heurearrive = $_POST["heureArrivee"][$i];

				$dateretour = $_POST["dateRetour"][$i];
				$heureretour = $_POST["heureRetour"][$i];

				if (isset($_POST["ronde"][$i])) {
					$ronde = 1;
				} else {
					$ronde = 0;
				}


				$InterventionModel->AddVehiculeUsed($IDvehicule, $IDintervention, $datedepart, $heuredepart, $datearrive, $heurearrive, $dateretour, $heureretour, $ronde);

				//  ajout de l'equipe du vehicule
				$listetosend = array();
				for ($j = 0; $j < count($composition[$IDvehicule]); $j++) {
					if (isset($_POST[$composition[$IDvehicule][$j]][$incremant[$IDvehicule]]) && !empty($_POST[$composition[$IDvehicule][$j]][$incremant[$IDvehicule]])) {
						$l = array();
						///solution temporaire !!!
						if ($composition[$IDvehicule][$j] == "chef_d'agrès" || $composition[$IDvehicule][$j] == "conducteur") {
							array_push($l, $composition[$IDvehicule][$j]);
							array_push($l, $_POST[$composition[$IDvehicule][$j]][$i]);
						} else {
							array_push($l, $composition[$IDvehicule][$j]);
							array_push($l, $_POST[$composition[$IDvehicule][$j]][$incremant[$IDvehicule]]);
						}

						array_push($listetosend, $l);
					}
				}
				$incremant[$IDvehicule]++;
				$InterventionModel->AddTeamToVehicule($IDvehicule, $IDintervention, $listetosend);
			}
		}
		// un traiment d'erreur a effectuer apres eg: champ non rempli
		//  $Intervention = new InterventionController();
		// $Intervention->index();
	}
}