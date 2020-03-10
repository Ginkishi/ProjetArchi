<?php
    require_once("sessionHandler.php");

    class GestionnaireGrade
    {
        public function __construct()
        {}
        // 13 40 et 44 peuvent être utile pour lecture / validation
        public static function aLesDroitsAjout()
        {
            GestionnaireSession::ouvreSession();
            return GestionnaireSession::aUnDesRoles("15");
        }

        public static function aLesDroitsModification()
        {
            return GestionnaireGrade::aLesDroitsAjout(); // Les droits de modification et d'ajout sont les mêmes
        }

        public static function aLesDroitsSuppression()
        {
            GestionnaireSession::ouvreSession();
            return GestionnaireSession::aUnDesRoles("19");
        }

        public static function aLesDroitsLecture()
        {
            GestionnaireSession::ouvreSession();
            return GestionnaireSession::aUnDesRoles("40", "44"); // 40 & 44 = droit de lecture / lecture total
        }

        public static function aLesDroitsDemandeModification()
        {
            GestionnaireSession::ouvreSession();
            return true;
        }

        public static function aLesDroitsValidation()
        {
            GestionnaireSession::ouvreSession();
            return GestionnaireSession::aUnDesRoles("13");
        }
    }
?>