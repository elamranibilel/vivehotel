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
		$u = new Hotel();
		$data = $u->selectAll();
		require $this->gabarit;
	}

	//$_GET["id"] : id de l'enregistrement
	function a_edit()
	{
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Hotel();
		if ($id > 0)
			$row = $u->select($id);
		else
			$row = $u->emptyRecord();
		extract($row);
		require $this->gabarit;
	}

	function a_edit_services()
	{
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Proposer();

		if ($id > 0)
			$row = $u->select($id);
		else {
			header('Locaiton: ' . hlien('hotel', 'index'));
			exit();
		}

		extract($row);
		require $this->gabarit;
	}

	//$_POST
	function a_save()
	{
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
		if (isset($_GET["id"])) {
			$u = new Hotel();
			$u->delete($_GET["id"]);
			$_SESSION["message"][] = "L'enregistrement Hotel a bien été supprimé.";
		}
		header("location:" . hlien("hotel"));
	}
	function a_services()
	{
		$hotel = new Hotel();

		if (!isset($_GET["id"]) or !is_numeric($_GET['id'])) {
			header("location:" . hlien("hotel"));
		}
		$data = $hotel->selectAllServices($_GET["id"]);
		require $this->gabarit;
	}

	function a_save_services()
	{
		$hotel = new Hotel();
		$service = new Services();

		if (isset($_POST["bt_submit"])) {
			extract($_POST);

			$dataService = $service->select($pro_services);
			$dataHotel = $hotel->select($pro_hotel);

			if (count($dataService) == 0 or count($dataHotel) == 0) {
				$_SESSION['message'][] = "L'hôtel ou le service n'existe pas";;
				header("Location: " . hlien('hotel', 'services', 'id', $pro_hotel));
				exit();
			}

			$proRecord = Proposer::selectHotService($dataHotel['hot_id'], $dataService['ser_id']);

			if (count($proRecord) != 0) {
				$_SESSION['message'][] = "Ce service existe déjà dans l'hôtel";
				header("Location: " . hlien('hotel', 'services', 'id', $pro_hotel));
				exit();
			}

			$proposer = new Proposer();
			$proposer->save($_POST);

			$_SESSION['message'][] = "Nouveau service proposé dans l'hôtel {$_POST['hot_id']}";
		} else {
			$_SESSION['message'][] = "Euh nan !";
		}

		header("Location: " . hlien('hotel', 'services', 'id', $pro_hotel));
		exit();
	}
}
