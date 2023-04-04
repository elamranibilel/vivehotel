<?php

/**
Classe créé par le générateur.
 */
class Proposer extends Table
{
	public function __construct()
	{
		parent::__construct("proposer", "pro_id");
	}

	static public function selectHotService(int $hotel, int $service): array
	{
		$sql = "SELECT hot_nom, ser_nom FROM proposer, services, hotel 
		WHERE pro_services = :services 
		AND pro_services = ser_id
		AND pro_hotel = hot_id
		AND pro_hotel = :hotel";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(":hotel", $hotel, PDO::PARAM_INT);
		$stmt->bindValue(":services", $service, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}
