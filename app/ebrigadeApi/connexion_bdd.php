<?php       //fichier de paramétrage de la connexion serveur (format PDO) , appelé par connexion_bdd_singleton.php
require_once("config.php");
class Connexion
{
    public function connect()
    {
        $dsn = 'mysql:host=' . hostname . ';dbname=' . database . ';';  //$dbh = new PDO('pgsql:user=exampleuser dbname=exampledb password=examplepass');
        $user = username;
        $password = password;

        try {
            $ma_connexion_mysql = new PDO($dsn, $user, $password);
            $ma_connexion_mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            return $ma_connexion_mysql;
        } catch (PDOException $e) {
            echo "Connexion à MySQL impossible : ", $e->getMessage();
            die();
        }
    }
}