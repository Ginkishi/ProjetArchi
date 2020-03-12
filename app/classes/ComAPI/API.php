<?php
include("pdo.php");
class API
{
	private static $bdd = null;

	private function __construct()
	{
	}

	private static function postRequest($url, $value)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($value));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		$con = !($server_output == false) && curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200;
		curl_close($ch);
		if ($con) {
			return json_decode($server_output, true);
		} else {
			return false;
		}
	}


	private static function getRequest($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		$con = !($server_output == false) && curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200;
		curl_close($ch);
		if ($con) {
			return json_decode($server_output, true);
		} else {
			return false;
		}
	}


	private static function checkBDD()
	{
		if (self::$bdd == null) {
			self::$bdd = BDD::getInstance();
		}
	}

	private static function cleanUserInput($input)
	{
		$input = htmlentities($input);
		return $input;
	}

	public static function getIdentification($user, $mp)
	{
		self::checkBDD();
		$user = self::cleanUserInput($user);
		$mp = self::cleanUserInput($mp);
		$url = API_URL . "auth";
		$value = array("code" => $user, "mp" => $mp);
		$res = self::postRequest($url, $value);
		return $res["pompier"];
	}

	public static function getAllVehicules()
	{
		self::checkBDD();
		//$query = self::$bdd->query("SELECT V_ID,V_INDICATIF,V_MODELE,V_IMMATRICULATION,V_KM,ROLE_NAME FROM `vehicule` v INNER JOIN type_vehicule_role tvr on tvr.TV_CODE = v.TV_CODE;");
		//$query = self::$bdd->query("SELECT V_ID ID,V_INDICATIF Nom,V_MODELE Modele,V_IMMATRICULATION Immatriculation,V_ANNEE Annee,V_KM Kilometrage,VP_LIBELLE Statut,TV_LIBELLE Type FROM vehicule v JOIN vehicule_position vp on v.VP_ID = vp.VP_ID JOIN type_vehicule tv on tv.TV_CODE = v.TV_CODE");
		$res = self::getRequest(API_URL . "vehicule");
		return $res["vehicules"];
	}

	public static function getAllVehiculesId()
	{
		self::checkBDD();
		//$query = self::$bdd->query("SELECT V_INDICATIF, V_ID FROM `vehicule`;");
		$res = self::getRequest(API_URL . "vehicule");
		return $res["vehicules"];
	}

	public static function getVehiculeById($id)
	{
		self::checkBDD();
		$id = self::cleanUserInput($id);
		//$query = self::$bdd->query("SELECT V_ID,V_INDICATIF,V_MODELE,V_IMMATRICULATION,V_ANNEE,V_KM,VP_LIBELLE,TV_LIBELLE FROM vehicule v JOIN vehicule_position vp on v.VP_ID = vp.VP_ID JOIN type_vehicule tv on tv.TV_CODE = v.TV_CODE WHERE v.V_ID = " . $id . " ;");
		$res = self::getRequest(API_URL . "vehicule/" . $id);
		return $res["vehicule"][0];
	}
	public static function getRolesById($id)
	{
		self::checkBDD();
		$id = self::cleanUserInput($id);
		//$query = self::$bdd->query("SELECT ROLE_NAME FROM `vehicule` v INNER JOIN type_vehicule_role tvr on tvr.TV_CODE = v.TV_CODE WHERE v.V_ID = " . $id . " ;");
		$res = self::getRequest(API_URL . "vehicule/" . $id);
		return $res["vehicule"][0]["ROLE"];
	}


	public static function getVehiculeInterventionById($id)
	{
		self::checkBDD();
		$id = self::cleanUserInput($id);
		//$query = self::$bdd->query("SELECT V_ID,V_INDICATIF,V_MODELE,V_IMMATRICULATION,V_KM,ROLE_NAME,ROLE_ID FROM `vehicule` v INNER JOIN type_vehicule_role tvr on tvr.TV_CODE = v.TV_CODE WHERE v.V_ID = " . $id . " ;");
		$res = self::getRequest(API_URL . "vehicule/" . $id);
		return $res["vehicule"][0]["ROLE"];
	}

	public static function getVehiculeRole($id)
	{
		self::checkBDD();
		//$query = self::$bdd->query("SELECT V_ID,ROLE_NAME,ROLE_ID FROM `vehicule` v INNER JOIN type_vehicule_role tvr on tvr.TV_CODE = v.TV_CODE WHERE v.V_ID = " . $id);
		$res = self::getRequest(API_URL . "vehicule/" . $id);
		return $res["vehicule"][0]["ROLE"];
	}


	public static function getAllUsersId()
	{
		self::checkBDD();
		//$query = self::$bdd->query("SELECT P_NOM, P_PRENOM ,P_CODE FROM `pompier`;");
		$res = self::getRequest(API_URL . "pompier");
		return $res["pompiers"];
	}

	public static function getCodeTypeIntervention($description)
	{
		self::checkBDD();
		// $query = self::$bdd->query("SELECT TI_CODE FROM `type_intervention` WHERE TI_DESCRIPTION='$description';");
		// $row = $query->fetch();
		$res = self::getRequest(API_URL . "typeIntervention");
		$res = $res["typeIntervention"];
		$i = 0;
		while ($i < sizeof($res) && $res[$i]["TI_DESCRIPTION"] != $description) {
			$i++;
		}
		return $i < sizeof($res) ? $res[$i]['TI_CODE'] : false;
	}

	public static function getPompierID($prenom, $nom)
	{
		self::checkBDD();
		//$query = self::$bdd->query("SELECT P_ID FROM `pompier` WHERE P_NOM='$nom' AND P_PRENOM='$prenom';");
		//$row = $query->fetch();
		$res = self::getRequest(API_URL . "pompier");
		$res = $res["pompiers"];
		$i = 0;
		while ($i < sizeof($res) && ($res[$i]["P_NOM"] != $nom && $res[$i]["P_PRENOM"] != $prenom)) {
			$i++;
		}
		return $i < sizeof($res) ? $res[$i]['P_ID'] : -1;
	}

	public static function getAllFirefighter()
	{
		self::checkBDD();
		//$query = self::$bdd->query( "select P_PRENOM,P_NOM from pompier;");
		$res = self::getRequest(API_URL . "pompier");
		$res = $res["pompiers"];
		$array = array();
		foreach ($res as $row) {
			$array[] = $row["P_PRENOM"] . " " . $row["P_NOM"] . "\n";
		}
		return $array;
	}
	public static function getTypeInterventionList()
	{
		self::checkBDD();
		//$query = self::$bdd->query("SELECT TI_DESCRIPTION, TI_CODE FROM `type_intervention`;");
		$res = self::getRequest(API_URL . "typeIntervention");
		return	$res["typeIntervention"];
	}

	public static function getAllVehiculesIndicatif()
	{
		self::checkBDD();
		//$query = self::$bdd->query("SELECT V_ID, V_INDICATIF FROM `vehicule`;");
		$res = self::getRequest(API_URL . "vehicule");
		return $res["vehicules"];
	}

	public static function getTeam($indicatif)
	{
		self::checkBDD();
		//$query = self::$bdd->query("SELECT ROLE_NAME  FROM `type_vehicule_role` tvr INNER JOIN vehicule v WHERE v. V_INDICATIF='$indicatif' and tvr.TV_CODE = v.TV_CODE;");
		$res = self::getRequest(API_URL . "vehicule");
		$res = $res["vehicules"];
		$i = 0;
		while ($i < sizeof($res) && $res[$i]["V_INDICATIF"] !== $indicatif) {
			$i++;
		}
		return $i < sizeof($res) ? $res[$i]["ROLE"] : false;
	}

	public static function getNBvehicule()
	{
		self::checkBDD();
		//$query = self::$bdd->query("SELECT COUNT(*) as nb FROM vehicule;");
		//$data = $query->fetch();
		//$nb = $data['nb'];
		$res = self::getRequest(API_URL . "vehicule");
		return strVal(sizeof($res["vehicules"]));
	}

	public static function getIDRole($name, $code)
	{
		self::checkBDD();
		//$query = self::$bdd->query("SELECT ROLE_ID  FROM `type_vehicule_role`  WHERE ROLE_NAME='$name' AND TV_CODE='$code'; ");
		//$row = $query->fetch();
		$res = self::getRequest(API_URL . "vehicule");
		$res = $res["vehicules"];
		$i = 0;
		$rid = -1;
		while ($i < sizeof($res) && $rid == -1) {
			if ($res[$i]["TV_CODE"] == $code) {
				$j = 0;
				while ($j < sizeof($res[$i]["ROLE"]) && $res[$i]["ROLE"][$j]["ROLE_NAME"] != $name) {
					$j++;
				}
				$rid = $j < sizeof($res[$i]["ROLE"]) ? $res[$i]["ROLE"][$j]["ROLE_ID"] : $rid;
			}
			$i++;
		}
		return $rid;
	}

	public static function getVehiculeTV_CODE($id)
	{
		self::checkBDD();
		//$query = self::$bdd->query("SELECT TV_CODE  FROM `vehicule`  WHERE V_ID=$id;");
		//$row = $query->fetch();
		$res = self::getRequest(API_URL . "vehicule/" . $id);
		return $res["vehicule"][0]['TV_CODE'];
	}



	public static function getPompierById($id)
	{
		self::checkBDD();
		$id = self::cleanUserInput($id);
		//$query = self::$bdd->query("SELECT P_PRENOM, P_NOM  FROM `pompier`  WHERE P_ID=$id;");
		$res = self::getRequest(API_URL . "pompier/" . $id);
		return $res["pompier"][0];
	}
}