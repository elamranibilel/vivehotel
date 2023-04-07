    <form method="post" action="<?= hlien("tarifer", "save") ?>">
        <input type="hidden" name="tar_id" id="tar_id" value="<?= $id ?>" />

        <div class='form-group'>
            <label for='tar_prix'>Prix</label>
            <input id='tar_prix' name='tar_prix' type='text' size='50' value='<?= mhe($tar_prix) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='tar_hocategorie'>Hocategorie</label>
            <input id='tar_hocategorie' name='tar_hocategorie' type='text' size='50' value='<?= mhe($tar_hocategorie) ?>' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='tar_chcategorie'>Chcategorie</label>
            <input id='tar_chcategorie' name='tar_chcategorie' type='text' size='50' value='<?= mhe($tar_chcategorie) ?>' class='form-control' />
        </div>
        <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
    </form>