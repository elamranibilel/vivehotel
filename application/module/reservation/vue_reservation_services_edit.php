    <h1>Modifier le choix du service "<?= mhe($ser_nom) ?></h1>
    <form method="post" action="<?= hlien("reservation", "services_save") ?>">
        <input type="hidden" name="com_id" id="com_id" value="<?= $id ?>" />
        <input type="hidden" name="com_reservation" id="com_reservation" value="<?= $res_id ?>" />

        <div class='form-group'>
            <label for='pro_prix'>Prix</label>
            <input id='pro_prix' name='pro_prix' type='text' size='50' value='<?= mhe($pro_prix) ?>' class='form-control' />
        </div>

        <input class="btn btn-success" type="submit" value="Enregistrer" />
        <input type="hidden" name="bt_submit" />
    </form>