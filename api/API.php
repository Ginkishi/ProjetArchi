<?php
include("pdo.php");
class API
{
	private static $bdd = null;

	private function __construct()
	{
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
		$query = self::$bdd->query("select P_NOM, P_PRENOM , P_GRADE from `pompier` where P_CODE='" . $user . "' and P_MDP='" . $mp . "';");
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	public static function getAllVehicules()
	{
		self::checkBDD();
		$query = self::$bdd->query("SELECT V_ID,V_INDICATIF,V_MODELE,V_IMMATRICULATION,V_KM,ROLE_NAME FROM `vehicule` v JOIN type_vehicule_role tvr on tvr.TV_CODE = v.TV_CODE;");
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
}