<div class="pompier-container">
    <div class="bandeau-title">
        <div class="logo"><i class="far fa-address-card"></i></div>
        <div class="title">Profil</div>
    </div>
    <div class="body">
        <div class="info">
            <div class="title">Informations</div>
            <div class="nom"><span class="label">Nom : </span><?= $pompier["P_NOM"] ?></div>
            <div class="prenom"><span class="label">Prénom : </span><?= $pompier["P_PRENOM"] ?></div>
            <div class="prenom"><span class="label">Prénom 2 : </span><?= $pompier["P_PRENOM2"] ?></div>
            <div class="civilite"><span class="label">Civilité : </span><?= $pompier["P_CIVILITE "] ?></div>
            <div class="sexe"><span class="label">Sexe : </span><?= $pompier["P_SEXE"] ?></div>
            <div class="grade"><span class="label">Grade : </span><?= $pompier["G_DESCRIPTION"] ?></div>
        </div>
        <div class="droits">
            <div class="title">Droits</div>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Droit</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pompier["ROLE"] as $r => $v) { ?>
                    <tr>
                        <td><?= $r ?></td>
                        <td><?= $v ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>