<!--version 1 -->
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
                <label for="">Requ&eacute;rant <span class="important">*</span>: <select name="requerant" id="requerant">
                        <option value="">CODIS</option>
                    </select></label>
                <label for=""></label>
                <div class="txtb"><input type="text" placeholder="Date de déclenchement"><span></span></div>
                <div class="txtb"><input type="text" placeholder="Heure de déclenchement"><span></span></div>
                <div class="txtb"><input type="text" placeholder="Date de fin"><span></span></div>
                <div class="txtb"><input type="text" placeholder="Heure de fin"><span></span></div>
            </div>
            <div class="section">
                <h3>ENGINS ET PERSONNEL</h3>
                <label for="">Nom de l'engin : <select name="typeEngin" id="nomEngin">
                        <option value="">Selectionner un v&eacute;hicule</option>
                    </select></label>
                <div class="check"><input type="checkbox" id="ronde" name="ronde"><label for="ronde">Ronde</label></div>
                <div class="txtb"><input type="text" placeholder="Date de départ"><span></span></div>
                <div class="txtb"><input type="text" placeholder="Heure de départ"><span></span></div>
                <div class="txtb"><input type="text" placeholder="Date de d'arrivée"><span></span></div>
                <div class="txtb"><input type="text" placeholder="Date de fin"><span></span></div>
                <div class="txtb"><input type="text" placeholder="Heure de d'arrivée"><span></span></div>
                <div class="txtb"><input type="text" placeholder="Date de retour"><span></span></div>
                <div class="txtb"><input type="text" placeholder="Heure de retour"><span></span></div>
                <button id="addEngin" type="button" class="btn btn-warning btn-lg">Ajouter un autre véhicule</button>
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
        if (e.target.value === "") {
            e.target.classList.remove("focus");
        }


    });

});
</script>