<div class="export-container">
    <form action="../intervention/doexport" method="post">
        <div class="bandeau">
            <div class="bandeau-title">
                <div class="logo"><i class="fas fa-file-download"></i></div>
                <div class="title">Exportation des interventions</div>
            </div>
            <div class="clocks">
                <div class="time" id="time">00:00</div>
                <div class="date">03 Mar 2020</div>
            </div>
        </div>
        <div class="body">
            <div class="champ"><span class="label"> Date de début : </span><input type="date" name="date_debut" /></div>
            <div class="champ"><span class="label">Date de fin :</span> <input type="date" name="date_fin" /></div>
            <div class="champ"><input class="submit" type="submit" value="Exporter"></div>
        </div>
    </form>
</div>