<?php
require_once(VIEWS . DS . "view.php");
require_once(MODELS . DS . "PompierM.php");

class PompierController
{
    public function __construct()
    {
    }

    public function index()
    {

        $v = new View();
        $InterventionModel = new InterventionM();
        $interventions = $InterventionModel->getAll();
        $numberOfIntervention = $InterventionModel->getNumberOfInterventionType();
        $interventionsForUser = $InterventionModel->getInterventionForPerson($_SESSION["id"]);
        $v->ajouterVariable("interventions", $interventions);
        $v->ajouterVariable("interventionsForUser", $interventionsForUser);
        $v->ajouterVariable("numberOfIntervention", $numberOfIntervention);
        $v->ajouterLink("personal", "home");
        $v->ajouterLink("personal", "intervention_card");
        $v->ajouterScript("personal", "clock");
    }
    public function profil()
    {
        $v = new View();
        $PompierModel = new PompierModel();
        $profil = $PompierModel->getProfilPompier($_SESSION["id"]);
        $v->ajouterVariable("pompier", $profil);
        $v->ajouterLink("personal", "pompier_profil");
        $v->afficher("pompier_profil");
    }
    public function view($id)
    {
        $v = new View();
        $PompierModel = new PompierModel();
        $profil = $PompierModel->getProfilPompier($id);
        $v->ajouterVariable("pompier", $profil);
        $v->ajouterLink("personal", "pompier_profil");
        $v->afficher("pompier_profil");
    }
}