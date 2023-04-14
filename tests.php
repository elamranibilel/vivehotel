<?php    
    extract($_POST);
    if (isset($btSubmit)) {
        //récupérer en bdd le personnel  qui possède $per_email
        $row = Personnel::selectByEmail($per_email);

        if ($row === false) {
            $_SESSION["message"][] = "$per_email n'existe pas. Vérifiez votre saisie";
            require $this->gabarit;
        }
        

        $_SESSION["per_id"] = $per_id;
        $_SESSION["per_nom"] = $per_nom;
        $_SESSION["per_identifiant"] = $per_identifiant;
        $_SESSION["per_email"] = $per_email;
        $_SESSION["per_profil"] = $per_profil;
        $_SESSION["per_role"] = $per_role;
        $_SESSION["per_hotel"] = $per_hotel;
        $_SESSION["message"][] = "bienvenu $per_nom.";
        header("location:" . hlien("_default"));
    } else {
        $per_email = "";
        require $this->gabarit;
    }