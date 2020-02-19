<div class="form-container">
    <h1 class="header">Compte-rendu d'intervention</h1>
    <form action="#">
        <div class="section">
            <h2 class="title">Intervention</h2>
            <div class="body">
                <div class="group-champ col3">
                    <div class="champ">
                        <label for="">Numéro d'intervention</label>
                        <input type="text" autocomplete="off">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Commune</label>
                        <input type="text" autocomplete="off">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Adresse</label>
                        <input type="text" autocomplete="off">
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="champ">
                    <label for="">Type d'intervention</label>
                    <select name="" id="" class="form-control">
                        <option value="">Selectionnez un type d'intervention</option>
                    </select>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Réquerant</label>
                        <select name="" id="" class="form-control">
                            <option value="">CODIS</option>
                        </select>
                    </div>
                    <div class="group-champ col2">
                        <div class="champ mycheckbox">
                            <label for="">OPM</label>
                            <input type="checkbox">
                        </div>
                        <div class="champ mycheckbox">
                            <label for="">Important</label>
                            <input type="checkbox">
                        </div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date déclenchement</label>
                        <input type="date" autocomplete="off">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure déclenchement</label>
                        <input type="time" autocomplete="off">
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date de fin</label>
                        <input type="date" autocomplete="off">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure de fin</label>
                        <input type="time" autocomplete="off">
                        <div class="barre"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section engin">
            <h2 class="title">Engins et Personnels</h2>
            <div class="body">
                <div class="champ">
                    <label for="">Nom du responsable</label>
                    <select name="" id="" class="form-control">
                        <option value="">Selectionnez un véhicule</option>
                    </select>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date de départ</label>
                        <input type="date" autocomplete="off">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure de départ</label>
                        <input type="time" autocomplete="off">
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date d'arrivée sur les lieux</label>
                        <input type="date" autocomplete="off">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure d'arrivée sur les lieux</label>
                        <input type="time" autocomplete="off">
                        <div class="barre"></div>
                    </div>
                </div>
                <div class="group-champ col2">
                    <div class="champ">
                        <label for="">Date de retour</label>
                        <input type="date" autocomplete="off">
                        <div class="barre"></div>
                    </div>
                    <div class="champ">
                        <label for="">Heure de retour</label>
                        <input type="time" autocomplete="off">
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
                    <input type="text" autocomplete="off">
                    <div class="barre"></div>
                </div>
            </div>
        </div>
    </form>
</div>