<?php
$host="localhost";
$database="ebrigade";
$user="root";
$password="";
$connexion = new PDO('mysql:host='.$host.';dbname='.$database, $user, $password
    , array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
 
$id = $_GET[0];
$sql = "select P_PRENOM,P_NOM from pompier 
where P_PRENOM like '%".$id."%'
OR
P_NOM like '%".$id."%' 
ORDER BY P_PRENOM , P_NOM ASC ";
$query = $connexion->query($sql);
/*$return_arr = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($return_arr);
*/
$count = $query->rowCount();
if($count==0){
    echo " aucun pompier trouvé ...";
}
else
{
    while($row = $query->fetch())
    {
    echo $row["P_PRENOM"]." ".$row["P_NOM"]."\n";

    }
}
/*
$array = array();
			while($row = $query->fetch())
			{
				$array[]=$row["P_PRENOM"]." ".$row["P_NOM"]."\n";
			}
		
            echo json_encode($array);
        */
?>