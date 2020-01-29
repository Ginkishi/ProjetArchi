<?php       //fichier de paramétrage de la connexion serveur, appelé par les différents fichier demandants la connexion
include("connexion_bdd.php");
class Connexion_singleton{
    private static $_instance;

    public static function get_instance(){
        if(is_null(self::$_instance)){
            $MaConnexion = new Connexion();
            self::$_instance=$MaConnexion->connect();
            return self::$_instance;
        }
        else {
            return self::$_instance;
        }
    }

    
}