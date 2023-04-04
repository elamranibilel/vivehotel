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
		$sql = "SELECT  per_id, per_nom, per_identifiant, per_mdp, per_email, per_role	
		per_hotel, hot_nom, ser_nom FROM proposer, service, hotel 
		WHERE pro_services = :service 
		AND pro_services = ser_id
		AND pro_hotel = hot_id
		AND pro_hotel = :hotel";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(":hotel", $hotel, PDO::PARAM_INT);
		$stmt->bindValue(":service", $service, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}
