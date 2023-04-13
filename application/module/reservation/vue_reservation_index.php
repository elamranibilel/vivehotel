    <h2>Liste des réservations de la catégorie (limité à 100 résultats)</h2>

    <form method="post">
    	<label for="nom_film">Rechercher une réservation :</label> <input type="text" name="nom_reservation" value='' />
    	<input type="hidden" name="bt_submit" />
    	<input class="btn btn-success" type="submit" value="Enregistrer" />
    </form>

    <p><a class="btn btn-primary" href="<?= hlien("reservation", "edit", "id", 0) ?>">Nouveau reservation</a></p>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>

    			<th>Id</th>
    			<th>Date creation</th>
    			<th>Date debut</th>
    			<th>Date fin</th>
    			<th>Etat</th>
    			<th>Client</th>
    			<th>Hotel</th>
    			<th>Chambre</th>
				<th>Services</th>
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
    				<td><?= mhe($row['res_date_fin']) ?></td>
    				<td><?= mhe($row['res_etat']) ?></td>
    				<td><?= mhe($row['res_client']) ?></td>
    				<td><?= mhe($row['res_hotel']) ?></td>
    				<td><?= mhe($row['res_chambre']) ?></td>
					<td><a class="btn btn-info" href="<?=hlien("reservation","services","id", $row["res_id"]) ?>">Services</a></td>
    				<td><a class="btn btn-warning" href="<?= hlien("reservation", "edit", "id", $row["res_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("reservation", "delete", "id", $row["res_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>