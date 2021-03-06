<div class="form-container">
    <h1 class="header"> Modification de compte-rendu d'intervention</h1>
    <form action="../../intervention/editinterventiontobdd/<?php echo $intervention["IDIntervention"] ?>" method="post">
        <div class="section">
            <h2 class="title">Intervention</h2>
            <div class="body">
                <div class="group-champ col3">
                    <div class="champ">
                        <label for="">Numéro d'intervention</label>
                        <input type="text" autocomplete="off" name="numIntervention" value=<?php echo utf8_encode($intervention["NIntervention"]); ?> required>
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Commune</label>
                        <input type="text" autocomplete="off" name="commune" value="<?php echo utf8_encode($intervention["Commune"]); ?>" required>
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Adresse</label>
                        <input type="text" autocomplete="off" name="adresse" value="<?php echo utf8_encode($intervention["Adresse"]); ?>" required>
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="champ">
                    <label for="">Type d'intervention</label>
                    <select name="typeIntervention" id="typeIntervention" class="form-control">
                        <option value="">Selectionnez un type d'intervention</option>
                        <?php
                        foreach ($typeList as $donnees) {
                        ?>
                        <option value="<?php

                                            $output = htmlentities($donnees['TI_CODE'], 0, "UTF-8");
                                            if ($output == "") {
                                                $output = htmlentities($donnees['TI_CODE'], 0, "UTF-8");
                                            }
                                            echo $output;
                                            ?>" <?php if ($output == utf8_encode($intervention["TypeIntervention"])) echo "selected"; ?>><?php
                                                                                                                                            $output = htmlentities($donnees['TI_DESCRIPTION'], 0, "UTF-8");
                                                                                                                                            if ($output == "") {
                                                                                                                                                $output = htmlentities($donnees['TI_DESCRIPTION'], 0, "UTF-8");
                                                                                                                                            }
                                                                                                                                            echo $output;
                                                                                                                                            ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Réquerant</label>
                        <select name="requerant" id="requerant" class="form-control">
                            <option value="CODIS" <?php if ("CODIS" == $intervention["Requerant"]) echo "selected" ?>>CODIS</option>
                            <option value="Alerte locale" <?php if ("Alerte locale" == $intervention["Requerant"]) echo "selected"; ?>>Alerte locale</option>
                        </select>
                    </div>
                    <div class="group-champ col2">
                        <div class="champ mycheckbox">
                            <label for="">OPM</label>
                            <input type="checkbox" name="opm" id="opm" <?php if ($intervention["OPM"]) echo "checked"; ?>>
                        </div>
                        <div class="champ mycheckbox">
                            <label for="">Important</label>
                            <input type="checkbox" name="important" id="important" <?php if ($intervention["Important"]) echo "checked"; ?>>
                        </div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date déclenchement</label>
                        <input type="date" autocomplete="off" name="dateDeclenchement" value="<?php echo date('Y-m-d', strtotime($intervention["DateDeclenchement"])); ?>">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure déclenchement</label>
                        <input type="time" autocomplete="off" name="heureDeclenchement" value="<?php echo  date('H:i', strtotime($intervention["DateDeclenchement"])); ?>">
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date de fin</label>
                        <input type="date" autocomplete="off" name="dateFin" value="<?php echo date('Y-m-d', strtotime($intervention["DateFin"])); ?>">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure de fin</label>
                        <input type="time" autocomplete="off" name="heureFin" value="<?php echo  date('H:i', strtotime($intervention["DateFin"])); ?>">
                        <div class="barre"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section engin">
            <h2 class="title">Engins et Personnels</h2>
            <?php
            if (sizeof($tousLesVehiculeIntervention) == 0) {
            ?>
            <div class="body">
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Nom du v&eacute;hicule</label>
                        <select name="typeEngin[]" id="nomEngin%0" class="form-control" onChange="javascript:addTeam(this.id);">
                            <option value="">Selectionnez un véhicule</option>
                            <?php
                                foreach ($typeVehicule as $vehicule) {
                                ?>
                            <option value="<?php

                                                    $output = htmlentities($vehicule['V_ID'], 0, "UTF-8");
                                                    if ($output == "") {
                                                        $output = htmlentities($vehicule['V_ID'], 0, "UTF-8");
                                                    }
                                                    echo $output;
                                                    ?>">
                                <?php
                                        $output = htmlentities($vehicule['V_INDICATIF'], 0, "UTF-8");
                                        if ($output == "") {
                                            $output = htmlentities($vehicule['V_INDICATIF'], 0, "UTF-8");
                                        }
                                        echo $output;
                                        ?>
                            </option>
                            <?php
                                }
                                ?>
                        </select>
                    </div>
                    <div class="champ mycheckbox">
                        <label for="">Ronde</label>
                        <input type="checkbox" name="ronde[]" id="ronde">
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date de départ</label>
                        <input type="date" autocomplete="off" name="dateDepart[]" value="<?php echo date('Y-m-d'); ?>">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure de départ</label>
                        <input type="time" autocomplete="off" name="heureDepart[]" value="<?php echo  date('H:i'); ?>">
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date d'arrivée sur les lieux</label>
                        <input type="date" autocomplete="off" name="dateArrivee[]" value="<?php echo date('Y-m-d'); ?>">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure d'arrivée sur les lieux</label>
                        <input type="time" autocomplete="off" name="heureArrivee[]" value="<?php echo  date('H:i'); ?>">
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date de retour</label>
                        <input type="date" autocomplete="off" name="dateRetour[]" value="<?php echo date('Y-m-d'); ?>">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure de retour</label>
                        <input type="time" autocomplete="off" name="heureRetour[]" value="<?php echo  date('H:i'); ?>">
                        <div class="barre"></div>
                    </div>
                </div>
            </div>
            <?php
            } else {
                $tv = $typeVehicule;
                for ($i = 0; $i < sizeof($tousLesVehiculeIntervention); $i++) {
                    $v = $tousLesVehiculeIntervention[$i];
                ?>
            <div class="body" id="<?php echo "vehicule" . $i ?> ">
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Nom du v&eacute;hicule</label>
                        <select name="typeEngin[]" id="nomEngin%<?php echo $i; ?>" class="form-control" onChange="javascript:addTeam(this.id);">
                            <option value="">Selectionnez un véhicule</option>
                            <?php
                                    foreach ($tv as $vehicule) {
                                    ?>
                            <option value="<?php

                                                        $output = htmlentities($vehicule['V_ID'], 0, "UTF-8");
                                                        if ($output == "") {
                                                            $output = htmlentities($vehicule['V_ID'], 0, "UTF-8");
                                                        }
                                                        echo $output;
                                                        ?>" <?php if ($output == $v["IDVehicule"]) echo "selected"; ?>>
                                <?php
                                            $output = htmlentities($vehicule['V_INDICATIF'], 0, "UTF-8");
                                            if ($output == "") {
                                                $output = htmlentities($vehicule['V_INDICATIF'], 0, "UTF-8");
                                            }
                                            echo $output;
                                            ?>
                            </option>
                            <?php
                                    }
                                    ?>
                        </select>
                        <?php

                                for ($j = 0; $j < sizeof($v["vehicule"]); $j++) {
                                ?>
                        <div id="team<?php echo $i ?>" class="champs">
                            <label for=""><?php echo $v["vehicule"][$j]["ROLE_NAME"]; ?><span class="important">*</span>:</label>
                            <input type="text" required list="firefighters" name="<?php echo $v["vehicule"][$j]["ROLE_NAME"]; ?>[]"
                                value="<?php echo $v["vehicule"][$j]["pompier"]; ?>">
                        </div>
                        <?php
                                }
                                ?>
                    </div>

                    <div class="champ mycheckbox">
                        <label for="">Ronde</label>
                        <input type="checkbox" name="ronde[]" id="ronde<?php echo $i; ?>" <?php if ($v["Ronde"]) echo "checked"; ?>>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date de départ</label>
                        <input type="date" autocomplete="off" name="dateDepart[]" value="<?php echo date('Y-m-d', strtotime($v["DateDepart"])); ?>">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure de départ</label>
                        <input type="time" autocomplete="off" name="heureDepart[]" value="<?php echo  date('H:i', strtotime($v["DateDepart"])); ?>">
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date d'arrivée sur les lieux</label>
                        <input type="date" autocomplete="off" name="dateArrivee[]" value="<?php echo date('Y-m-d', strtotime($v["DateArrive"])); ?>">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure d'arrivée sur les lieux</label>
                        <input type="time" autocomplete="off" name="heureArrivee[]" value="<?php echo  date('H:i', strtotime($v["DateArrive"])); ?>">
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date de retour</label>
                        <input type="date" autocomplete="off" name="dateRetour[]" value="<?php echo date('Y-m-d', strtotime($v["DateRetour"])); ?>">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure de retour</label>
                        <input type="time" autocomplete="off" name="heureRetour[]" value="<?php echo  date('H:i', strtotime($v["DateRetour"])); ?>">
                        <div class="barre"></div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary btn-lg" onClick="javascript:deleteEngin(this.id);" id="<?php echo "vehicule".$i ?> ">Supprimer ce véhicule</button>
            </div>

            <button type="button" class="btn btn-primary btn-lg" onClick="javascript:deleteEngin(this.id);" id="<?php echo "vehicule" . $i ?> ">Supprimer ce véhicule</button>
            <?php

                }
            }
            ?>
            <button type="button" class="btn btn-danger btn-lg" onClick="javascript:AddEngin();" id="addVehicule">Ajouter un véhicule</button>
        </div>
        <div class="section resp">
            <h2 class="title">Responsable</h2>
            <div class="body">
                <div class="champ">
                    <label for="">Nom du responsable</label>
                    <input type="text" autocomplete="off" name="responsable" list="firefighters" value="<?php echo $intervention["IDResponsable"]; ?>">
                    <datalist id="firefighters">
                        <?php
                        foreach ($listFirefighter as $Firefighter) {
                        ?>
                        <option value="<?php

                                            $output = htmlentities($Firefighter, 0, "UTF-8");
                                            if ($output == "") {
                                                $output = htmlentities($Firefighter, 0, "UTF-8");
                                            }
                                            echo $output;
                                            ?>">
                        </option>
                        <?php
                        }
                        ?>
                    </datalist>
                    <div class="barre"></div>
                </div>
            </div>
        </div>
        <div class="champ">
            <input type="submit" value="Sauvegarder" class="btn btn-primary btn-lg">
        </div>
        <?php
        require_once(CLASSES . DS . "gestionnaireGrade.php");
        if (GestionnaireGrade::aLesDroitsValidation()) {
        ?>
        <div class="champ">
            <input type="submit" value="Valider" formaction="../editValidatedinterventiontobdd/<?php echo $intervention["IDIntervention"] ?>" class="btn btn-primary btn-lg">
        </div>
        <?php } ?>
    </form>
</div>
<script type='text/javascript'>
var nbvehicule = "<?php echo sizeof($tousLesVehiculeIntervention); ?>";

function getXMLHttpRequest() {
    var xhr = null;

    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        } else {
            xhr = new XMLHttpRequest();
        }
    } else {
        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
        return null;
    }

    return xhr;
}

function addTeam(p) {
    var sel = document.getElementById(p);
    var opt = sel.options[sel.selectedIndex].text;
    var val = sel.options[sel.selectedIndex].value;


    ///---------------- partie ajax
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            selection(xhr.responseText, sel, p, val);
        }
    };

    var sVar = encodeURIComponent(opt);

    xhr.open("GET", "../../views/team.php?variable=" + sVar, true);
    xhr.send(null);

}

// solution pour le probleme d'encodage 
function html_entity_decode(str) {
    var ta = document.createElement("textarea");
    ta.innerHTML = str.replace(/</g, "&lt;").replace(/>/g, "&gt;");
    toReturn = ta.value;
    ta = null;
    return toReturn
}
//ajout des champs pour l'equipe
function selection(xml, sel, p, val) {
    var nb = p.split("%");
    console.log(val);
    while (document.contains(document.getElementById("team" + nb[1]))) {
        document.getElementById("team" + nb[1]).remove();
    }
    liste = xml.split("%");

    for (let i = 1; i < liste.length; i++) {
        liste[i] = html_entity_decode(liste[i]);
    }
    var div = document.createElement("div");
    div.setAttribute("id", "team" + nb[1]);
    div.setAttribute("class", "champ");
    var label = document.createElement("label");
    label.setAttribute("for", "")
    var text = document.createTextNode("Apprenti");
    var span = document.createElement("span");
    span.setAttribute("class", "important");
    label.appendChild(text);
    label.appendChild(span);
    var deuxpoints = document.createTextNode(":");
    label.appendChild(deuxpoints);
    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("list", "firefighters");
    input.required = false;
    input.setAttribute("name", "apprenti[]");
    input.setAttribute("placeholder", "Apprenti");
    var span2 = document.createElement("span");
    div.appendChild(label);
    div.appendChild(input);
    div.appendChild(span2);
    sel.parentNode.insertBefore(div, sel.nextSibling);

    for (let i = liste.length - 1; i > 1; i--) {
        var div = document.createElement("div");
        div.setAttribute("id", "team" + nb[1]);
        div.setAttribute("class", "champ");
        var label = document.createElement("label");
        label.setAttribute("for", "")
        var text = document.createTextNode(liste[i]);
        var span = document.createElement("span");
        span.setAttribute("class", "important");
        var etoile = document.createTextNode("*");
        span.appendChild(etoile);
        label.appendChild(text);
        label.appendChild(span);
        var deuxpoints = document.createTextNode(":");
        label.appendChild(deuxpoints);
        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("list", "firefighters");
        input.required = true;
        input.setAttribute("name", liste[i] + "[]");
        input.setAttribute("placeholder", liste[i]);
        var span2 = document.createElement("span");
        div.appendChild(label);
        div.appendChild(input);
        div.appendChild(span2);
        sel.parentNode.insertBefore(div, sel.nextSibling);
    }

    var div = document.createElement("div");
    div.setAttribute("id", "team" + nb[1]);
    div.setAttribute("class", "champ");
    var label = document.createElement("label");
    label.setAttribute("for", "")
    var text = document.createTextNode(liste[1]);
    var span = document.createElement("span");
    span.setAttribute("class", "important");
    var etoile = document.createTextNode("*");
    span.appendChild(etoile);
    label.appendChild(text);
    label.appendChild(span);
    var deuxpoints = document.createTextNode(":");
    label.appendChild(deuxpoints);
    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("list", "firefighters");
    input.required = true;
    input.setAttribute("name", liste[1] + "[]");
    input.setAttribute("placeholder", "chef d'agrès");
    var span2 = document.createElement("span");
    div.appendChild(label);
    div.appendChild(input);
    div.appendChild(span2);
    sel.parentNode.insertBefore(div, sel.nextSibling);
    console.log(liste);
}






function AddEngin() {
    nbvehicule++;
    console.log(nbvehicule);
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            addtoform(xhr.responseText);
        }
    };

    xhr.open("GET", "../../views/vehicule.php?", true);
    xhr.send(null);
}

function addtoform(types) {
    liste = types.split("%");

    var section = document.getElementById("addVehicule");
    var body = document.createElement("div");
    body.setAttribute("class", "body");
    body.setAttribute("id", "vehicule" + nbvehicule);
    section.insertAdjacentElement('beforebegin', body);
    var champ2 = document.createElement("div");
    champ2.setAttribute("class", "group-champ col2");
    var champ = document.createElement("div");
    champ.setAttribute("class", "champ");
    var label = document.createElement("label");
    label.setAttribute("for", "");
    var nom = document.createTextNode("Nom de véhicule");
    label.appendChild(nom);
    champ.appendChild(label);
    var select = document.createElement("select");
    select.setAttribute("class", "form-control");
    select.setAttribute("name", "typeEngin[]");
    select.setAttribute("id", "nomEngin%" + nbvehicule);
    select.setAttribute("onChange", "javascript:addTeam(this.id);");
    var option = document.createElement("option");
    option.setAttribute("value", "");
    var text = document.createTextNode("Selection un véhicule");
    option.appendChild(text);
    select.appendChild(option);
    for (let i = 1; i < liste.length; i = i + 2) {
        var option = document.createElement("option");
        option.setAttribute("value", liste[i]);
        var text = document.createTextNode(liste[i + 1]);
        option.appendChild(text);
        select.appendChild(option);
    }
    champ.appendChild(select);
    champ2.appendChild(champ);
    var champ = document.createElement("div");
    champ.setAttribute("class", "champ mycheckbox");
    var label = document.createElement("label");
    label.setAttribute("for", "ronde" + nbvehicule);
    var text = document.createTextNode("Ronde");
    label.appendChild(text);
    champ.appendChild(label);
    var input = document.createElement("input");
    input.setAttribute("type", "checkbox");
    input.setAttribute("id", "ronde" + nbvehicule);
    input.setAttribute("name", "ronde[]");
    champ.appendChild(input);
    champ2.appendChild(champ);
    body.appendChild(champ2);
    var champ2 = document.createElement("div");
    champ2.setAttribute("class", "group-champ col2");
    champ = document.createElement("div");
    champ.setAttribute("class", "champ");
    label = document.createElement("label");
    label.setAttribute("for", "");
    text = document.createTextNode("Date de départ");
    label.append(text);
    input = document.createElement("input");
    input.setAttribute("type", "date");
    input.setAttribute("name", "dateDepart[]");
    input.setAttribute("value", "<?php echo date('Y-m-d'); ?>");
    champ.appendChild(label);
    champ.appendChild(input);
    champ2.appendChild(champ);

    champ = document.createElement("div");
    champ.setAttribute("class", "champ");
    label = document.createElement("label");
    label.setAttribute("for", "");
    text = document.createTextNode("Heure de départ");
    label.append(text);
    input = document.createElement("input");
    input.setAttribute("type", "time");
    input.setAttribute("name", "heureDepart[]");
    input.setAttribute("placeholder", "Heure de départ");
    input.setAttribute("value", "<?php echo  date('H:i'); ?>");
    var span2 = document.createElement("span");
    champ.appendChild(label);
    champ.appendChild(input);
    champ2.appendChild(champ);
    body.appendChild(champ2);
    var champ2 = document.createElement("div");
    champ2.setAttribute("class", "group-champ col2");
    champ = document.createElement("div");
    champ.setAttribute("class", "champ");
    label = document.createElement("label");
    label.setAttribute("for", "");
    text = document.createTextNode("Date d'arrivée sur le lieux");
    label.append(text);
    input = document.createElement("input");
    input.setAttribute("type", "date");
    input.setAttribute("name", "dateArrivee[]");
    input.setAttribute("value", "<?php echo date('Y-m-d'); ?>");
    var span2 = document.createElement("span");
    champ.appendChild(label);
    champ.appendChild(input);
    champ2.appendChild(champ);
    champ = document.createElement("div");
    champ.setAttribute("class", "champ");
    label = document.createElement("label");
    label.setAttribute("for", "");
    text = document.createTextNode("Heure d'arrivée sur le lieux");
    label.append(text);
    input = document.createElement("input");
    input.setAttribute("type", "time");
    input.setAttribute("name", "heureArrivee[]");
    input.setAttribute("value", "<?php echo  date('H:i'); ?>");
    var span2 = document.createElement("span");
    champ.appendChild(label);
    champ.appendChild(input);
    champ2.appendChild(champ);
    body.appendChild(champ2);
    var champ2 = document.createElement("div");
    champ2.setAttribute("class", "group-champ col2");
    champ = document.createElement("div");
    champ.setAttribute("class", "champ");
    label = document.createElement("label");
    label.setAttribute("for", "");
    text = document.createTextNode("Date de retour");
    label.append(text);
    input = document.createElement("input");
    input.setAttribute("type", "date");
    input.setAttribute("name", "dateRetour[]");
    input.setAttribute("value", "<?php echo date('Y-m-d'); ?>");
    champ.appendChild(label);
    champ.appendChild(input);
    champ2.appendChild(champ);
    champ = document.createElement("div");
    champ.setAttribute("class", "champ");
    label = document.createElement("label");
    label.setAttribute("for", "");
    text = document.createTextNode("Heure de retour");
    label.append(text);
    input = document.createElement("input");
    input.setAttribute("type", "time");
    input.setAttribute("name", "heureRetour[]");
    input.setAttribute("placeholder", "Heure de retour");
    input.setAttribute("value", "<?php echo  date('H:i'); ?>");
    var span2 = document.createElement("span");
    champ.appendChild(label);
    champ.appendChild(input);
    champ2.appendChild(champ);
    body.appendChild(champ2);
    var button = document.createElement("button");
    button.setAttribute("type", "button");
    button.setAttribute("class", "btn btn-primary btn-lg");
    button.setAttribute("onClick", "javascript:deleteEngin(this.id);");
    button.setAttribute("id", "vehicule" + nbvehicule);
    var sup = document.createTextNode("supprimer ce véhicule");
    button.appendChild(sup);
    body.appendChild(button);


}

function deleteEngin(id) {

    while (document.contains(document.getElementById(id))) {
        document.getElementById(id).remove();
        nbvehicule--;
    }

}
</script>
