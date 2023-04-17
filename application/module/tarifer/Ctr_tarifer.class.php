<?php

/**
Controleur créé par le générateur.
Controleur associé à une table (implémente le CRUD)
 */
class Ctr_tarifer extends Ctr_controleur implements I_crud
{

	public function __construct($action)
	{
		parent::__construct("tarifer", $action);
		$a = "a_$action";
		$this->$a();
	}

	function a_index()
	{
		checkAllow('admin');
		$hoc = new Hocategorie();
		$chc = new Chcategorie();
		$tarifer = new Tarifer();

		$chCategorie = $chc->selectAll();
		$hoCategorie = $hoc->selectAll();

		$arrayTarifs = $tarifer->selectAll();

		$dimArrayTarifs = [
			'D1' => $hoc->countCat(),
			'D2' => $chc->countCat()
		];

		$grilleTarifaire = matriceSqlCD(
			$dimArrayTarifs,
			$tarifer::AXES_TABLEAU_TARIFS,
			$arrayTarifs
		);

		require $this->gabarit;
	}

	/* 
	* Traitement de la modification de la grille tarifaire
	* Reçoit un appel AJAX de modification
	*/
	function a_ajax()
	{
		checkAllow('admin');
		$tarif = new Tarifer();

		// Vérifier si l'utilsiateur est administrateur

		$reponseJSON = file_get_contents('php://input');
		$reponseArray = array_map('trim', json_decode($reponseJSON, true));

		$infosPrix = $tarif->selectPrix(
			$reponseArray['tar_hocategorie'],
			$reponseArray['tar_chcategorie']
		);

		$infosPrix['tar_prix'] = $reponseArray['tar_prix'];
		$tarif->save($infosPrix);
	}

	//$_GET["id"] : id de l'enregistrement
	function a_edit()
	{
		checkAllow('admin');
		$id = isset($_GET["id"]) ? $_GET["id"] : 0;
		$u = new Tarifer();
		if ($id > 0)
			$row = $u->select($id);
		else
			$row = $u->emptyRecord();

		extract($row);
		require $this->gabarit;
	}

	// Pas de fonction de sauvegarde des tarifs
	function a_save()
	{
		header("location:" . hlien("tarifer"));
	}

	// Pas de fonction de suppression de tarifs
	function a_delete()
	{
		header("location:" . hlien("tarifer"));
	}
}
