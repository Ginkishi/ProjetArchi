<?php
	require_once dirname(__FILE__) . "./config.php";
	class DBConnect
	{
		private $con;

		function __construct()
		{
		}

		function connect()
		{
			$this->con = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
			$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "Connection successfully done";

			return $this->con;
		}
	}
?>