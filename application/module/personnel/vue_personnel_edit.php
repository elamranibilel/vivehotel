    <form method="post" action="<?=hlien("personnel","save")?>">
		<input type="hidden" name="per_id" id="per_id" value="<?= $id ?>" />
		
                        <div class='form-group'>
                            <label for='per_nom'>Nom</label>
                            <input id='per_nom' name='per_nom' type='text' size='50' value='<?=mhe($per_nom)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='per_identifiant'>Identifiant</label>
                            <input id='per_identifiant' name='per_identifiant' type='text' size='50' value='<?=mhe($per_identifiant)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='per_mdp'>Mdp</label>
                            <input id='per_mdp' name='per_mdp' type='text' size='50' value='<?=mhe($per_mdp)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='per_email'>Email</label>
                            <input id='per_email' name='per_email' type='text' size='50' value='<?=mhe($per_email)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='per_role'>Role</label>
                            <input id='per_role' name='per_role' type='text' size='50' value='<?=mhe($per_role)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='per_hotel'>Hotel</label>
                            <input id='per_hotel' name='per_hotel' type='text' size='50' value='<?=mhe($per_hotel)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              