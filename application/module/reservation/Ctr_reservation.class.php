<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_reservation extends Ctr_controleur implements I_crud
{

	public function __construct($action)
	{
		parent::__construct("reservation", $action);
		$a = "a_$action";
		$this->$a();
	}

	function a_index()
	{
		$u = new Reservation();
		$data = $u->selectAll();
		require $this->gabarit;
	}

	//$_GET["id"] : id de l'enregistrement
	function a_edit()
	{
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Reservation();
		$res_commandes = [];
		if ($id > 0) {
			$row = $u->select($id);
			$res_commandes = Services::Res($id);
		} else
			$row = $u->emptyRecord();

		extract($row);
		require $this->gabarit;
	}

	//$_POST
	function a_save()
	{
		if (isset($_POST["btSubmit"])) {
			$u = new Reservation();
			$aDoublons = $u->doublons($_POST);

			if ($aDoublons) {
				$_SESSION["message"][] = "La chambre n'est pas libre entre ces deux dates : "
					. "la réservation n'a pas été modifiée";
				header("location:" . hlien("reservation", "edit", "id", $_POST['res_id']));
				exit();
			}

			print_r($_POST);
			print('date début :' . strtotime($_POST['res_date_debut']));
			print(' date fin :' . strtotime($_POST['res_date_fin']));

			if (strtotime($_POST['res_date_debut']) > strtotime($_POST['res_date_fin'])) {
				$_SESSION["message"][] = "La réservation se termine avant la date de début : pas de mise à jour";
				header("location:" . hlien("reservation", "edit", "id", $_POST['res_id']));
				exit();
			}

			$_POST['res_date_maj'] = $_POST['res_date_creation'] ?? date('Y-m-d', time());

			if ($_POST["res_id"] == 0) {
				$_SESSION["message"][] = "Le nouvel enregistrement Reservation a bien été créé.";
				$_POST['res_date_creation'] = date('Y-m-d', time());
			} else {
				$_SESSION["message"][] = "L'enregistrement Reservation a bien été mise à jour.";
			}
			$u->save($_POST);
			header("location:" . hlien("reservation", "edit", "id", $_POST['res_id']));
		}
	}



	//param GET id 
	function a_delete()
	{
		if (isset($_GET["id"])) {
			$u = new Reservation();
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Reservation a bien été supprimé.";
		}
		header("location:" . hlien("reservation"));
	}

	function a_client()
	{
		if (!isset($_GET["id"]))
			header('Location: ' . hlien('client'));

		$u = new Reservation();
		$data = $u->reservationsClient($_GET["id"]);

		$cli = new Client();
		$client = $cli->select($_GET['id']);

		require $this->gabarit;
	}
}
