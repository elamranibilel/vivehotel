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

		$data = $reservation->reservationServices($_GET['id']);


		require $this->gabarit;
	}

	function a_services_edit()
	{
		$reservation = new Reservation();

		$res = $reservation->select($_GET['id']);
		$noHotel = $res['res_hotel'];


		$data = $reservation->reservationServices($_GET["id"]);

		foreach ($data as $enreg) {
			// Vérifie si le service ajouté correspond déjà à un service de la réservation
			if ($_POST['com_service'] == $enreg['com_service']) {
				$_SESSION['message'][] = 'Le service a déjà été pris par cette réservation';
			}
		}

		$reservation->save($_POST);
		header('Location: ' . hlien('reservation', 'services', 'id', $_GET['id']));
		require $this->gabarit;
	}

	function a_services_save()
	{
		$reservation = new Reservation();

		$data = $reservation->reservationServices($_POST["com_reservation"]);


		foreach ($data as $enreg) {
			// Vérifie si le service ajouté correspond déjà à un service de la réservation
			if ($_POST['com_service'] == $enreg['com_service']) {
				$_SESSION['message'][] = 'Le service a déjà été pris par cette réservation';
			}
		}

		$commander = new Commander();
		$commander->save($_POST);

		header('Location: ' . hlien('reservation', 'services', 'id', $_POST['com_reservation']));
		require $this->gabarit;
	}

	function a_services_delete()
	{

		if (isset($_GET["id"])) {

			$u = new Commander();
			$com = $u->select($_GET['id']);
			$idReservation = $com['com_reservation'];

			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Commander a bien été supprimé.";
			header("Location: " . hlien("reservation", "services", "id", $idReservation));
			exit();
		}
		header("location: " . hlien("reservation"));
	}
}
