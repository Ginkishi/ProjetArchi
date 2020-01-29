<!--version 1 -->
<div class="form-container">
    <h1>Compte-rendu d'intervention</h1>
    <div class="formulaire">
        <form action="" method="post">
            <h3>INTERVENTION</h3>
            <div class="section">
                <label>Num&eacute;ro d'intervention <span class="important">*</span>: <input type="text" name="numIntervention"></label>
                <label>OPM : <input type="checkbox" name="opm"></label>
                <label for="">Adresse <span class="important">*</span>: <input type="text" name="adresse"></label>
                <label for="">Commune <span class="important">*</span>: <input type="text" name="commune"></label>
                <label for="">Type d'intervention <span class="important">*</span>: <input type="text" name="typeIntervention"></label>
                <label for="">Important : <input type="checkbox" name="important"></label>
                <label for="">Requ&eacute;rant <span class="important">*</span>: <select name="requerant" id="requerant">
                        <option value="">CODIS</option>
                    </select></label>
                <label for=""></label>
                <label for="">Date de déclenchement <span class="important">*</span>: <input type="text"></label>
                <label for="">Heure de déclenchement <span class="important">*</span>: <input type="text"></label>
                <label for="">Date de fin <span class="important">*</span>: <input type="text"></label>
                <label for="">Heure de fin <span class="important">*</span>: <input type="text"></label>
            </div>
            <h3>ENGINS ET PERSONNEL</h3>
            <div class="section">
                <label for="">Nom de l'engin : <select name="typeEngin" id="nomEngin">
                        <option value="">Selectionner un v&eacute;hicule</option>
                    </select></label>
                <label for="">Ronde : <input type="checkbox" name="ronde"></label>
                <label for="">Date de d&eacute;part <span class="important">*</span>: <input type="text"></label>
                <label for="">Heure de d&eacute;part <span class="important">*</span>: <input type="text"></label>
                <label for="">Date d'arriv&eacute; sur le lieux : <input type="text"></label>
                <label for="">Heure d'arriv&eacute; sur le lieux : <input type="text"></label>
                <label for="">Date de retour <span class="important">*</span>: <input type="text"></label>
                <label for="">Heure de retour <span class="important">*</span>: <input type="text"></label>
                <button id="addEngin">Ajouter un autre véhicule</button>
            </div>
            <h3>RESPONSABLE</h3>
            <div class="section">
                <label for="">Nom du responsable : <input type="text"></label>
            </div>
            <input type="submit" value="Sauver">
        </form>
    </div>
</div>