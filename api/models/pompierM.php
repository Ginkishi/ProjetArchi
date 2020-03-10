<?php
include("pdo.php");
class Pompier {
  public function __construct(){}

  private static function cleanUserInput($input)
	{
		$input = htmlentities($input);
		return $input;
	}

  public function listAllPompier() {
    $sql="SELECT P_ID,P_CODE,P_NOM, P_PRENOM, P_PRENOM2, P_SEXE, P_CIVILITE , P_GRADE, GP_ID, GP_ID2 FROM `pompier`;";
    $dbh = BDD::getInstance();
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  public function listAllRole($hab) {
    $sql="SELECT F_ID FROM `habilitation` WHERE GP_ID = ". $hab . " ORDER BY F_ID ASC;";
    $dbh = BDD::getInstance();
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
  }


}
?>