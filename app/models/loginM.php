<?php

    require_once(API_PATH);

    class LoginModel {
        public function __construct(){}

        public function connect($username, $password)
        {
            if(isset($username) && !empty($username) && isset($password) && !empty($password)) {
                $record = API::getIdentification($username, $password);
                return $record;
            }
        }
    }
?>