<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_hotel extends Ctr_controleur implements I_crud
{

	public function __construct($action)
	{
		parent::__construct("hotel", $action);
		$a = "a_$action";
		$this->$a();
	}

	function a_index()
	{
		checkallow('admin');
		$u = new Hotel();
		$data = $u->selectAll();
		require $this->gabarit;
	}

	//$_GET["id"] : id de l'enregistrement
	function a_edit()
	{
		checkallow('admin');
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Hotel();
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
		checkallow('admin');
		if (isset($_POST["btSubmit"])) {
			$u = new Hotel();
			$u->save($_POST);
			if ($_POST["hot_id"] == 0)
				$_SESSION["message"][] = "Le nouvel enregistrement Hotel a bien été créé.";
			else
				$_SESSION["message"][] = "L'enregistrement Hotel a bien été mis à jour.";
		}
		header("location:" . hlien("hotel"));
	}

	function a_delete()
	{
		checkallow('admin');
		if (isset($_GET["id"])) {
			$u = new Hotel();
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Hotel a bien été supprimé.";
		}
		header("location:" . hlien("hotel"));
	}
	function a_services()
	{
		checkallow('admin');
		$hotel = new Hotel();

		if (!isset($_GET["id"]) or !is_numeric($_GET['id'])) {
			header("location:" . hlien("hotel"));
		}
		$data = $hotel->selectAllServices($_GET["id"]);
		require $this->gabarit;
	}

	function a_services_edit()
	{
		checkallow('admin');
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;

		$pro = new Proposer();

		$data = $pro->select($id);
		extract($data);

		require $this->gabarit;
	}

	function a_services_save()
	{
		checkallow('admin');
		extract($_POST);

		if (isset($bt_submit)) {

			$pro_id = isset($pro_id) ? $pro_id : 0;
			$doublonProposer = isset($pro_services) ? Proposer::selectHotService($pro_hotel, $pro_services) : [];

			if (count($doublonProposer) > 0) {
				$_SESSION["message"][] = "Le service a déjà été créé pour l'hôtel {$pro_hotel}.";
				header("Location: " . hlien("hotel", "services", "id", $pro_hotel));
				exit();
			}

			$u = new Proposer();
			$u->save($_POST);
			$_SESSION["message"][] = ($pro_id == 0) ? "Le service a été créé pour l'hôtel {$pro_hotel}."
				: "Le prix du servuice a bien été mis à jour pour l'hôtel {$pro_hotel}.";

			$_SESSION["message"][] = "Le prix du service a bien été mis à jour pour l'hôtel {$pro_hotel}.";

			header("location: " . hlien("hotel", "services", "id", $pro_hotel));
		}
	}

	function a_statistiques()
	{
		checkallow('admin');

		$hotel = new Hotel();
		$data = (isset($_GET['id'])) ? $hotel->select($_GET['id']) : [];

		if (count($data)  === 0) {
			$_SESSION['message'][] = "Le numéro de l'hôtel demandé est invalide";
			header('Location: ' . hlien('hotel', 'index'));
			exit();
		}

		$chiffreA = $hotel->chiffreAffaire($_GET['id'])['c_affaire'];
		$caSservices = $hotel->CAservices($_GET['id'])['ca_service'];
		$chambreActif = $hotel->ChambreActifs($_GET["id"])['nb_chambres'];
		$chambreLibres = $hotel->ChambreLibres($_GET['id'])['nb_chambreLibres'];

		require $this->gabarit;
	}
}
