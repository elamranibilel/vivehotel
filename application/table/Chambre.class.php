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

	static public function OPTIONStatut($statut)
	{
		return self::HTMLoptions(
			'SELECT DISTINCT cha_statut FROM chambre',
			'cha_statut',
			'cha_statut',
			$statut
		);
	}
}
