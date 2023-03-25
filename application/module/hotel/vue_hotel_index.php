    <h2>hotel</h2>
    <p><a class="btn btn-primary" href="<?= hlien("hotel", "edit", "id", 0) ?>">Nouveau hotel</a></p>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>

    			<th>Id</th>
    			<th>Statut</th>
    			<th>Nom</th>
    			<th>Adresse</th>
    			<th>Departement</th>
    			<th>Description</th>
    			<th>Catégorie</th>
    			<th>modifier</th>
    			<th>Supprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { ?>
    			<tr>

    				<td><?= mhe($row['hot_id']) ?></td>
    				<td><?= mhe($row['hot_statut']) ?></td>
    				<td><?= mhe($row['hot_nom']) ?></td>
    				<td><?= mhe($row['hot_adresse']) ?></td>
    				<td><?= mhe($row['hot_departement']) ?></td>
    				<td><?= mhe($row['hot_description']) ?></td>
    				<td><?= mhe($row['hoc_hocategorie']) ?></td>
    				<td><a class="btn btn-warning" href="<?= hlien("hotel", "edit", "id", $row["hot_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("hotel", "delete", "id", $row["hot_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>