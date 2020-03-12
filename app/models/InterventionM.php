<?php
require_once dirname(__FILE__) . "\..\connectBDD.php";
require_once(API_PATH);
class InterventionM
{
	private $con;

	function __construct()
	{
		$dbconnect = new DBConnect();
		$this->con = $dbconnect->connect();
	}

	public function getAll()
	{
		$query = $this->con->query("SELECT IDIntervention,NIntervention,OPM,Commune,Adresse,TypeIntervention,DateDeclenchement datedec,DateFin datefin, s.IDStatus idstatut, s.label statut FROM interventions i JOIN status s on i.IDstatus = s.IDstatus");
		$record = $query->fetchAll(PDO::FETCH_ASSOC);
		return $record;
	}
	public function getNumberOfInterventionType()
	{
		$query = $this->con->query("SELECT s.IDstatus ID,label,count(i.IDstatus) nbIntervention FROM status s left join interventions i on i.IDstatus = s.IDstatus group by label ORDER by s.IDstatus");
		$record = $query->fetchAll(PDO::FETCH_ASSOC);
		return $record;
	}

	public function getInterventions($dateDebut, $dateFin)
	{
		$query = $this->con->query("SELECT * FROM interventions
									WHERE (DateDeclenchement>='$dateDebut' AND DateFin<='$dateFin')");
		$record = $query->fetchAll(PDO::FETCH_ASSOC);
		return $record;
	}

	public function getPersonnesSurIntervention($id)
	{
		$query = $this->con->query("SELECT IDPersonne FROM personnelduvehicule WHERE (IDIntervention=$id)");
		$record = $query->fetchAll(PDO::FETCH_ASSOC);
		return $record;
	}


	public function AddIntervention($numIntervention, $adresse, $commune, $opm, $typeIntervention, $important, $requerant, $dateDeclenchement, $heureDeclenchement, $dateFin, $heureFin, $responsable, $idcreateur, $status)
	{


		//  echo   $numIntervention."<br>".$adresse."<br>".$commune."<br>".$typeIntervention."<br>".$dateDeclenchement."<br>".$heureDeclenchement."<br>";

		//	echo $dateFin."<br>";
		//	echo $heureFin."<br>";
		//  echo $responsable."<br>"; 
		//   echo $typeIntervention."<br>";
		$res = explode(" ", $responsable);

		$prenom = $res[0];
		$nom = $res[1];
		$datedec = $dateDeclenchement . " " . $heureDeclenchement;
		$datef = $dateFin . " " . $heureFin;
		//2012-12-02 00:00:00
		$idresp = API::getPompierID($prenom, $nom);
		/* echo $idresp;
		   echo $type;
		   echo "fin";*/
		$this->con->query("INSERT INTO interventions (NIntervention, OPM, Commune, Adresse, TypeIntervention, Important, Requerant, DateDeclenchement, DateFin, IDResponsable, IDCreateur,IDstatus) VALUES($numIntervention,$opm,'$commune','$adresse', '$typeIntervention',$important,'$requerant','$datedec','$datef',$idresp,$idcreateur, $status);");
		//echo
		$query = $this->con->query("SELECT IDIntervention FROM  interventions where NIntervention=$numIntervention AND DateDeclenchement='$datedec'");
		$ID = $query->fetch();
		return $ID['IDIntervention'];
	}

	public function validateIntervention($id, $ids) {
		$this->con->query("UPDATE interventions 
		  SET IDstatus = $ids
		   WHERE IDIntervention = $id");
	}


	public function EditIntervention($id, $numIntervention, $adresse, $commune, $opm, $typeIntervention, $important, $requerant, $dateDeclenchement, $heureDeclenchement, $dateFin, $heureFin, $responsable)
	{

		//  echo   $numIntervention."<br>".$adresse."<br>".$commune."<br>".$typeIntervention."<br>".$dateDeclenchement."<br>".$heureDeclenchement."<br>";

		//	echo $dateFin."<br>";
		//	echo $heureFin."<br>";
		//  echo $responsable."<br>"; 
		//   echo $typeIntervention."<br>";
		$res = explode(" ", $responsable);

		$prenom = $res[0];
		$nom = $res[1];
		$datedec = $dateDeclenchement . " " . $heureDeclenchement;
		$datef = $dateFin . " " . $heureFin;
		//2012-12-02 00:00:00
		$idresp = API::getPompierID($prenom, $nom);
		/* echo $idresp;
		   echo $type;
		   echo "fin";*/
		$this->con->query("UPDATE interventions 
		  SET NIntervention = $numIntervention,
		   OPM = $opm,
		   Commune = '$commune',
		   Adresse = '$adresse',
		   TypeIntervention = '$typeIntervention',
		   Important = $important,
		   Requerant = '$requerant',
		   DateDeclenchement = '$datedec',
		   DateFin = '$datef',
		   IDResponsable = $idresp
		   WHERE IDIntervention = $id");
		return $id;
	}


	public function EraseVehiculeIntervention($id)
	{
		$this->con->query("DELETE v,p FROM `vehiculeutilise` as v INNER JOIN `personnelduvehicule` as p on v.IDIntervention = p.IDIntervention WHERE v.IDIntervention = $id");
	}

	public function getInterventionById($id)
	{
		$query = $this->con->query("SELECT * FROM  interventions where IDIntervention=$id");
		$record = $query->fetch();
		$res = API::getPompierById($record["IDResponsable"]);
		$record["IDResponsable"] = $res["P_PRENOM"] . " " . $res["P_NOM"];
		return $record;
	}

	public function getAllVehiculeByIntervention($id)
	{

		$query = $this->con->query("SELECT * FROM  vehiculeutilise where IDIntervention=$id");

		$record = $query->fetchAll(PDO::FETCH_ASSOC);

		for ($i = 0; $i < sizeof($record); $i++) {
			$record[$i]["infoVehicule"] = API::getVehiculeById($id);
			$record[$i]["vehicule"] = API::getVehiculeInterventionById($record[$i]["IDVehicule"]);

			for ($j = 0; $j < sizeof($record[$i]["vehicule"]); $j++) {

				$query = $this->con->query("SELECT IDPersonne FROM  personnelduvehicule where IDIntervention=$id AND IDVehicule=" . $record[$i]["IDVehicule"] . " AND IDrole=" . (int) $record[$i]["vehicule"][$j]["ROLE_ID"]);
				$record2 = $query->fetch(PDO::FETCH_ASSOC);
				$np = API::getPompierById($record2["IDPersonne"]);
				$record[$i]["vehicule"][$j]["pompier"] = $np["P_PRENOM"] . " " . $np["P_NOM"];
			}
		}

		return $record;
	}



	public function AddVehiculeUsed($IdVehicule, $IDintervention, $datedepart, $heuredepart, $datearrive, $heurearrive, $dateretour, $heureretour, $ronde)
	{
		echo "je suis la" . "<br>";
		echo $IdVehicule . "<br>";
		echo $IDintervention . "<br>";

		echo $datedepart . "<br>";
		echo $heuredepart . "<br>";
		$datedepart = $datedepart . " " . $heuredepart;

		echo $datearrive . "<br>";
		echo $heurearrive . "<br>";
		$datearrive = $datearrive . " " . $heurearrive;
		echo $ronde . "<br>";
		echo $dateretour . "<br>";
		echo $heureretour . "<br>";

		$dateretour = $dateretour . " " . $heureretour;
		$sql = "INSERT INTO  `vehiculeutilise` (IDVehicule, IDIntervention, DateDepart, DateArrive, DateRetour,Ronde) VALUES($IdVehicule,$IDintervention,'$datedepart','$datearrive', '$dateretour',$ronde);";
		echo $sql;
		$this->con->query($sql);
	}


	public function Nbvehicule()
	{

		return API::getNBvehicule();
	}


	public function getVehiculeById($id)
	{


		return API::getVehiculeById($id);
	}


	public function getRolesById($id)
	{

		return API::getRolesById($id);
	}

	public function getTypeInterventionList()
	{


		return API::getTypeInterventionList();
	}

	public function getAllVehiculesIndicatif()
	{


		return API::getAllVehiculesIndicatif();
	}

	public function AddTeamToVehicule($IDvehicule, $IDintervention, $listetosend, $apprenti)
	{
		$id = API::getVehiculeTV_CODE($IDvehicule);

		for ($j = 0; $j < count($listetosend); $j++) {
			$role = str_replace("_", " ", $listetosend[$j][0]);
			// echo $role;

			$IDrole = $j + 1;
			//  echo  $IDrole;
			$pieces = explode(" ", $listetosend[$j][1]);
			$IDPompier = API::getPompierID($pieces[0], $pieces[1]);
			echo $listetosend[$j][1] . "<br>";
			$this->con->query("INSERT INTO  `personnelduvehicule` (IDVehicule, IDPersonne, IDIntervention, IDrole) VALUES($IDvehicule, $IDPompier,$IDintervention, $IDrole);");
		}
		if (strcmp($apprenti, "none") !== 0) {
			$pieces = explode(" ", $apprenti);
			$IDPompier = API::getPompierID($pieces[0], $pieces[1]);
			$req = "INSERT INTO  `personnelduvehicule` (IDVehicule, IDPersonne, IDIntervention, IDrole) VALUES($IDvehicule, $IDPompier,$IDintervention,0);";
			$this->con->query($req);
		}
	}

	function getAllFirefighter()
	{
		return API::getAllFirefighter();
	}
}