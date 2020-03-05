<?php
require_once(VIEWS . DS . "view.php");
require_once(MODELS . DS . "InterventionM.php");

class HomeController
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
		$v->ajouterVariable("interventions", $interventions);
		$v->ajouterVariable("numberOfIntervention", $numberOfIntervention);
		$v->ajouterLink("personal", "home2");
		$v->afficher("home_index2");
	}
}