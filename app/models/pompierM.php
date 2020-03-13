<?php
require_once(API_PATH);

class PompierModel
{
    public function __construct()
    {
    }
    public function getListe()
    {
        return API::getAllFirefighter();
    }
    public function getById($id)
    {
        return API::getPompierById($id);
    }
    public function profil()
    {
        return API::getPompierById($_SESSION["id"]);
    }
}