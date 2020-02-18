<?php
	header( 'content-type: text/html; charset=UTF-8' );
	include ("../../api/API.php"); // a modifier ....

	$variable = (isset($_GET["variable"])) ? $_GET["variable"] : NULL;


	if ($variable) 
    {     $typeList = API:: getTeam($variable);
        while ($donnees = $typeList->fetch())
         {
            
            
            $output = htmlentities($donnees['ROLE_NAME'], 0, "UTF-8");
            if ($output == "") 
            {
             $output = htmlentities(utf8_encode($donnees['ROLE_NAME']), 0, "UTF-8"); 
            }
            echo '%'.$output;
           
         }
        

    } 
    else 
    {
		echo "FAIL";
    }
?>
