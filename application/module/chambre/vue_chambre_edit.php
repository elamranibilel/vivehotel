    <form method="post" action="<?= hlien("chambre", "save") ?>">
        <input type="hidden" name="cha_id" id="cha_id" value="<?= $id ?>" />

        <div class='form-group'>
            <h1>
                <label for='cha_numero'>Modification de la chambre <?= mhe($cha_numero) ?></label>
            </h1>
            <h2><a href="<?= hlien('chambre', 'index') ?>">Liste des chambres</a></h2>

        </div>
        <div class='form-group'>
            <label for='cha_statut'>Statut</label>
            <select id='cha_statut' name='cha_statut' type='text' class='form-control'>
                <option selected value='Annnulé'>Annnulé</option>
                <option value='Initialisé'>Initialisé</option>
                <option value='Validé'>Validé</option>
                <option value='En attente'>En attente</option>
            </select>
        </div>
        <div class='form-group'>
            <label for='cha_surface'>Surface</label>
            <input id='cha_surface' name='cha_surface' type='number' size='50' value='16' class='form-control' />
        </div>
        <div class='form-group'>
            <label for='cha_typeLit'>Type lits</label>
            <select id='cha_typeLit' name='cha_typeLit' class='form-control'>
                <?php foreach (Chambre::TYPE_LITS as $typelit) { ?>
                    <option value='<?= mhe($typelit) ?>' <?= ($typelit === $row['cha_typeLit']) ? 'selected' : '' ?>><?= mhe($typelit) ?></option>
                <?php } ?>
            </select>
        </div>

        <div class='form-group'>
            <label for='cha_description'>Description</label><br />
            <textarea id='cha_description' name='cha_description' rows='5' class='form-control'>text 1 &lt;a href=&#039;index.php&#039;&gt;Accueil&lt;/a&gt;</textarea>
        </div>
        <div class='form-group'>
            <label for='cha_jacuzzi'>Jacuzzi</label>
            <select id='cha_jacuzzi' name='cha_jacuzzi' type='text' class='form-control'>
                <option value='0' <?= ($cha_jacuzzi ===  0) ? 'selected' : '' ?>>Non</option>
                <option value='1' <?= ($cha_jacuzzi ===  1) ? 'selected' : '' ?>>Oui</option>
            </select>
        </div>
        <div class='form-group'>
            <label for='cha_balcon'>Balcon</label>
            <select id='cha_balcon' name='cha_balcon' type='text' class='form-control'>
                <option value='0' <?= ($cha_balcon ===  0) ? 'selected' : '' ?>>Non</option>
                <option value='1' <?= ($cha_balcon ===  1) ? 'selected' : '' ?>>Oui</option>
            </select>
        </div>
        <div class='form-group'>
            <label for='cha_wifi'>Wifi</label>
            <select id='cha_wifi' name='cha_wifi' type='text' class='form-control'>
                <option value='0' <?= ($cha_wifi ===  0) ? 'selected' : '' ?>>Non</option>
                <option value='1' <?= ($cha_wifi ===  1) ? 'selected' : '' ?>>Oui</option>
            </select>
        </div>
        <div class='form-group'>
            <label for='cha_minibar'>Minibar</label>
            <select id='cha_minibar' name='cha_minibar' type='text' class='form-control'>
                <option value='0' <?= ($cha_minibar === 0) ? 'selected' : '' ?>>Non</option>
                <option value='1' <?= ($cha_minibar ===  1) ? 'selected' : '' ?>>Oui</option>
            </select>
        </div>
        <div class='form-group'>
            <label for='cha_coffre'>Coffre</label>
            <select id='cha_coffre' name='cha_coffre' type='text' class='form-control'>
                <option value='0' <?= ($cha_coffre ===  0) ? 'selected' : '' ?>>Non</option>
                <option value='1' <?= ($cha_coffre ===  1) ? 'selected' : '' ?>>Oui</option>
            </select>
        </div>
        <div class='form-group'>
            <label for='cha_vue'>Vue</label>
            <select id='cha_vue' name='cha_vue' type='text' class='form-control'>
                <option value='0' <?= ($cha_vue ===  0) ? 'selected' : '' ?>>Non</option>
                <option value='1' <?= ($cha_vue ===  1) ? 'selected' : '' ?>>Oui</option>
            </select>
        </div>
        <div class='form-group'>
            <label for='cha_chcategorie'>Catégorie de la chambre</label>
            <select id="cha_chcategorie" name="cha_chcategorie">
                <option value='1'>Standard</option>
                <option selected value='2'>Supérieure</option>
                <option value='3'>Luxe</option>
                <option value='4'>Suite</option>
            </select>
        </div>
        <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
    </form>
    </div>
    <hr>
    <footer>
        Framework-GUINOT&copy;2021-2022

        <script src="_js/script.js"></script>
    </footer>
    </div>
    </body>

    </html>