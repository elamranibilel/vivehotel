<?php

/**
Classe créé par le générateur.
 */
class Reservation extends Table
{
	public function __construct()
	{
		parent::__construct("reservation", "res_id");
	}

	public function selectAll(): array // supprimer
	{
		$sql = "select * from reservation LIMIT 0,100";
		$result = self::$link->query($sql);
		return $result->fetchAll();
	}

	public function reservationsCha(int $idChambre): array
	{
		$sql = "SELECT 
		res_id,
		res_date_creation,
		res_date_debut,
		res_date_maj,
		res_date_fin,
		res_etat,
		cli_nom,
		hot_nom
		FROM hotel, reservation, chambre, client 
		WHERE res_hotel = hot_id
		AND res_chambre = :chambre
		AND res_client = cli_id
		LIMIT 0,100
		"; // ordonner par date de création de la réservation
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':chambre', $idChambre, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}
