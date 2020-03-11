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
            return GestionnaireSession::aUnDesRoles("78"); // 78 = droit d'ajout au niveau de e-brigade au niveau de e-brigade
        }

        public static function aLesDroitsModification()
        {
            GestionnaireSession::ouvreSession();
            return GestionnaireSession::aUnDesRoles("79"); // 79 = droit de modification au niveau de e-brigade au niveau de e-brigade
        }

        public static function aLesDroitsSuppression()
        {
            GestionnaireSession::ouvreSession();
            return GestionnaireSession::aUnDesRoles("82"); // 82 = droit de suppression au niveau de e-brigade
        }

        public static function aLesDroitsLecture()
        {
            GestionnaireSession::ouvreSession();
            return GestionnaireSession::aUnDesRoles("81"); // 81 = droit de lecture / lecture total
        }

        public static function aLesDroitsDemandeModification()
        {
            GestionnaireSession::ouvreSession();
            return GestionnaireSession::aUnDesRoles("83");
        }

        public static function aLesDroitsValidation()
        {
            GestionnaireSession::ouvreSession();
            return GestionnaireSession::aUnDesRoles("80"); // 80 = droit de validation au niveau de e-brigade
        }

        public static function aLesDroitsExportation()
        {
            GestionnaireSession::ouvreSession();
            return GestionnaireSession::aUnDesRoles("84");
        }
    }