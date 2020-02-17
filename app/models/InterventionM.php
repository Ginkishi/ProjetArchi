<?php
	require_once dirname(__FILE__) . "\..\connectBDD.php";
	require_once(".." . DS . API_DIRNAME . "/API.php");
	class InterventionM
	{
		private $con;

		function __construct()
		{
			$dbconnect = new DBConnect();
			$this->con = $dbconnect->connect();
			echo "je suis connecté yay 2!";
		}


		public function AddIntervention($numIntervention, $adresse, $commune,$opm,$typeIntervention,$important,$requerant,$dateDeclenchement,$heureDeclenchement,$dateFin,$heureFin,$responsable)
		{   echo "je suis connecté yay 1!";

		   echo   $numIntervention."<br>".$adresse."<br>".$commune."<br>".$typeIntervention."<br>".$dateDeclenchement."<br>".$heureDeclenchement."<br>";
		 
			echo $dateFin."<br>";
			echo $heureFin."<br>";
		   echo $responsable."<br>"; 
		   echo $typeIntervention."<br>";
			$res=explode(" ", $responsable);
		  
			$prenom=$res[0];
			$nom=$res[1];
			$datedec=$dateDeclenchement." ".$heureDeclenchement;
			$datef=$dateFin." ".$heureFin;
			//2012-12-02 00:00:00
		  $type = API::getCodeTypeIntervention($typeIntervention);
		  $idresp = API::getPompierID($prenom,$nom);
		  /* echo $idresp;
		   echo $type;
		   echo "fin";*/ 
	      $this->con->query("INSERT INTO  interventions (NIntervention, OPM, Commune, Adresse, TypeIntervention, Important, Requerant, DateDeclenchement, DateFin, IDResponsable, IDCreateur) VALUES($numIntervention,$opm,'$commune','$adresse', '$type',$important,'$requerant','$datedec','$datef',$idresp,1);");
			//echo
			$query=$this->con->query("SELECT IDIntervention FROM  interventions where NIntervention=$numIntervention AND DateDeclenchement='$datedec'");
			$ID = $query->fetch();
		    return $ID['IDIntervention'];
          
		}

		public function AddVehiculeUsed($IdVehicule,$IDintervention,$datedepart,$heuredepart,$datearrive,$heurearrive,$dateretour,$heureretour,$ronde)
		{
            //echo"je suis la";
			//echo $IdVehicule;
			//echo $IDintervention;

			//echo $datedepart;
		   // echo $heuredepart;
			$datedepart=$datedepart." ".$heuredepart;

			//echo $datearrive;
			//echo $heurearrive;
			$datearrive=$datearrive." ".$heurearrive;
			
			//echo $dateretour;
			//echo $heureretour;

			$dateretour=$dateretour." ".$heureretour;
			
			$this->con->query("INSERT INTO  `vehiculeutilise` (IDVehicule, IDIntervention, DateDepart, DateArrive, DateRetour,Ronde) VALUES($IdVehicule,$IDintervention,'$datedepart','$datearrive', '$dateretour',$ronde);");

		}
	}
?>