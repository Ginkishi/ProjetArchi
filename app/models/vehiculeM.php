<?php
	require_once(".." . DS . API_DIRNAME . "/API.php");
	
	class VehiculeModel {
		public function __construct(){}
		public function getListe(){
			return API::getAllVehicules();
		}
	}
?>