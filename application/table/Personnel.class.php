<?php

/**
Classe créé par le générateur.
 */
class Personnel extends Table
{
	public function __construct()
	{
		parent::__construct("personnel", "per_id");
	}

	public function selectAll(): array
	{
		$sql = "SELECT
		per_id,	
		per_nom,
		per_identifiant,	
		per_mdp,
		per_email,	
		per_role,	
		hot_nom
		FROM personnel, hotel
		WHERE per_hotel = hot_id
		ORDER BY per_id";
		$stmt = self::$link->query($sql);
		return $stmt->fetchAll();
	}
}
