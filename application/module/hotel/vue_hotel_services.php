    <h1>Services de hotel <?= mhe($_GET["id"]) ?></h1>
    <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>
    			<th>Nom</th>
    			<th>Prix</th>
    			<th>modifier</th>
    			<th>suprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { ?>
    			<tr>
    				<td><?= mhe($row['ser_nom']) ?></td>
    				<td><?= mhe($row['pro_prix']) ?></td>
    				<td><a class="btn btn-warning" href="<?= hlien("services", "edit", "id", $row["ser_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("proposer", "delete", "id", $row["pro_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>

    <form method="post" action="<?= hlien('hotel', 'save_services') ?>">
    	<label for="nouv_service">Ajouter un service à l'hôtel courant :</label>
    	<select name="pro_services">
    		<?= Services::optionNotHotel($_GET['id']); ?>
    	</select> Prix : <input type="number" name="pro_prix" size="5" />
    	<input type="hidden" name="pro_hotel" value="<?= mhe($_GET['id']) ?>" />
    	<input type="hidden" name="bt_submit" />
    	<input type="submit" value="Envoyer" />
    </form>