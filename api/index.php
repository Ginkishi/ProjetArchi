<?php
error_reporting(E_STRICT | E_ALL);
date_default_timezone_set('Europe/Paris');
setlocale (LC_TIME, 'fr_FR.utf8','fra');


// =====================  Initialisation
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('CONTROLLERS', ROOT.DS.'controllers');
define('MODELS', ROOT.DS.'models');
define('CLASSES', ROOT.DS.'classes');


// =====================  Détermination du controleur à utiliser: Est-ce que j'ai un paramètre 'url' dans mon URL?
require_once CLASSES.DS.'router.php';
$router = new Routeur($_GET['url']); 

    $router->get('/pompier', function() { 
        require_once CONTROLLERS.DS.'pompierC.php';
        $p = new PompierController();
        $p->pompiers(); 
    });


    $router->get('/pompier/:id', function($id) { 
        require_once CONTROLLERS.DS.'pompierC.php';
        $p = new PompierController();
        $p->UnPompier($id); 
    });


    $router->get('/vehicule', function() {
        require_once CONTROLLERS.DS.'vehiculeC.php';
        $v = new VehiculeController();
        $v->vehicules(); 
    });


    $router->get('/vehicule/:id', function($id) {
        require_once CONTROLLERS.DS.'vehiculeC.php';
        $v = new VehiculeController();
        $v->UnVehicule($id); 
    });

     
    $router->get('/typeIntervention', function() {
        require_once CONTROLLERS.DS.'type_interventionC.php';
        $ti = new typeInterventionController();
        $ti->typesIntervention(); 
    });


    $router->get('/typeIntervention/:id', function($id) {
        require_once CONTROLLERS.DS.'type_interventionC.php';
        $ti = new typeInterventionController();
        $ti->UnTypeIntervention($id); 
    });

    
    $router->run(); 
?>