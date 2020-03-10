<?php
include("pdo.php");
class TypeIntervention {
  public function construct(){}

  private static function cleanUserInput($input)
	{
		$input = htmlentities($input);
		return $input;
	}

  public function listAll() {
    $sql='SELECT * FROM type_intervention';
    $dbh = BDD::getInstance();
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
  }


}
?>