<?php
	require_once(".." . DS . API_DIRNAME . "/API.php");
	require_once(VIEWS.DS."view.php");
	class VehiculeController
	{
		public function construct()
		{
		}

		public function index()
		{
			$records = API::getAllVehicules();
			
			$v = new View();
			$v->ajouterVariable("records",$records);
			$v->afficher("vehicule_index");
		}
	}
?>