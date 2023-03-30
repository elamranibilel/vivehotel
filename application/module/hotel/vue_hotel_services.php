    <h1>Services de hotel <?= mhe($_GET["id"]) ?></h1>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>
    			<th>Id</th>
    			<th>Nom</th>
    			<th>modifier</th>
    			<th>suprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { ?>
    			<tr>
    				<td><?= mhe($row['ser_id']) ?></td>
    				<td><?= mhe($row['ser_nom']) ?></td>
    				<td><a class="btn btn-warning" href="<?= hlien("services", "edit", "id", $row["ser_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("proposer", "delete", "id", $row["pro_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>