<!--version 1 -->
<?php
require_once(".." . DS . API_DIRNAME . "/API.php");
$typeList = API::getTypeInterventionList();
$typeVehicule = API::getAllVehiculesIndicatif();
?>
<div class="form-container">
    <div class="formulaire">
        <h2>Compte-rendu d'intervention</h2>
        <form action="../intervention/addinterventiontobdd" method="post">
            <div class="section">
                <h3>INTERVENTION</h3>
                <div class="txtb"><input type="text" placeholder="Numéro d'intervention"><span></span></div>
                <div class="check"><input type="checkbox" id="opm" name="opm"><label for="opm">OPM</label></div>
                <div class="txtb"><input type="text" placeholder="Adresse"><span></span></div>
                <div class="txtb"><input type="text" placeholder="Commune"><span></span></div>
                <div class="txtb"><input type="text" placeholder="Type d'intervention"><span></span></div>
                <div class="check"><input type="checkbox" id="important" name="important"><label for="important">Important</label></div>
                <div class="select"> <label for="">Requ&eacute;rant <span class="important">*</span>: </label><select name="requerant" id="requerant">
                        <option value="">CODIS</option>
                        <?php
                        while ($donnees = $typeList->fetch()) {
                        ?>
                        <option value="<?php

                                            $output = htmlentities($donnees['TI_DESCRIPTION'], 0, "UTF-8");
                                            if ($output == "") {
                                                $output = htmlentities(utf8_encode($donnees['TI_DESCRIPTION']), 0, "UTF-8");
                                            }
                                            echo $output;
                                            ?>">
                            <?php
                                $output = htmlentities($donnees['TI_DESCRIPTION'], 0, "UTF-8");
                                if ($output == "") {
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
                <!-- <label for="">Important : <input type="checkbox" name="important"></label>
                <label for="">Requ&eacute;rant <span class="important">*</span>: <select name="requerant" id="requerant">
                        <option value="CODIS">CODIS</option>
                        <option value="Alerte Locale">Alerte locale</option>
                    </select></label> -->
                <div class="txtb"><label for="">Date de déclenchement <span class="important">*</span>: </label><input type="date" name="dateDeclenchement"
                        placeholder="Date de déclenchement" value="<?php echo date('Y-m-d'); ?>"><span></span></div>
                <div class="txtb"><label for="">Heure de déclenchement <span class="important">*</span>: </label><input type="time" name="heureDeclenchement"
                        placeholder="Heure de déclenchement" value="<?php echo  date('H:i'); ?>"><span></span></div>
                <div class="txtb"><label for="">Date de fin <span class="important">*</span>: </label><input type="date" name="dateFin" placeholder="Date de fin"
                        value="<?php echo date('Y-m-d'); ?>"><span></span></div>
                <div class="txtb"><label for="">Heure de fin <span class="important">*</span>: </label><input type="time" name="heureFin" placeholder="Heure de fin"
                        value="<?php echo  date('H:i'); ?>"><span></span></div>
            </div>
            <div class="section">
                <h3>ENGINS ET PERSONNEL</h3>
                <label for="">Nom de l'engin : <select name="typeEngin" id="nomEngin">
                        <option value="">Selectionner un v&eacute;hicule</option>
                        <?php
                        while ($vehicule = $typeVehicule->fetch()) {
                        ?>
                        <option value="<?php

                                            $output = htmlentities($vehicule['V_INDICATIF'], 0, "UTF-8");
                                            if ($output == "") {
                                                $output = htmlentities(utf8_encode($vehicule['V_INDICATIF']), 0, "UTF-8");
                                            }
                                            echo $output;
                                            ?>">
                            <?php
                                $output = htmlentities($vehicule['V_INDICATIF'], 0, "UTF-8");
                                if ($output == "") {
                                    $output = htmlentities(utf8_encode($vehicule['V_INDICATIF']), 0, "UTF-8");
                                }
                                echo $output;
                                ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select></label>
                <div class="check"><input type="checkbox" id="ronde" name="ronde"><label for="ronde">Ronde</label></div>
                <div class="txtb"><label for="">Date de départ <span class="important">*</span>: </label><input type="date" name="dateDepart" placeholder="Date de départ"
                        value="<?php echo date('Y-m-d'); ?>"><span></span></div>
                <div class="txtb"><label for="">Heure de départ <span class="important">*</span>: </label><input type="time" name="heureDepart" placeholder="Heure de départ"
                        value="<?php echo  date('H:i'); ?>"><span></span></div>
                <div class="txtb"><label for="">Date d'arriv&eacute;e sur le lieux <span class="important">*</span>: </label><input type="date" name="dateArrivee"
                        placeholder="Date d'arriv&eacute;e sur le lieux : " value="<?php echo date('Y-m-d'); ?>"><span></span></div>
                <div class="txtb"><label for="">Heure d'arriv&eacute;e sur le lieux <span class="important">*</span>: </label><input type="time" name="heureArrivee"
                        placeholder="Heure d'arriv&eacute;e sur le lieux : " value="<?php echo  date('H:i'); ?>"><span></span></div>
                <div class="txtb"><label for="">Date de retour <span class="important">*</span>: </label><input type="date" name="dateRetour" placeholder="Date de retour"
                        value="<?php echo date('Y-m-d'); ?>"><span></span></div>
                <div class="txtb"><label for="">Heure de retour <span class="important">*</span>: </label><input type="time" name="heureRetour" placeholder="Heure de retour"
                        value="<?php echo  date('H:i'); ?>"><span></span></div>
                <button class="btn btn-secondary btn-lg" id="addEngin" onclick="addField()">Ajouter un véhicule</button>
            </div>
            <div class="section">
                <h3>RESPONSABLE</h3>
                <div class="txtb"><input type="text" placeholder="Nom du responsable"><span></span></div>
            </div>
            <input type="submit" value="Sauver" class="btn btn-primary btn-lg">
        </form>
    </div>
</div>
<script>
var label = document.querySelectorAll(".txtb input");
label.forEach(element => {
    element.addEventListener("focus", (e) => {
        e.target.classList.add("focus");
    });
    element.addEventListener("blur", (e) => {
        // if (e.target.value === "") {
        e.target.classList.remove("focus");
        // }
    });

});
</script>