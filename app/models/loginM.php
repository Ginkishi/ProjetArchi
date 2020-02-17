<?php

    require_once(".." . DS . API_DIRNAME . "/API.php");

    class LoginModel {
        public function __construct(){}

        public function connect($username, $password)
        {
            if(isset($username) && !empty($username) && isset($password) && !empty($password)) {
                $record = API::getIdentification($ndc, md5($pass));
            }
        }
    }
?>