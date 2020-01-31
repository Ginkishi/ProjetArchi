<?php
require_once(".." . DS . API_DIRNAME . "/API.php");
class VehiculeController
{
    public function construct()
    {
    }
    public function renderview($viewname)
    {
        $records = API::getAllVehicules();
        $id = 0;
        $i = 0;
        echo '<!doctype html>';
        echo '<html lang="fr">';
        echo '<head>';
        include VIEWS . DS . 'common' . DS . 'head.php';
        echo '</head>';
        echo '<body>';
        include VIEWS . DS . 'common' . DS . 'nav.php';

        include VIEWS . DS . 'vehicule_' . strtolower($viewname) . ".php";
        include VIEWS . DS . 'common' . DS . 'bs_js.php';

        echo '</body></html>';
    }

    public function index()
    {
        $this->renderview('index');
    }
}