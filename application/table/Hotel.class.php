<?php

/**
Classe créé par le générateur.
 */

class Hotel extends Table
{
	const STATUT = ["En attente", "Initialisé", "Annnulé",	"validé"];
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
	public function selectAllservices($id): array
	{
		$sql = "SELECT ser_id, ser_nom, 
		pro_prix, pro_hotel, pro_id
		FROM proposer, services
		WHERE pro_services=ser_id 
		AND pro_hotel=:id";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	static public function OPTIONhotel(string $selected)
	{
		return Table::HTMLoptions('SELECT * FROM hotel', 'hot_id', 'hot_nom', $selected);
	}
}
