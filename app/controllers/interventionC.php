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
			echo '<link href="' . LOCAL_ASSETS . '/css/intervention.css" rel="stylesheet">';
			echo '</head>';
			echo '<body>';
			include VIEWS . DS . 'common' . DS . 'nav.php';

			include VIEWS . DS . "intervention_add.php";
			include VIEWS . DS . 'common' . DS . 'bs_js.php';
			echo '<body>';
		}
		public function addInterventionToBDD()
		{ echo "coucou";
			include_once dirname(__FILE__) . "\..\models\InterventionM.php";


			if ((isset($_POST["numIntervention"]) && !empty($_POST["numIntervention"])) 
				&& isset($_POST["adresse"]) && !empty($_POST["adresse"])
				&& (isset($_POST["commune"]) && !empty($_POST["commune"]))
				&& (isset($_POST["typeIntervention"]) && !empty($_POST["typeIntervention"]))
				&& (isset($_POST["dateDeclenchement"]) && !empty($_POST["dateDeclenchement"])) 
				&& (isset($_POST["heureDeclenchement"]) && !empty($_POST["heureDeclenchement"]))
				&& (isset($_POST["dateFin"]) && !empty($_POST["dateFin"])) 
				&& (isset($_POST["heureFin"]) && !empty($_POST["heureFin"]))
			    && (isset($_POST["responsable"]) && !empty($_POST["responsable"]))
				) 
				{   
					
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
				$IDintervention= $InterventionModel->AddIntervention($numIntervention, $adresse, $commune, $opm, $typeIntervention, $important, $requerant, $dateDeclenchement, $heureDeclenchement, $dateFin, $heureFin, $responsable);
                echo "id".$IDintervention."<br>";
				//partie vehicule et equipe
				$n=$_POST["dateDepart"];
				$nbvehicule=sizeof($n);
				echo $nbvehicule;
				for($i = 0; $i <$nbvehicule; $i++) 
				{
						$IDvehicule= isset($_POST["typeEngin"][$i]) ?$_POST["typeEngin"][$i] : NULL;
						
						$datedepart=$_POST["dateDepart"][$i];
						$heuredepart=$_POST["heureDepart"][$i];

						$datearrive=$_POST["dateArrivee"][$i];
						$heurearrive=$_POST["heureArrivee"][$i];

						$dateretour=$_POST["dateRetour"][$i];
						$heureretour=$_POST["heureRetour"][$i];
						if (isset($_POST["ronde"][$i])) 
						{
							$ronde = 1;
						} 
						else 
						{
							$ronde = 0;
						}
				        
	                    echo "vehicule".$IDvehicule."<br>";
						echo $datedepart."<br>";
						echo $heuredepart."<br>";
						
						echo $datearrive."<br>";
						echo $heurearrive."<br>";
						
						echo $dateretour."<br>";
						echo $heureretour."<br>";

				$InterventionModel->AddVehiculeUsed($IDvehicule,$IDintervention,$datedepart,$heuredepart,$datearrive,$heurearrive,$dateretour,$heureretour,$ronde);

				}
				
			}
			/// un traiment d'erreur a effectuer apres eg: champ non rempli
		  //  $Intervention = new InterventionController();
		   // $Intervention->index();
		}
	}
?>