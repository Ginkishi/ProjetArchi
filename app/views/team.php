<?php
header('content-type: text/html; charset=UTF-8');
include_once("../config.php");
include(API_PATH); // a modifier ....

$variable = (isset($_GET["variable"])) ? $_GET["variable"] : NULL;


if ($variable) {
  $typeList = API::getTeam($variable);
  foreach ($typeList as $donnees) {


    $output = htmlentities($donnees['ROLE_NAME'], 0, "UTF-8");
    if ($output == "") {
      $output = htmlentities($donnees['ROLE_NAME'], 0, "UTF-8");
    }
    echo '%' . $output;
  }
} else {
  echo "FAIL";
}