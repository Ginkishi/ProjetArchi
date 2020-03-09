<?php
    require_once("sessionHandler.php");

    class GestionnaireGrade
    {
        public function __construct()
        {}

        public static function aLesDroitsAjout()
        {
            return true;
        }

        public static function aLesDroitsModification()
        {
            return true;
        }

        public static function aLesDroitsSuppression()
        {
            return true;
        }

        public static function aLesDroitsDemandeModification()
        {
            return true;
        }

        public static function aLesDroitsValidation()
        {
            return true;
        }

        public static function aLesDroitsAccesModification()
        {
            return true;
        }
    }
?>