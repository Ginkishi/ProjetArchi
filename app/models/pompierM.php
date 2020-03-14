<?php
require_once(API_PATH);

class PompierModel
{
    public function __construct()
    {
    }
    public function getListe()
    {
        return API::getAllFirefighter();
    }
    public function getById($id)
    {
        return API::getPompierById($id);
    }

    public function getProfilPompier($id)
    {
        $pompier = API::getPompierById($id);
        if ($pompier["P_SEXE"] == "M") {
            $pompier["P_SEXE"] = "Masculin";
            $pompier["P_CIVILITE "] = "Monsieur";
        } else {
            $pompier["P_SEXE"] = "Feminin";
            $pompier["P_CIVILITE "] = "Madame";
        }

        foreach ($pompier["ROLE"] as $r => $v) {
            $pompier["ROLE"][$r] = API::getLibelleRole($v);
        }
        foreach ($pompier["ROLE2"] as $r => $v) {
            $pompier["ROLE2"][$r] = API::getLibelleRole($v);
        }
        return $pompier;
    }
}