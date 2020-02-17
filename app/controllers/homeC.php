<?php
require_once(VIEWS . DS . "view.php");

class HomeController
{
	public function __construct()
	{
	}

	public function index()
	{
		$v = new View();
		$v->ajouterLink("personal", "home");
		$v->afficher("home_index_v2");
	}
}