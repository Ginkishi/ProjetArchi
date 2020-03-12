<?php
    include_once("../config.php");
    require_once(API_PATH);
	header( 'content-type: text/html; charset=UTF-8' );
	 // a modifier ....



    $typeVehicule = API::getAllVehiculesIndicatif();
        foreach ($typeVehicule as $donnees)
         {
            $output = htmlentities($donnees['V_ID'], 0, "UTF-8");
            if ($output == "") 
            {
             $output = htmlentities($donnees['V_ID'], 0, "UTF-8"); 
            }
            echo '%'.$output;
              
            $output = htmlentities($donnees['V_INDICATIF'], 0, "UTF-8");
            if ($output == "") 
            {
             $output = htmlentities($donnees['V_INDICATIF'], 0, "UTF-8"); 
            }
            echo '%'.$output;
           
         }
        

    
    
?>