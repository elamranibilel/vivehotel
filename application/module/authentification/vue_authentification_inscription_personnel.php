        <h2>Inscription</h2>
        <form method="post" onsubmit="return verification()">
            <div class='form-group'>
                <label for='per_nom'>Nom</label>
                <input id='per_nom' name='per_nom' type='text' size='50' value='<?= mhe($per_nom) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='per_identifiant'>Identifiant</label>
                <input id='per_identifiant' name='per_identifiant' type='text' size='50' value='<?= mhe($per_identifiant) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='per_email'>Email</label>
                <input id='per_email' name='per_email' type='text' size='50' value='<?= mhe($per_email) ?>' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='per_mdp'>Mot de passe</label>
                <input id='per_mdp' name='per_mdp' type='password' size='50' value='' class='form-control' />
            </div>
            <div class='form-group'>
                <label for='per_mdp2'>Vérification du Mot de passe</label>
                <input id='per_mdp2' name='per_mdp2' type='password' size='50' value='' class='form-control' />
            </div>
            
            <input class="btn btn-success" type="submit" name="btSubmit" value="Enregistrer" />
        </form>
        <script>
            function verification() {
                if (per_mdp.value==per_mdp2.value) 
                    return true;
                else {
                    alert("Erreur : vérification du mot de passe incorrecte.");
                    return false;
                }
            }
        </script>