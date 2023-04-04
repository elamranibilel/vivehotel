    <form method="post" action="<?= hlien("hotel", "services_save") ?>">
        <input type="hidden" name="pro_id" id="pro_id" value="<?= $id ?>" />


        <div class='form-group'>
            <label for='pro_hotel'>Hotel</label>
            <input disabled type='text' size='50' value='<?= mhe($pro_hotel) ?>' class='form-control' />
            <input type="hidden" id="pro_hotel" name="pro_hotel" name="pro_hotel" value="<?= mhe($pro_hotel) ?>" />
        </div>
        <div class=' form-group'>
            <label for='pro_services'>Services</label>
            <select disabled class='form-control'>
                <?= Services::OPTIONServices($pro_services); ?>
            </select>
        </div>

        <div class='form-group'>
            <label for='pro_prix'>Prix</label>
            <input id='pro_prix' name='pro_prix' type='text' size='50' value='<?= mhe($pro_prix) ?>' class='form-control' />
        </div>

        <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
    </form>