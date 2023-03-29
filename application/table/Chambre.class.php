<?php

/**
Classe créé par le générateur.
 */
class Chambre extends Table
{
	const TYPE_LITS = [
		'2 Lits simples',
		'Lit double standard Queen Size',
		'Lit double Confort',
		'Lit double King Size',
		'1 lit double et un lit simple'
	];

	public function __construct()
	{
		parent::__construct("chambre", "cha_id");
	}

	public function selectAll(): array
	{
		$sql = "SELECT  cha_id, cha_numero, 
		cha_statut, cha_surface, cha_typelit,  cha_description, cha_jacuzzi,
		cha_balcon, cha_wifi, cha_minibar, cha_coffre,
		cha_vue, chc_categorie, cha_hotel FROM chambre, chcategorie, hotel 
		WHERE cha_chcategorie = chc_id AND cha_hotel = hot_id
		ORDER BY cha_id";

		$result = self::$link->query($sql);
		return $result->fetchAll();
	}

	public static function ARRAYstatut(): array
	{
		return ['Annnulé', 'Initialisé', 'Validé', 'En attente'];
	}

	static public function OPTIONChambre(int $idChambre)
	{
		return self::HTMLoptions('SELECT cha_id, cha_numero FROM chambre', 'cha_id', 'cha_numero', $idChambre);
	}
}
