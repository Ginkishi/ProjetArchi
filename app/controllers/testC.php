<?php
class TestController
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
        echo '<link href="./views/assets/css/login.css" rel="stylesheet">';
        echo '<link href="./views/assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">';
        echo '</head>';
        echo '<body>';
        // include VIEWS . DS . 'common' . DS . 'nav.php';

        include VIEWS . DS . 'test_' . strtolower($viewname) . ".php";
        include VIEWS . DS . 'common' . DS . 'bs_js.php';
        echo '<body></html>';
    }
    public function edit()
    {
        //Pas de données à gérer
        //La vue à afficher est la vue index
        $this->renderview('edit');
    }
}