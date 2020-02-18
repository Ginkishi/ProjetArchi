<?php
require_once(MODELS . DS . "vehiculeM.php");
require_once(VIEWS . DS . "view.php");

class VehiculeController
{
	private $modelVehicule;

	public function __construct()
	{
		$this->modelVehicule = new VehiculeModel();
	}

	public function index()
	{
		$records = $this->modelVehicule->getListe();
		$v = new View();
		$v->ajouterVariable("records", $records);
		$v->ajouterLink("personal", "vehicule");
		$v->afficher("vehicule_index");
	}
}