<?php
class InterventionController
{
    public function construct()
    {
    }
    public function renderview($viewname)
    {
        echo '<!doctype html>';
        echo '<html lang="fr">';
        echo '<head>';
        include VIEWS . DS . 'common' . DS . 'head.php';
        echo '</head>';
        echo '<body>';
        include VIEWS . DS . 'common' . DS . 'nav.php';

        include VIEWS . DS . 'intervention_' . strtolower($viewname) . ".php";
        include VIEWS . DS . 'common' . DS . 'bs_js.php';
        echo '<body>';
    }
    public function index()
    {
        //Pas de données à gérer
        //La vue à afficher est la vue index
        $this->renderview('index');
    }
    public function add()
    {
        echo '<!doctype html>';
        echo '<html lang="fr">';
        echo '<head>';
        include VIEWS . DS . 'common' . DS . 'head.php';
        echo '<link href="' . LOCAL_ASSETS . '/css/intervention.css" rel="stylesheet">';
        echo '</head>';
        echo '<body>';
        include VIEWS . DS . 'common' . DS . 'nav.php';

        include VIEWS . DS . "intervention_add.php";
        include VIEWS . DS . 'common' . DS . 'bs_js.php';
        echo '<body>';
    }
}