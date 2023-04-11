<h1>Liste des services de la réservation <?= mhe($_GET["id"]) ?></h1>
<table class="table table-striped table-bordered table-hover">
        <thead>
    		<tr>
    			<th>Service</th>
    			<th>modifier</th>
    			<th>suprimer</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php
			foreach ($data as $row) { // lister les services de la réservation mhe($_GET['id'])
			?>
    			<tr>
    				<td><?= mhe($row['ser_nom']) ?></td>
    				<td><a class="btn btn-warning" href="<?= hlien("reservation", "services_edit", "id", $row["com_id"]) ?>">Modifier</a></td>
    				<td><a class="btn btn-danger" href="<?= hlien("commander", "delete", "id", $row["com_id"]) ?>">Supprimer</a></td>
    			</tr>
    		<?php } ?>
    	</tbody>
    </table>
<!-- 
Créer un formulaire qui permet d'ajouter un service à la réservation
* Faire une liste des services qui n'ont pas été prises par la réservation
* Modifier le formulaire
* Traiter le formulaire dans une action save_ser
-->
    <form method="post" action="<?= hlien('reservation', 'services') ?>">
    	<label for="nouve_service">Ajouter un service dans la reservation :</label>
    	<select name="com_services">
    		<?= Services::optionNotServices($_GET['id']); ?>
    	</select>
    	<input type="hidden" name="com_reservation" value="<?= mhe($_GET['id']) ?>" />
    	<input type="hidden" name="com_reservation" value="<?= mhe($_GET['id']) ?>" />
    	<input type="hidden" name="bt_submit" />
    	<input type="submit" value="Envoyer" />
    </form>