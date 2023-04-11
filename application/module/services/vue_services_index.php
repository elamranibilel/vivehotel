    <h2>Ensemble des services proposés dans les hôtels du groupe</h2>
    <p><a class="btn btn-primary" href="<?= hlien("services", "edit", "id", 0) ?>">Nouveau services</a></p>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>
    			<th>Nom</th>
    			<th>modifier</th>
    			<th>supprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { ?>
    			<tr>
    				<td><?= mhe($row['ser_nom']) ?></td>
					<td><a class="btn btn-info" href="<?= hlien("reservation", "services", "id", mhe($row["ser_id"])) ?>">Réservation</a></td>    				<td><a class="btn btn-warning" href="<?= hlien("services", "edit", "id", $row["ser_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("services", "delete", "id", $row["ser_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>