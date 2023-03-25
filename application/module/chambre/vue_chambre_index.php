    <h2>chambre</h2>
    <p><a class="btn btn-primary" href="<?= hlien("chambre", "edit", "id", 0) ?>">Nouveau chambre</a></p>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>

    			<th>Id</th>
    			<th>Numero</th>
    			<th>Statut</th>
    			<th>Surface</th>
    			<th>Type lits</th>

    			<th>Description</th>
    			<th>Services</th>
    			<th>Chcategorie</th>
    			<th>modifier</th>
    			<th>supprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) {
				array_map('trim', $row);
			?>
    			<tr>

    				<td><?= mhe($row['cha_id']) ?></td>
    				<td><?= mhe($row['cha_numero']) ?></td>
    				<td><?= mhe($row['cha_statut']) ?></td>
    				<td><?= mhe($row['cha_surface']) ?>m²</td>
    				<td><?= mhe($row['cha_typelit1']) ?> <?= mhe($row['cha_typelit2']) ?></td>
    				<td><?= $row['cha_description'] ?></td>
    				<td>
    					<?= ($row['cha_jacuzzi'] === 1 ? 'jaccuzi' : '') ?>
    					<?= ($row['cha_balcon'] === 1 ? 'balcon' : '') ?>
    					<?= ($row['cha_wifi'] === 1 ? 'wifi' : '') ?>
    					<?= ($row['cha_minibar'] === 1 ? 'minibar' : '') ?>
    					<?= ($row['cha_coffre'] === 1 ? 'coffre' : '') ?>
    					<?= ($row['cha_vue'] === 1 ? 'vue' : '') ?>
    				</td>
    				<td><?= mhe($row['chc_categorie']) ?></td>
    				<td><a class="btn btn-warning" href="<?= hlien("chambre", "edit", "id", $row["cha_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("chambre", "delete", "id", $row["cha_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>