<!--version 1 -->
<?php
include ".." . "/" . API_DIRNAME . "/API.php";
$typeList = API::getTypeInterventionList();
$typeVehicule = API::getAllVehiculesIndicatif();
?>
<div class="form-container">
    <div class="formulaire">
        <h2>Compte-rendu d'intervention</h2>
        <form action="../intervention/addinterventiontobdd" method="post">
            <div class="section">
                <h3>INTERVENTION</h3>
                <div class="txtb"><input type="text" required name="numIntervention" placeholder="Numéro d'intervention"><span></span></div>
                <div class="check"><input type="checkbox" id="opm" name="opm"><label for="opm">OPM</label></div>
                <div class="txtb"><input type="text" required name="adresse" placeholder="Adresse"><span></span></div>
                <div class="txtb"><input type="text" required name="commune" placeholder="Commune"><span></span></div>
                <div class="select"> <label for="">Type d'intervention <span class="important">*</span>: </label>
                    <select class="form-control" name="typeIntervention" id="typeIntervention">
                        <option value="">Selectionner un type d'intervention</option>
                        <?php while ($donnees = $typeList->fetch()) { ?>
                        <option value="
                        
                <?php

                            $output = htmlentities($donnees['TI_DESCRIPTION'], 0, "UTF-8");
                            if ($output == "") {
                                $output = htmlentities(utf8_encode($donnees['TI_DESCRIPTION']), 0, "UTF-8");
                            }
                            echo $output;
                ?>
                            ">
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
                <div class="check"><input type="checkbox" id="important" name="important"><label for="important">Important</label></div>
                <div class="select"> <label for="">Requ&eacute;rant <span class="important">*</span>: </label><select class="form-control" name="requerant" id="requerant">
                        <option value="">CODIS</option>
                        <option value="Alerte Locale">Alerte locale</option>
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
            <div class="section" id="sectionaEngin">
                <h3>ENGINS ET PERSONNEL</h3>
                <label for="">Nom de l'engin :
                    <select name="typeEngin" id="nomEngin%0" onChange="javascript:addTeam(this.id);">
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
            </div>
            <div class=section>
                <button type="button" onClick="javascript:AddEngin();" class="btn btn-secondary btn-lg" id="addEngin">Ajouter un véhicule</button>
            </div>
            <div class="section">
                <h3>RESPONSABLE</h3>
                <div class="txtb"><input type="text" name="responsable" placeholder="Nom du responsable" required><span></span></div>
            </div>
            <input type="submit" value="Sauver" class="btn btn-primary btn-lg">
        </form>
    </div>
</div>
<script type='text/javascript'>
var nbvehicule = 0;

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
    console.log(sel);
    var opt = sel.options[sel.selectedIndex].text;


    ///---------------- partie ajax
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            selection(xhr.responseText, sel, p);
        }
    };

    var sVar = encodeURIComponent(opt);

    xhr.open("GET", "../views/team.php?variable=" + sVar, true);
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
function selection(xml, sel, p) {
    var nb = p.split("%");

    while (document.contains(document.getElementById("team" + nb[1]))) {
        document.getElementById("team" + nb[1]).remove();
    }
    liste = xml.split("%");

    for (let i = 1; i < liste.length; i++) {
        liste[i] = html_entity_decode(liste[i]);
    }
    for (let i = 1; i < liste.length; i++) {
        var div = document.createElement("div");
        div.setAttribute("id", "team" + nb[1]);
        div.setAttribute("class", "txtb");
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
        input.required = true;
        input.setAttribute("name", liste[i]);
        input.setAttribute("placeholder", liste[i]);
        var span2 = document.createElement("span");
        div.appendChild(label);
        div.appendChild(input);
        div.appendChild(span2);
        sel.parentNode.insertBefore(div, sel.nextSibling);
    }
    console.log(liste);
}

// creation de plusieurs engins 
function AddEngin() {
    nbvehicule++;
    console.log(nbvehicule);
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            addtoform(xhr.responseText);
        }
    };

    xhr.open("GET", "../views/vehicule.php?", true);
    xhr.send(null);
}

function addtoform(types) {
    liste = types.split("%");
    var section = document.getElementById("sectionaEngin");
    var sectionEngin = document.createElement("div");
    sectionEngin.setAttribute("class", "section");
    section.insertAdjacentElement('afterend', sectionEngin);
    var label = document.createElement("label");
    label.setAttribute("for", "");
    var nom = document.createTextNode("Nom de L'engin");
    label.appendChild(nom);
    var select = document.createElement("select");
    select.setAttribute("name", "typeEngin");
    select.setAttribute("id", "nomEngin%" + nbvehicule);
    select.setAttribute("onChange", "javascript:addTeam(this.id);");
    var option = document.createElement("option");
    option.setAttribute("value", "");
    var text = document.createTextNode("Selection un véhicule");
    option.appendChild(text);
    select.appendChild(option);
    for (let i = 1; i < liste.length; i++) {
        var option = document.createElement("option");
        option.setAttribute("value", liste[i]);
        var text = document.createTextNode(liste[i]);
        option.appendChild(text);
        select.appendChild(option);
    }
    label.appendChild(select);
    var s = document.getElementById("addEngin");
    var p = s.parentNode;
    sectionEngin.appendChild(label);
    var div = document.createElement("div");
    div.setAttribute("class", "check");
    var input = document.createElement("input");
    input.setAttribute("type", "checkbox");
    input.setAttribute("id", "ronde" + nbvehicule);
    input.setAttribute("name", "ronde" + nbvehicule);
    var label = document.createElement("label");
    label.setAttribute("for", "ronde" + nbvehicule);
    var text = document.createTextNode("Ronde");
    label.appendChild(text);
    div.appendChild(input);
    div.appendChild(label);
    sectionEngin.appendChild(div);

    div = document.createElement("div");
    div.setAttribute("class", "txtb");
    label = document.createElement("label");
    label.setAttribute("for", "");
    text = document.createTextNode("Date de départ");
    label.append(text);
    var span = document.createElement("span");
    span.setAttribute("class", "important");
    var etoile = document.createTextNode("*");
    span.appendChild(etoile);
    deuxpoint = document.createTextNode(":");
    label.appendChild(span);
    input = document.createElement("input");
    input.setAttribute("type", "date");
    input.setAttribute("name", "dateDepart");
    input.setAttribute("placeholder", "Date de départ");
    input.setAttribute("value", "<?php echo date('Y-m-d'); ?>");
    var span2 = document.createElement("span");
    div.appendChild(label);
    div.appendChild(input);
    sectionEngin.appendChild(div);
    div = document.createElement("div");
    div.setAttribute("class", "txtb");
    label = document.createElement("label");
    label.setAttribute("for", "");
    text = document.createTextNode("Heure de départ");
    label.append(text);
    var span = document.createElement("span");
    span.setAttribute("class", "important");
    var etoile = document.createTextNode("*");
    span.appendChild(etoile);
    deuxpoint = document.createTextNode(":");
    label.appendChild(span);
    input = document.createElement("input");
    input.setAttribute("type", "time");
    input.setAttribute("name", "heureDepart");
    input.setAttribute("placeholder", "Heure de départ");
    input.setAttribute("value", "<?php echo  date('H:i'); ?>");
    var span2 = document.createElement("span");
    div.appendChild(label);
    div.appendChild(input);
    sectionEngin.appendChild(div);
    div = document.createElement("div");
    div.setAttribute("class", "txtb");
    label = document.createElement("label");
    label.setAttribute("for", "");
    text = document.createTextNode("Date d'arrivée");
    label.append(text);
    var span = document.createElement("span");
    span.setAttribute("class", "important");
    var etoile = document.createTextNode("*");
    span.appendChild(etoile);
    deuxpoint = document.createTextNode(":");
    label.appendChild(span);
    input = document.createElement("input");
    input.setAttribute("type", "date");
    input.setAttribute("name", "dateArrivee");
    input.setAttribute("placeholder", "Date d'arrivée sur le lieux");
    input.setAttribute("value", "<?php echo date('Y-m-d'); ?>");
    var span2 = document.createElement("span");
    div.appendChild(label);
    div.appendChild(input);
    sectionEngin.appendChild(div);
    div = document.createElement("div");
    div.setAttribute("class", "txtb");
    label = document.createElement("label");
    label.setAttribute("for", "");
    text = document.createTextNode("Heure d'arrivée");
    label.append(text);
    var span = document.createElement("span");
    span.setAttribute("class", "important");
    var etoile = document.createTextNode("*");
    span.appendChild(etoile);
    deuxpoint = document.createTextNode(":");
    label.appendChild(span);
    input = document.createElement("input");
    input.setAttribute("type", "time");
    input.setAttribute("name", "heureArrivee");
    input.setAttribute("placeholder", "Heure d'arrivée");
    input.setAttribute("value", "<?php echo  date('H:i'); ?>");
    var span2 = document.createElement("span");
    div.appendChild(label);
    div.appendChild(input);
    sectionEngin.appendChild(div);
    div = document.createElement("div");
    div.setAttribute("class", "txtb");
    label = document.createElement("label");
    label.setAttribute("for", "");
    text = document.createTextNode("Date de retour");
    label.append(text);
    var span = document.createElement("span");
    span.setAttribute("class", "important");
    var etoile = document.createTextNode("*");
    span.appendChild(etoile);
    deuxpoint = document.createTextNode(":");
    label.appendChild(span);
    input = document.createElement("input");
    input.setAttribute("type", "date");
    input.setAttribute("name", "dateRetour");
    input.setAttribute("placeholder", "Date de retour");
    input.setAttribute("value", "<?php echo date('Y-m-d'); ?>");
    var span2 = document.createElement("span");
    div.appendChild(label);
    div.appendChild(input);
    sectionEngin.appendChild(div);
    div = document.createElement("div");
    div.setAttribute("class", "txtb");
    label = document.createElement("label");
    label.setAttribute("for", "");
    text = document.createTextNode("Heure de retour");
    label.append(text);
    var span = document.createElement("span");
    span.setAttribute("class", "important");
    var etoile = document.createTextNode("*");
    span.appendChild(etoile);
    deuxpoint = document.createTextNode(":");
    label.appendChild(span);
    input = document.createElement("input");
    input.setAttribute("type", "time");
    input.setAttribute("name", "heureRetour");
    input.setAttribute("placeholder", "Heure de retour");
    input.setAttribute("value", "<?php echo  date('H:i'); ?>");
    var span2 = document.createElement("span");
    div.appendChild(label);
    div.appendChild(input);
    sectionEngin.appendChild(div);

    console.log(types);

}
</script>
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