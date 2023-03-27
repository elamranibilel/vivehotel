    <form method="post" action="<?= hlien("reservation", "save") ?>">
        <input type="hidden" name="res_id" id="res_id" value="<?= $id ?>" />

        <div class='form-group'>
            <label for='res_date_debut'>Date de dedebut</label>
            <input id='res_date_debut' name='res_date_debut' type='date' size='50' value='<?= mhe($res_date_debut) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='res_date_maj'>Date de mise à jour</label>
            <input id='res_date_maj' name='res_date_maj' type='datetime-local' size='50' value='<?= mhe($res_date_maj) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='res_date_fin'>Date_fin</label>
            <input id='res_date_fin' name='res_date_fin' type='date' size='50' value='<?= mhe($res_date_fin) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='res_etat'>Etat</label>
            <input id='res_etat' name='res_etat' type='text' size='50' value='<?= mhe($res_etat) ?>' class='form-control' />
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
                <?= Chambre::OPTIONChambre($res_hotel); ?>
            </select>
        </div>
        <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
    </form>