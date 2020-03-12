<?php

require_once(VIEWS . DS . "view.php");
require_once(MODELS . DS . "InterventionM.php");
require_once(CLASSES . DS . "gestionnaireGrade.php");
class InterventionController
{

	public function __construct()
	{
	}

	public function export()
	{
		if (GestionnaireGrade::aLesDroitsExportation()) {
			$v = new View();
			$v->ajouterLink("personal", "intervention_export");
			$v->ajouterScript("personal", "clock");
			$v->afficher("intervention_export");
		} else {
			$this->displayForbidden();
		}
	}


	public function array2csv($array, $datedebut, $datefin)
	{
		$fd = fopen("$datedebut$datefin.csv", "w");
		echo "Numero Intervention;Nom;Prenom;DateDebut;DateFin\n";

		foreach ($array as $v) {
			$nI = $v["NumeroIntervention"];
			$n = $v["nom"];
			$p = $v["prenom"];
			$dd = $v["dateDebut"];
			$df = $v["dateFin"];
			echo "$nI;$n;$p;$dd;$df\n";
		}

		fclose($fd);
	}

	public function download_send_headers($filename)
	{
		// disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Tue, 01 Jul 2050 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");

		// force download  
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");

		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$filename}");
		header("Content-Transfer-Encoding: binary");
	}

	public function displayForbidden()
	{
		$v = new View();
		$v->afficher("forbidden_view");
	}


	public function doexport()
	{
		$m = new InterventionM();
		$dateDebut = $_POST["date_debut"];
		$dateFin = $_POST["date_fin"];

		$tableauIntervention = $m->getInterventions($dateDebut, $dateFin);
		$array = [];
		$i = 0;
		foreach ($tableauIntervention as $rec) {
			$idInter = $rec["IDIntervention"];
			$numInter = $rec["NIntervention"];
			$IDPersonnesSurIntervention = $m->getPersonnesSurIntervention($idInter);
			foreach ($IDPersonnesSurIntervention	as $idPersonne) {
				$personne = API::getPompierById($idPersonne["IDPersonne"]);
				$nom = $personne["P_NOM"];
				$prenom = $personne["P_PRENOM"];
				//echo "$nom $prenom est sur l'intervetion $idInter<br>";
				$array[$i]["NumeroIntervention"] = $numInter;
				$array[$i]["nom"] = $nom;
				$array[$i]["prenom"] = $prenom;
				$array[$i]["dateDebut"] = $dateDebut;
				$array[$i]["dateFin"] = $dateFin;
				$i = $i + 1;
			}
		}
		$file = $this->array2csv($array, $_POST["date_debut"], $_POST["date_fin"]);
		//echo $file;
		$this->download_send_headers("$dateDebut$dateFin.csv");
	}

	public function index()
	{
		$v = new View();
		$v->ajouterLink("personal", "intervention");
		$v->afficher("intervention_ajoute");
	}
	public function view($id)
	{
		$v = new View();
		$InterventionModel = new InterventionM();
		$intervention = $InterventionModel->getInterventionById($id);
		$tousLesVehiculeIntervention = $InterventionModel->getAllVehiculeByIntervention($id);
		$v->ajouterVariable("intervention", $intervention);
		$v->ajouterVariable("vehicules", $tousLesVehiculeIntervention);
		$v->ajouterLink("personal", "intervention_view");
		$v->afficher("intervention_view");
	}


	public function add()
	{
		if (GestionnaireGrade::aLesDroitsAjout()) {
			$InterventionModel = new InterventionM();
			$typeList = $InterventionModel->getTypeInterventionList();
			$typeVehicule = $InterventionModel->getAllVehiculesIndicatif();
			$listFirefighter = $InterventionModel->getAllFirefighter();
			$v = new View();
			$v->ajouterVariable("typeList", $typeList);
			$v->ajouterVariable("typeVehicule", $typeVehicule);
			$v->ajouterVariable("listFirefighter", $listFirefighter);
			$v->ajouterLink("personal", "intervention");
			$v->afficher("intervention_add");
		} else {
			$this->displayForbidden();
		}
	}

	public function listAll()
	{
		if (GestionnaireGrade::aLesDroitsLecture()) {
			$InterventionModel = new InterventionM();
			$interventions = $InterventionModel->getAll();

			$v = new View();
			$v->ajouterVariable("interventions", $interventions);
			$v->ajouterLink("personal", "intervention");

			$v->afficher("intervention_listAll");
		} else {
			$this->displayForbidden();
		}
	}


	public function modification($id)
	{
		if (GestionnaireGrade::aLesDroitsModification()) {
			$InterventionModel = new InterventionM();
			$typeList = $InterventionModel->getTypeInterventionList();
			$typeVehicule = $InterventionModel->getAllVehiculesIndicatif();
			$listFirefighter = $InterventionModel->getAllFirefighter();
			$intervention = $InterventionModel->getInterventionById($id);
			$tousLesVehiculeIntervention = $InterventionModel->getAllVehiculeByIntervention($id);
			$v = new View();
			$v->ajouterVariable("typeList", $typeList);
			$v->ajouterVariable("typeVehicule", $typeVehicule);
			$v->ajouterVariable("intervention", $intervention);
			$v->ajouterVariable("listFirefighter", $listFirefighter);
			$v->ajouterVariable("tousLesVehiculeIntervention", $tousLesVehiculeIntervention);
			$v->ajouterLink("personal", "intervention");
			$v->afficher("intervention_modification");
		} else {
			$this->displayForbidden();
		}
	}

	public function addInterventionToBDD()
	{

		$array = array_keys($_POST);




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
			$team = $InterventionModel->getRolesById($i);
			print_r($team);
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
			$status = 0;
			$IDintervention = $InterventionModel->AddIntervention($numIntervention, $adresse, $commune, $opm, $typeIntervention, $important, $requerant, $dateDeclenchement, $heureDeclenchement, $dateFin, $heureFin, $responsable, $_SESSION['id'], $status);
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
				$apprenti = "none";
				if (!empty($_POST["apprenti"][$i])) {
					echo $_POST["apprenti"][$i];
					$apprenti = $_POST["apprenti"][$i];
				}

				$incremant[$IDvehicule]++;

				$InterventionModel->AddTeamToVehicule($IDvehicule, $IDintervention, $listetosend, $apprenti);
			}
		}
		// un traiment d'erreur a effectuer apres eg: champ non rempli
		//  $Intervention = new InterventionController();
		// $Intervention->index();
		header('Location: ' . LOCAL_DIR . DS . 'home/index');
	}

	
	public function addValidatedInterventionToBDD()
	{

		$array = array_keys($_POST);




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
			$team = $InterventionModel->getRolesById($i);
			print_r($team);
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
			$status = GestionnaireGrade::aLesDroitsValidation() ? 1 : 0;
			$IDintervention = $InterventionModel->AddIntervention($numIntervention, $adresse, $commune, $opm, $typeIntervention, $important, $requerant, $dateDeclenchement, $heureDeclenchement, $dateFin, $heureFin, $responsable, $_SESSION['id'], $status);
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
				$apprenti = "none";
				if (!empty($_POST["apprenti"][$i])) {
					echo $_POST["apprenti"][$i];
					$apprenti = $_POST["apprenti"][$i];
				}

				$incremant[$IDvehicule]++;

				$InterventionModel->AddTeamToVehicule($IDvehicule, $IDintervention, $listetosend, $apprenti);
			}
		}
		// un traiment d'erreur a effectuer apres eg: champ non rempli
		//  $Intervention = new InterventionController();
		// $Intervention->index();
		header('Location: ' . LOCAL_DIR . DS . 'home/index');
	}


	public function editinterventiontobdd($id)
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
			$IDintervention = $InterventionModel->EditIntervention($id, $numIntervention, $adresse, $commune, $opm, $typeIntervention, $important, $requerant, $dateDeclenchement, $heureDeclenchement, $dateFin, $heureFin, $responsable);
			$InterventionModel->EraseVehiculeIntervention($id);
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

				$apprenti = "none";
				if (!empty($_POST["apprenti"][$i])) {
					echo $_POST["apprenti"][$i];
					$apprenti = $_POST["apprenti"][$i];
				}

				$incremant[$IDvehicule]++;

				$InterventionModel->AddTeamToVehicule($IDvehicule, $IDintervention, $listetosend, $apprenti);
			}
		}
		// un traiment d'erreur a effectuer apres eg: champ non rempli
		// $Intervention = new InterventionController();
		// $Intervention->index();
	}

	public function editValidatedinterventiontobdd($id)
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
			$IDintervention = $InterventionModel->EditIntervention($id, $numIntervention, $adresse, $commune, $opm, $typeIntervention, $important, $requerant, $dateDeclenchement, $heureDeclenchement, $dateFin, $heureFin, $responsable);
			if (GestionnaireGrade::aLesDroitsValidation()) $InterventionModel->validateIntervention($id,1);
			$InterventionModel->EraseVehiculeIntervention($id);
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

				$apprenti = "none";
				if (!empty($_POST["apprenti"][$i])) {
					echo $_POST["apprenti"][$i];
					$apprenti = $_POST["apprenti"][$i];
				}

				$incremant[$IDvehicule]++;

				$InterventionModel->AddTeamToVehicule($IDvehicule, $IDintervention, $listetosend, $apprenti);
			}
		}
		// un traiment d'erreur a effectuer apres eg: champ non rempli
		// $Intervention = new InterventionController();
		// $Intervention->index();
	}
}