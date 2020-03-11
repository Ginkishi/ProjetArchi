<?php
	header( 'content-type: text/html; charset=UTF-8' );
	include (API_PATH); // a modifier ....



    $typeVehicule = API::getAllVehiculesIndicatif();
        while ($donnees = $typeVehicule->fetch())
         {
            
            
            $output = htmlentities($donnees['V_ID'], 0, "UTF-8");
            if ($output == "") 
            {
             $output = htmlentities(utf8_encode($donnees['V_ID']), 0, "UTF-8"); 
            }
            echo '%'.$output;
              
            $output = htmlentities($donnees['V_INDICATIF'], 0, "UTF-8");
            if ($output == "") 
            {
             $output = htmlentities(utf8_encode($donnees['V_INDICATIF']), 0, "UTF-8"); 
            }
            echo '%'.$output;
           
         }
        

    
    
?>