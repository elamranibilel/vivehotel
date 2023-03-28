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
		/* 
		* Nous cherchons l'ensemble des services d'une réservation
		*/
		$sql = 'SELECT com_services, com_quantite, ser_nom, pro_prix
		FROM commander, services, reservation, proposer
		WHERE  com_services = ser_id
		AND com_reservation = :reservation
		AND com_reservation = res_id
		AND res_hotel = pro_hotel
		AND pro_services = ser_id';

		$stmt = Table::$link->prepare($sql);
		$stmt->bindValue(':reservation', $idRes, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	static public function pasRes(int $idRes)
	{
		$sql = 'SELECT ser_id, ser_nom FROM services
		WHERE ser_id NOT IN(SELECT com_services 
		FROM commander, services, reservation, proposer
		WHERE com_services = ser_id
		AND com_reservation = :reservation
		AND com_reservation = res_id
		AND res_hotel = pro_hotel
		AND pro_services = ser_id)';

		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':reservation', $idRes, PDO::PARAM_INT);
		$stmt->execute();
		$resultat = $stmt->fetchAll();

		$s = "";
		foreach ($resultat as $tab) {
			$s = $s . "<option value='{$tab['ser_id']}'>{$tab['ser_nom']}</option>";
		}
		return $s;
	}
}
