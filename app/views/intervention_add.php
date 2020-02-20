<?php
	require_once(".." . DS . API_DIRNAME . DS."API.php");
	$typeList = API::getTypeInterventionList();
	$typeVehicule = API::getAllVehiculesIndicatif();
?>
<div class="form-container">
    <h1 class="header">Compte-rendu d'intervention</h1>
    <form action="#">
        <div class="section">
            <h2 class="title">Intervention</h2>
            <div class="body">
                <div class="group-champ col3">
                    <div class="champ">
                        <label for="">Numéro d'intervention</label>
                        <input type="text" autocomplete="off" name="numIntervention" required>
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Commune</label>
                        <input type="text" autocomplete="off" name="commune" required>
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Adresse</label>
                        <input type="text" autocomplete="off" name="adresse" required>
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="champ">
                    <label for="">Type d'intervention</label>
                    <select name="typeIntervention" id="typeIntervention" class="form-control">
                        <option value="">Selectionnez un type d'intervention</option>
                        <?php
                while ($donnees = $typeList->fetch())
                 {
            ?>
               <option value="
            <?php
                    
                 $output = htmlentities($donnees['TI_DESCRIPTION'], 0, "UTF-8");
                    if ($output == "") 
                    {
                     $output = htmlentities(utf8_encode($donnees['TI_DESCRIPTION']), 0, "UTF-8"); 
                    }
                    echo $output;
            ?>
                    "> 
            <?php 
                  $output = htmlentities($donnees['TI_DESCRIPTION'], 0, "UTF-8");
                    if ($output == "")
                     {
                    $output = htmlentities(utf8_encode($donnees['TI_DESCRIPTION']), 0, "UTF-8"); 
                     }
                     echo $output;
           ?> 
                 </option>
            <?php
                    }
            ?>   
                    </select>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Réquerant</label>
                        <select name="requerant" id="requerant" class="form-control">
                            <option value="">CODIS</option>
                        </select>
                    </div>
                    <div class="group-champ col2">
                        <div class="champ mycheckbox">
                            <label for="">OPM</label>
                            <input type="checkbox" name="opm" id="opm">
                        </div>
                        <div class="champ mycheckbox">
                            <label for="">Important</label>
                            <input type="checkbox" name="important" id="important">
                        </div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date déclenchement</label>
                        <input type="date" autocomplete="off" name="dateDeclenchement">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure déclenchement</label>
                        <input type="time" autocomplete="off" name="heureDeclenchement">
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date de fin</label>
                        <input type="date" autocomplete="off" name="dateFin">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure de fin</label>
                        <input type="time" autocomplete="off" name="heureFin">
                        <div class="barre"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section engin">
            <h2 class="title">Engins et Personnels</h2>
            <div class="body">
                <div class="champ">
                    <label for="">Nom du v&eacute;hicule</label>
                    <select name="typeEngin[]" id="nomEngin%0" class="form-control">
                        <option value="">Selectionnez un véhicule</option>
                    </select>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date de départ</label>
                        <input type="date" autocomplete="off" name="dateDepart[]">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure de départ</label>
                        <input type="time" autocomplete="off" name="heureDepart[]">
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date d'arrivée sur les lieux</label>
                        <input type="date" autocomplete="off" name="dateArrivee[]">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure d'arrivée sur les lieux</label>
                        <input type="time" autocomplete="off" name="heureArrivee[]">
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date de retour</label>
                        <input type="date" autocomplete="off" name="dateRetour[]">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure de retour</label>
                        <input type="time" autocomplete="off" name="heureRetour[]">
                        <div class="barre"></div>
                    </div>
                </div>
            </div>
            <button class="btn btn-danger btn-lg" id="addVehicule">Ajouter un véhicule</button>
        </div>
        <div class="section resp">
            <h2 class="title">Responsable</h2>
            <div class="body">
                <div class="champ">
                    <label for="">Nom du responsable</label>
                    <input type="text" autocomplete="off" name="responsable">
                    <div class="barre"></div>
                </div>
            </div>
        </div>
        <div class="champ">
            <input type="submit" value="Sauvegarder" class="btn btn-primary btn-lg">
        </div>
    </form>
</div>