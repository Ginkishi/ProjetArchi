<?php

	class SessionHandler
	{
		public function __construct()
		{
		}

		public static function ouvreSession()
		{
			if (version_compare(phpversion(), '5.4.0', '<')) {
				if(session_id() == '') {
				   session_start();
			   	}
		   	}
		   	else
		   	{
			   if (session_status() == PHP_SESSION_NONE) {
				   session_start();
			   	}
		   	}
		}

		public static function is_set()
		{
			return isset($_SESSION) && isset($_SESSION["nom"]) && !empty($_SESSION["nom"]) && isset($_SESSION["prenom"]) && !empty($_SESSION["prenom"]) && isset($_SESSION["grade"]) && !empty($_SESSION["grade"])
		}
		
		public static function un_set()
		{
			unset($_SESSION);
		}
		
		public static function detruire()
		{
			session_destroy();
		}
		
		public static function aLesRoles(...$roles)
		{
			var_dump($roles);
		}
	}
?>