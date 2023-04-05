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

		array_map('trim', $_POST);

		if (
			isset($_POST['bt_submit'])
			&& isset($_POST['rech_texte'])
			&& isset($_POST['rech_champ'])
			&& in_array($_POST['rech_champ'], Chambre::CRI_RECHERCHE)
		) {
			$data = $chClasse->chaRecherche($_POST['rech_texte'], $_POST['rech_champ']);
		} else
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

		$CRI_RECHERCHE = Chambre::CRI_RECHERCHE;

		require $this->gabarit;
	}

	//$_POST
	function a_save()
	{
		if (isset($_POST["btSubmit"])) {
			if (!in_array($_POST['cha_statut'], Chambre::CHA_STATUT)) {
				$_SESSION["message"][] = "Statut de la chambre non valide.";
				header("location:" . hlien("chambre"));
			}

			$u = new Chambre();
			$u->save($_POST);
			$_SESSION["message"][] = ($_POST["cha_id"] == 0) ?  "Le nouvel enregistrement" .
				"Chambre a bien été créé." :  "L'enregistrement Chambre a bien été mis à jour.";
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

	function a_reservations()
	{
		if (!is_numeric($_GET['id'])) {
			$_SESSION['message'][] = 'Le lien est invalide';
			header('Location: ' . hlien('chambre', 'index'));
		}
		$cha = new Chambre();
		$dataCha = $cha->select($_GET['id']);
		if ($dataCha === false) {
			$_SESSION['message'][] = 'Le lien est invalide';
			header('Location: ' . hlien('chambre', 'index'));
		}

		$reserv = new Reservation();
		$data = $reserv->reservationsCha($_GET['id']);


		require $this->gabarit;
	}
}
