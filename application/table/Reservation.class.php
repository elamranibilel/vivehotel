<?php

/**
Classe créé par le générateur.
 */
class Reservation extends Table
{
	const RES_ETAT = [
		'Annnulé',
		'Initialisé',
		'Validé',
		'En attente'
	];

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

	public function reservationsClient($cli_id): array
	{
		$sql = "select 
		* from reservation, client, hotel, chambre
		where res_hotel = hot_id
		and res_client = :client
		and res_client = cli_id
		LIMIT 0,100";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':client', $cli_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function valid(array $res)
	{
		// Vérifie si la réservation n'a pas de doublon
		$sql = 'SELECT res_id, res_date_debut, res_date_fin
		FROM reservation
		WHERE res_date_debut >= :res_debut 
		AND res_date_fin <= :res_fin
		AND res_hotel = :res_hotel 
		AND res_chambre = :res_chambre
		';

		$stmt = Table::$link->prepare($sql);

		$stmt->bindValue(':res_hotel', $res['res_hotel'],  PDO::PARAM_INT);
		$stmt->bindValue(':res_debut', $res['res_date_debut'],  PDO::PARAM_STR);
		$stmt->bindValue(':res_fin', $res['res_date_fin'], PDO::PARAM_STR);
		$stmt->bindValue(':res_chambre', $res['res_chambre'],  PDO::PARAM_INT);

		return $stmt->fetchAll();
	}
}
