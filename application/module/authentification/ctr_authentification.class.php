<?php
class Ctr_authentification extends Ctr_controleur
{

    public function __construct($action)
    {
        parent::__construct("authentification", $action);
        $a = "a_$action";
        $this->$a();
    }

    public function a_inscription()
    {
        extract($_POST);
        if (isset($_SESSION["cli_id"])) {
            $_SESSION["message"][] = "Tentative d'intrusion détectée...";
            require $this->gabarit;
            exit;
        }

        if (isset($btSubmit)) {
            //vérifier que $cli_email est unique
            if (!Utilisateur::estEmailUnique($cli_email)) {
                $_SESSION["message"][] = "$cli_email : cette adresse mail est déjà prise. Veuillez en saisir une autre.";
                require $this->gabarit;
                exit;
            }

            //vérifier que $cli_mdp==$cli_mdp2
            if ($cli_mdp != $cli_mdp2) {
                $_SESSION["message"][] = "La vérification du mot de passe à échouer. Veuillez vérifier votre mot de passe.";
                require $this->gabarit;
                exit;
            }

            //Tous est ok : enregistrement du nouvel Utilisateur
            $_POST["cli_id"] = 0;
            $_POST["cli_mdp"] = password_hash($_POST["cli_mdp"], PASSWORD_DEFAULT);
            $_POST["cli_profil"] = "client";
            (new Utilisateur)->save($_POST);
            $_SESSION["message"][] = "procédez à votre réservation !  $cli_nom ! Inscription réussie. Vous pouvez maintenant vous connecter.";
            //rediriger sur la réservation
            header("location:" . hlien("_reservation"));

            //Tous est ok : enregistrement du nouvel utilisateur
            $_POST["per_id"] = 0;
            $_POST["per_mdp"] = password_hash($_POST["per_mdp"], PASSWORD_DEFAULT);
            $_POST["per_profil"] = "client";
            (new Utilisateur)->save($_POST);
            $_SESSION["message"][] = "Bravo $per_nom ! Inscription réussie. Vous pouvez maintenant vous connecter.";
            //rediriger sur l'accueil
            header("location:" . hlien("_default"));
        } else {
            //affichage du formulaire
            extract((new Utilisateur())->emptyRecord());
            require $this->gabarit;
        }
    }

    public function a_connexion()
    {
        if (isset($_SESSION["cli_id"])) {
            $_SESSION["message"][] = "Tentative d'intrusion détectée...";
            require $this->gabarit;
            exit;
        }

        extract($_POST);
        if (isset($btSubmit)) {
            //récupérer en bdd l'Utilisateur qui posséde $cli_email
            $row = Utilisateur::selectByEmail($cli_email);

            if ($row === false) {
                $_SESSION["message"][] = "$cli_email n'existe pas. Vérifiez votre saisie";
                require $this->gabarit;
                exit;
            }

            //vérification du mot de passe
            if (!password_verify($cli_mdp, $row["cli_mdp"])) {
                $_SESSION["message"][] = "Mot de passe incorrect.";
                require $this->gabarit;
                exit;
            }

            //Connexion réussie
            extract($row);
            $_SESSION["cli_id"] = $cli_id;
            $_SESSION["cli_nom"] = $cli_nom;
            $_SESSION["cli_identifiant"] = $cli_identifiant;
            $_SESSION["cli_email"] = $cli_email;
            $_SESSION["cli_profil"] = $cli_profil;
            $_SESSION["message"][] = "bienvenu $cli_identifiant $cli_nom.";
            header("location:" . hlien("_default"));
        } else {
            $cli_email = "";
            require $this->gabarit;
        }
    }

    public function a_deconnexion()
    {
        $_SESSION = [];
        $_SESSION["message"][] = "Vous êtes bien déconnecté.";
        header("location:" . hlien("_default"));
    }



    public function a_inscription_gestionnaire()
    {
        extract($_POST);
        if (isset($_SESSION["per_id"])) {
            $_SESSION["message"][] = "Tentative d'intrusion détectée...";
            require $this->gabarit;
            exit;
        }

        if (isset($btSubmit)) {
            //vérifier que $per_email est unique
            if (!Personnel::estEmailUnique($per_email)) {
                $_SESSION["message"][] = "$per_email : cette adresse mail est déjà prise. Veuillez en saisir une autre.";
                require $this->gabarit;
                exit;
            }

            //vérifier que $per_mdp==$per_mdp2
            if ($per_mdp != $per_mdp2) {
                $_SESSION["message"][] = "La vérification du mot de passe à échouer. Veuillez vérifier votre mot de passe.";
                require $this->gabarit;
                exit;
            }

            //Tous est ok : enregistrement du nouvel Utilisateur
            $_POST["per_id"] = 0;
            $_POST["per_mdp"] = password_hash($_POST["per_mdp"], PASSWORD_DEFAULT);
            $_POST["per_profil"] = "personnel";
            (new Personnel)->save($_POST);
            $_SESSION["message"][] = "
            bienvenu !  $per_nom ! Inscription réussie. Vous pouvez maintenant vous connecter.";
            //rediriger sur l'hôtel
            header("location:" . hlien("hotel"));

            //Tous est ok : enregistrement du nouvel utilisateur
            $_POST["per_id"] = 0;
            $_POST["per_mdp"] = password_hash($_POST["per_mdp"], PASSWORD_DEFAULT);
            $_POST["per_profil"] = "personnel";
            (new Personnelr)->save($_POST);
            $_SESSION["message"][] = "Bravo $per_nom ! Inscription réussie. Vous pouvez maintenant vous connecter.";
            //rediriger sur l'accueil
            header("location:" . hlien("_default"));
        } else {
            //affichage du formulaire
            extract((new Personnel())->emptyRecord());
            require $this->gabarit;
        }
    }

    public function a_connexion_gestionnaire()
    {
        if (isset($_SESSION["per_id"])) {
            $_SESSION["message"][] = "Tentative d'intrusion détectée...";
            require $this->gabarit;
            exit;
        }

        extract($_POST);
        if (isset($btSubmit)) {
            //récupérer en bdd l'Utilisateur qui posséde $per_email
            $row = Personnel::selectByEmail($per_email);

            if ($row === false) {
                $_SESSION["message"][] = "$per_email n'existe pas. Vérifiez votre saisie";
                require $this->gabarit;
                exit;
            }

            //vérification du mot de passe
            if (!password_verify($per_mdp, $row["per_mdp"])) {
                $_SESSION["message"][] = "Mot de passe incorrect.";
                require $this->gabarit;
                exit;
            }

            //Connexion réussie
            extract($row);
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
    }

    public function a_deconnexion_gestionnaire()
    {
        $_SESSION = [];
        $_SESSION["message"][] = "Vous êtes bien déconnecté.";
        header("location:" . hlien("_default"));
    }
}
