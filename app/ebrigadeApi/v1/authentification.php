<?php
include("../connexion_bdd_singleton.php");

$connection = Connexion_singleton::get_instance();

if (isset($_POST["username"]) && !empty($_POST["username"])) {
    $id = $_POST["username"];
    if (isset($_POST["password"]) && !empty($_POST["password"])) {
        $pwd = $_POST["password"];
        $query = "select P_ID, P_MDP, LENGTH(P_MDP) 'MDP_SIZE', P_PASSWORD_FAILURE from pompier where P_CODE=\"" . $id . "\"";
        $result = $connection->prepare($query);
        $result->execute();
        $row = $result->fetch();
        $P_ID = $row["P_ID"];
        $MDP_SIZE = $row["MDP_SIZE"];
        $valid =  my_validate_password($pwd, $row["P_MDP"]);
        if ($valid) {
            $host  = $_SERVER['HTTP_HOST'];
            // $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $uri   = '/projetarchi';
            $extra = 'home/index';
            header("Location: http://$host$uri/$extra");
            exit;
        } else {
            $host  = $_SERVER['HTTP_HOST'];
            // $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $uri   = '/projetarchi';
            $extra = 'index.php';
            header("Location: http://$host$uri/$extra");
            exit;
        }
    } else {
        $host  = $_SERVER['HTTP_HOST'];
        // $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $uri   = '/projetarchi';
        $extra = 'index.php';
        header("Location: http://$host$uri/$extra");
        exit;
    }
} else {
    $host  = $_SERVER['HTTP_HOST'];
    // $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $uri   = '/projetarchi';
    $extra = 'index.php';
    header("Location: http://$host$uri/$extra");
    exit;
}

function my_validate_password($password, $hash)
{
    if ($hash == md5($password))
        return true;
    if (function_exists('password_verify')) {
        if (password_verify($password, $hash))
            return true;
    }
    // if ( function_exists('mcrypt_create_iv')) {
    //     require_once('lib/PBKDF2/hash_functions.php');
    //     if (validate_password($password, $hash))
    //         return true;
    // }
    return false;
}