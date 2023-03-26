<?php

/**
Classe créé par le générateur.
 */
class Chambre extends Table
{
	public function __construct()
	{
		parent::__construct("chambre", "cha_id");
	}

	public function selectAll(): array
	{
		$sql = "SELECT  cha_id, cha_numero, 
		cha_statut, cha_surface, cha_typelit1, 
		cha_typelit2, cha_description, cha_jacuzzi,
		cha_balcon, cha_wifi, cha_minibar, cha_coffre,
		cha_vue, chc_categorie FROM chambre, chcategorie 
		WHERE cha_chcategorie = chc_id
		ORDER BY cha_id 
		";

		$result = self::$link->query($sql);
		return $result->fetchAll();
	}

	public static function ARRAYstatut(): array
	{
		return ['Annnulé', 'Initialisé', 'Validé', 'En attente'];
	}

	public static function ARRAYtypelit(): array
	{
		return [
			'2 Lits simples' => ['Lit simple', 'Lit simple'],
			'Lit double standard Queen Size' => ['Lit double standard Queen Size', ''],
			'Lit double Confort' => ['Lit double Confort', ''],
			'Lit double King Size' => ['Lit double King Size', ''],
			'1 lit double et un lit simple' => ['Lit double', 'lit simple']
		];
	}
}
