    <h2>Réservation du client "<?= mhe($client['cli_nom']) ?>"</h2>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>

                <th>Date_debut</th>
                <th>Date_fin</th>
                <th>Date_maj</th>
                <th>Date_creation</th>
                <th>Etat</th>
                <th>Hotel</th>
                <th>Chambre</th>
                <th>modifier</th>
                <th>supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $row) { ?>
                <tr>

                    <td><?= mhe($row['res_id']) ?></td>
                    <td><?= mhe($row['res_date_creation']) ?></td>
                    <td><?= mhe($row['res_date_debut']) ?></td>
                    <td><?= mhe($row['res_date_maj']) ?></td>
                    <td><?= mhe($row['res_date_fin']) ?></td>
                    <td><?= mhe($row['res_etat']) ?></td>
                    <td><?= mhe($row['hot_nom']) ?></td>
                    <td><?= mhe($row['cha_numero']) ?></td>     
                    <td><a class="btn btn-info" href="<?=hlien("reservation","services","id", $row["res_id"]) ?>">Services</a></td>
                    <td><a class="btn btn-warning" href="<?= hlien("reservation", "edit", "id", $row["res_id"]) ?>">Modifier</a></td>
                    <td><a class="btn btn-danger" href="<?= hlien("reservation", "delete", "id", $row["res_id"]) ?>">Supprimer</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>