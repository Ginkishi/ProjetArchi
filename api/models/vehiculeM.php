<?php
include("pdo.php");
class Vehicule {
  public function __construct(){}

  private static function cleanUserInput($input)
	{
		$input = htmlentities($input);
		return $input;
	}

  public function listAllVehicule() {
    $sql="SELECT V_ID, V_INDICATIF, V_MODELE, V_IMMATRICULATION, V_KM, TV_CODE FROM `vehicule`;";
    $dbh = BDD::getInstance();
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  public function listAllRole($tvCode) {
    $sql="SELECT ROLE_ID, ROLE_NAME FROM `type_vehicule_role` WHERE TV_CODE = \"". $tvCode . "\" ORDER BY ROLE_ID ASC;";
    $dbh = BDD::getInstance();
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
  }


}
?>