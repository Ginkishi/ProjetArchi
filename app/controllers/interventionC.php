<?php
class InterventionController
{

	public function __construct()
	{
	}
	public function renderview($viewname)
	{
		echo '<!doctype html>';
		echo '<html lang="fr">';
		echo '<head>';
		include VIEWS . DS . 'common' . DS . 'head.php';
		echo '</head>';
		echo '<body>';
		include VIEWS . DS . 'common' . DS . 'nav.php';

		include VIEWS . DS . 'intervention_' . strtolower($viewname) . ".php";
		include VIEWS . DS . 'common' . DS . 'bs_js.php';
		echo '<body>';
	}
	public function index()
	{
		//Pas de données à gérer
		//La vue à afficher est la vue index
		$this->renderview('ajoute');
	}
	public function add()
	{
		echo '<!doctype html>';
		echo '<html lang="fr">';
		echo '<head>';
		include VIEWS . DS . 'common' . DS . 'head.php';
		echo '<link href="' . LOCAL_VENDORS . DS . 'personal/css/intervention.css" rel="stylesheet">';
		echo '</head>';
		echo '<body>';
		echo '<div class="contain">';
		include VIEWS . DS . 'common' . DS . 'nav.php';
		echo '<div class="main">';

		include VIEWS . DS . "intervention_add.php";
		echo '</div>';
		echo '</div>';
		include VIEWS . DS . 'common' . DS . 'bs_js.php';
		echo '<body>';
	}
	public function addInterventionToBDD()
	{
		echo "coucou";
		include_once dirname(__FILE__) . "\..\models\InterventionM.php";

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
			echo "coucou1";
			/// le format de la date yyyy-mm-dd 
			/// le format de l'heure hh:mm:ss
			$InterventionModel = new InterventionM();
			$InterventionModel->AddIntervention($numIntervention, $adresse, $commune, $opm, $typeIntervention, $important, $requerant, $dateDeclenchement, $heureDeclenchement, $dateFin, $heureFin, $responsable);
		}
		/// un traiment d'erreur a effectuer apres eg: champ non rempli
		//  $Intervention = new InterventionController();
		// $Intervention->index();
	}
}