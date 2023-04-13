<br />
<p><a class="btn btn-secondary" href="<?= hlien('client'); ?>">Liste des clients</a></p>
<h2>Réservation du client "<?= mhe($client['cli_nom']) ?>"</h2>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Etat</th>
            <th>Hotel</th>
            <th>Chambre</th>
            <th>Services</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data as $row) { ?>
            <tr>

                <td><?= mhe($row['res_id']) ?></td>
                <td><?= mhe($row['res_date_debut']) ?></td>
                <td><?= mhe($row['res_date_fin']) ?></td>
                <td><?= mhe($row['res_etat']) ?></td>
                <td><?= mhe($row['hot_nom']) ?></td>
                <td><?= mhe($row['cha_numero']) ?></td>
                <td><a class="btn btn-info" href="<?= hlien("reservation", "services", "id", $row["res_id"]) ?>">Services</a></td>
                <td><a class="btn btn-warning" href="<?= hlien("reservation", "edit", "id", $row["res_id"]) ?>">Modifier</a></td>
                <td><a class="btn btn-danger" href="<?= hlien("reservation", "delete", "id", $row["res_id"]) ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>