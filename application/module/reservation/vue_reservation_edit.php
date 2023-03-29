<h1>Modifier une réservation de la chambre <?= mhe($res_chambre) ?> de l'hôtel <?= mhe($res_hotel) ?></h1>
<form method="post" action="<?= hlien("reservation", "save") ?>">
    <input type="hidden" name="res_id" id="res_id" value="<?= $id ?>" />

    <div class='form-group'>
        <label for='res_date_debut'>Date de dedebut</label>
        <input id='res_date_debut' name='res_date_debut' type='date' size='50' value='<?= mhe($res_date_debut) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='res_date_fin'>Date_fin</label>
        <input id='res_date_fin' name='res_date_fin' type='date' size='50' value='<?= mhe($res_date_fin) ?>' class='form-control' />
    </div>
    <div class='form-group'>
        <label for='res_etat'>Etat</label>
        <select id='res_etat'>
            <?php
            foreach (Reservation::RES_ETAT as $etat) {
                echo "<option value='$etat'>$etat</option>";
            }
            ?>
        </select>
    </div>
    <div class='form-group'>
        <label for='res_client'>Client</label>
        <select id='res_client' name='res_client' type='text' class='form-control'>
            <?= Client::OPTIONclients($res_client); ?>
        </select>
    </div>
    <div class='form-group'>
        <label for='res_hotel'>Hotel</label>
        <select id='res_hotel' name='res_hotel' type='text' class='form-control'>
            <?= Hotel::OPTIONhotel($res_hotel); ?>
        </select>
    </div>
    <div class='form-group'>
        <label for='res_chambre'>Chambre</label>
        <select id='res_chambre' name='res_chambre' type='text' class='form-control'>
            <?= Chambre::OPTIONChambre($res_chambre); ?>
        </select>
    </div>
    <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
</form>
<hr />
<table class="table table-striped table-bordered table-hover">
    <caption>Liste des services d'une réservation.</caption>
    <tr>
        <th>Nom</th>
        <th>Quantité</th>
        <th>Prix (unitaire)</th>

    </tr>
    <?php if (count($res_commandes) == 0)
        echo '<tr><td colspan="3">Pas de service pour cette réservation</td></tr>';
    else {
        foreach ($res_commandes as $row) {
            array_map('mhe', $row);
    ?>
            <tr>
                <td><?= $row['ser_nom'] ?></td>
                <td><?= mhe($row['com_quantite']) ?></td>
                <td><?= mhe($row['pro_prix']) ?></td>
            </tr>
    <?php }
    } ?>
</table>

<form method="post" action="<?= hlien('reservation', 'save') ?>">
    <label for="nouv_service">Ajouter un service à la réservation :</label>
    <select name="nouv_service">
        <?= Services::pasRes($res_id) ?>
    </select>
    <input type="hidden" name="novueau_service" />
    <input type="hidden" name="btsubmit" />

    <input type="text" name="serv_quantite" />

    <input type="submit" value="Envoyer" />
</form>