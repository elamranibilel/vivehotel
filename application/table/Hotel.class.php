<?php

/**
Classe créé par le générateur.
 */

class Hotel extends Table
{
	const statut = ["En attente", "Initialisé", "Annnulé",	"validé"];
	public function __construct()
	{
		parent::__construct("hotel", "hot_id");
	}

	// creation d'une table hotel categore
	public function selectAll(): array
	{
		$sql = "select * from hotel, hocategorie where hot_hocategorie=hoc_id";
		$result = self::$link->query($sql);
		return $result->fetchAll();
	}
	public function selectAllservices(): array
	{
		$sql = "select * from services order by ser_nom";
		$result = self::$link->query($sql);
		return $result->fetchAll();
	}

	static public function OPTIONhotel(int $idHotel)
	{
		return self::HTMLoptions('SELECT hot_id, hot_nom FROM hotel', 'hot_id', 'hot_nom', $idHotel);
	}
}
