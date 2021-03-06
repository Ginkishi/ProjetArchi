<?php

class GestionnaireSession
{
	public function __construct()
	{
	}

	public static function ouvreSession()
	{
		if (version_compare(phpversion(), '5.4.0', '<')) {
			if (session_id() == '') {
				session_start();
			}
		} else {
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
		}
	}


	public static function initializeSession($id, $code, $nom, $prenom, $grade, $roles, $roles2)
	{
		$_SESSION["id"] = $id;
		$_SESSION["code"] = $code;
		$_SESSION["nom"] = $nom;
		$_SESSION["prenom"] = $prenom;
		$_SESSION["grade"] = $grade;
		$_SESSION["roles"] = $roles;
		$_SESSION["roles2"] = $roles2;
	}


	public static function is_set()
	{
		return (isset($_SESSION) && isset($_SESSION["nom"]) && !empty($_SESSION["nom"]) && isset($_SESSION["prenom"]) && !empty($_SESSION["prenom"]) && isset($_SESSION["grade"]) && !empty($_SESSION["grade"]));
	}

	public static function un_set()
	{
		unset($_SESSION);
	}

	public static function detruire()
	{
		session_destroy();
	}

	private static function array_values_identical($a, $b)
	{
		$x = array_values($a);
		$y = array_values($b);

		sort($x);
		sort($y);

		return $x === $y;
	}

	private static function hasIntersection($arr1, $arr2)
	{
		foreach ($arr1 as $val1) {
			foreach ($arr2 as $val2) {
				if ($val1 == $val2) {
					return true;
				}
			}
		}
		return false;
	}

	public static function aTousLesRoles(...$roles)
	{
		return GestionnaireSession::array_values_identical($roles, $_SESSION["roles"]) || GestionnaireSession::array_values_identical($roles, $_SESSION["roles2"]);
	}

	public static function aUnDesRoles(...$roles)
	{
		return GestionnaireSession::hasIntersection($roles, $_SESSION["roles"]) || GestionnaireSession::hasIntersection($roles, $_SESSION["roles2"]) ;
	}
}
