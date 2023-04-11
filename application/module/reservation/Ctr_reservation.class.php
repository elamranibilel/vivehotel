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
		} else {
			$row = $u->emptyRecord();
			$res_commandes = [];
		}

		extract($row);
		require $this->gabarit;
	}

	//$_POST
	function a_save()
	{
		if (!isset($_POST["btSubmit"])) exit();

		$u = new Reservation();
		$aDoublons = $u->aDoublons($_POST);

		if ($aDoublons) {
			$_SESSION["message"][] = "La chambre n'est pas libre entre ces deux dates : "
				. "la réservation n'a pas été modifiée";
			header("location:" . hlien("reservation", "edit", "id", $_POST['res_id']));
			exit();
		}

		if (strtotime($_POST['res_date_debut']) > strtotime($_POST['res_date_fin'])) {
			$_SESSION["message"][] = "La réservation se serait terminé avant de commencer : pas de mise à jour";
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

	function a_save_res()
	{
		if (!isset($_GET["id"]))
			header('Location: ' . hlien('client'));
	}

	function a_services()
	{
		$reservation = new Reservation();

		if (!isset($_GET["id"]) or !is_numeric($_GET["id"])) {
			header("Location: " . hlien('reservation'));
		}

		$data = $reservation->reservationServices($_GET["id"]);
		require $this -> gabarit;
	}

	function a_services_edit()
	{
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;

		$com = new Commander();

		$data = $com->selecte($id);
		extract($data);

		require $this->gabarit;
	}

	function a_services_save()
	{
		extract($_POST);

		if (isset($bt_submit)) {

			$com_id = isset($com_id) ? $com_id : 0;
			$doublonCommander = isset($com_services) ? Commander::selectResServices($com_reservation, $com_services) : [];

			if (count($doublonCommander) > 0) {
				$_SESSION["message"][] = "Le service a déjà été créé pour la réservation {$com_reservation}.";
				header("Location: " . hlien("reservation", "services", "id", $com_reservation));
				exit();
			}

			$u = new Reservation();
			$u->save($_POST);
			$_SESSION["message"][] = ($res_id == 0) ? "Le service a été créé pour la réservation {$com_reservation}."
				: "Le prix du servuice a bien été mis à jour pour la réservation {$com_reservation}.";

			//$_SESSION["message"][] = "Le prix du service a bien été mis à jour pour l'hôtel {$pro_hotel}.";

			header("location: " . hlien("reservation", "services", "id", $com_reservation));
		}
	}
	}
