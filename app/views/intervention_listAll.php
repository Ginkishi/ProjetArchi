<div class="table-responsive">
    <table class="table text-center">
        <thead>
            <tr class="bg-primary">
                <th scope="col">Numéro</th>
                <th scope="col">Date de déclenchement</th>
                <th scope="col">Date de fin</th>
                <th scope="col">Adresse</th>
                <th scope="col">Commune</th>
                <th scope="col">Type d'intervention</th>
                <th scope="col">Statut</th>
                <th scope="col"><i class="fas fa-eye"></i></th>
                <th scope="col"><i class="fas fa-edit"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($interventions as $i) : ?>
            <tr>
                <td><?= $i["NIntervention"]; ?></td>
                <td><?= $i["datedec"]; ?></td>
                <td><?= $i["datefin"]; ?></td>
                <td><?= $i["Adresse"]; ?></td>
                <td><?= $i["Commune"]; ?></td>
                <td><?= $i["TypeIntervention"]; ?></td>
                <td><?= utf8_encode($i["statut"]); ?></td>
                <td><a href="<?= LOCAL_DIR ?>intervention/view/<?= $i["IDIntervention"]; ?>" class="btn btn-info btn-lg">Voir</a></td>
                <td><a href="<?= LOCAL_DIR ?>intervention/modification/<?= $i["IDIntervention"]; ?>" class="btn btn-primary btn-lg">Editer</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>