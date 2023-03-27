<?php

/**
Classe créé par le générateur.
 */
class Services extends Table
{
	public function __construct()
	{
		parent::__construct("services", "ser_id");
	}

	static public function Res(int $idRes): array
	{
		$sql = 'SELECT com_quantite, ser_nom
		FROM commander, services
        WHERE ser_id = com_services
		AND com_reservation = :reservation';

		$stmt = Services::$link->prepare($sql);
		$stmt->bindValue(':reservation', $idRes);
		return $stmt->fetchAll();
	}
}
