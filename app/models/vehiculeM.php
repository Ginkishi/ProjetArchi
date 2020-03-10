<?php
require_once(API_PATH);

class VehiculeModel
{
	public function __construct()
	{
	}
	public function getListe()
	{
		return API::getAllVehicules();
	}
	public function getById($id)
	{
		return API::getVehiculeById($id);
	}
	public function getVehiculeRole($id)
	{
		return API::getVehiculeRole($id);
	}
}