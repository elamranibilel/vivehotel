<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_chambre extends Ctr_controleur implements I_crud
{

	public function __construct($action)
	{
		parent::__construct("chambre", $action);
		$a = "a_$action";
		$this->$a();
	}

	function a_index()
	{
		$chClasse = new Chambre();
		$data = $chClasse->selectAll();

		require $this->gabarit;
	}

	//$_GET["id"] : id de l'enregistrement
	function a_edit()
	{
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Chambre();
		if ($id > 0)
			$row = $u->select($id);
		else
			$row = $u->emptyRecord();

		extract($row);
		require $this->gabarit;
	}

	//$_POST
	function a_save()
	{
		if (isset($_POST["btSubmit"])) {
			if (!in_array($_POST['cha_statut'], Chambre::ARRAYstatut())) { // Vérifier le statut de la chambre
				$_SESSION["message"][] = "Statut de la chambre non valide.";
				header("location:" . hlien("chambre"));
			}

			if (!array_key_exists($_POST['cha_typelit'], Chambre::ARRAYtypelit())) {
				$_SESSION["message"][] = "Le type de lit est incorrect !";
				header("location:" . hlien("chambre"));
			}

			$_POST['cha_typelit1'] = Chambre::ARRAYtypelit()[$_POST['cha_typelit']][0];
			$_POST['cha_typelit2'] = Chambre::ARRAYtypelit()[$_POST['cha_typelit']][1];

			$u = new Chambre();
			$u->save($_POST);
			if ($_POST["cha_id"] == 0)
				$_SESSION["message"][] = "Le nouvel enregistrement Chambre a bien été créé.";
			else
				$_SESSION["message"][] = "L'enregistrement Chambre a bien été mis à jour.";
		}
		header("location:" . hlien("chambre"));
	}



	//param GET id 
	function a_delete()
	{
		if (isset($_GET["id"])) {
			$u = new Chambre();
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Chambre a bien été supprimé.";
		}
		header("location:" . hlien("chambre"));
	}
}
