    <form method="post" action="<?=hlien("chambre","save")?>">
		<input type="hidden" name="cha_id" id="cha_id" value="<?= $id ?>" />
		
                        <div class='form-group'>
                            <label for='cha_numero'>Numero</label>
                            <input id='cha_numero' name='cha_numero' type='text' size='50' value='<?=mhe($cha_numero)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cha_statut'>Statut</label>
                            <input id='cha_statut' name='cha_statut' type='text' size='50' value='<?=mhe($cha_statut)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cha_surface'>Surface</label>
                            <input id='cha_surface' name='cha_surface' type='text' size='50' value='<?=mhe($cha_surface)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cha_typelit1'>Typelit1</label>
                            <input id='cha_typelit1' name='cha_typelit1' type='text' size='50' value='<?=mhe($cha_typelit1)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cha_typelit2'>Typelit2</label>
                            <input id='cha_typelit2' name='cha_typelit2' type='text' size='50' value='<?=mhe($cha_typelit2)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cha_description'>Description</label>
                            <input id='cha_description' name='cha_description' type='text' size='50' value='<?=mhe($cha_description)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cha_jacuzzi'>Jacuzzi</label>
                            <input id='cha_jacuzzi' name='cha_jacuzzi' type='text' size='50' value='<?=mhe($cha_jacuzzi)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cha_balcon'>Balcon</label>
                            <input id='cha_balcon' name='cha_balcon' type='text' size='50' value='<?=mhe($cha_balcon)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cha_wifi'>Wifi</label>
                            <input id='cha_wifi' name='cha_wifi' type='text' size='50' value='<?=mhe($cha_wifi)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cha_minibar'>Minibar</label>
                            <input id='cha_minibar' name='cha_minibar' type='text' size='50' value='<?=mhe($cha_minibar)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cha_coffre'>Coffre</label>
                            <input id='cha_coffre' name='cha_coffre' type='text' size='50' value='<?=mhe($cha_coffre)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cha_vue'>Vue</label>
                            <input id='cha_vue' name='cha_vue' type='text' size='50' value='<?=mhe($cha_vue)?>'  class='form-control' />
                        </div>
                        <div class='form-group'>
                            <label for='cha_chcategorie'>Chcategorie</label>
                            <input id='cha_chcategorie' name='cha_chcategorie' type='text' size='50' value='<?=mhe($cha_chcategorie)?>'  class='form-control' />
                        </div>
		<input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
	</form>              