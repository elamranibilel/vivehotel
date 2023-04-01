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

	public function doublons(array $data)
	{

		// Récupère l'ensemble des id doublons de notre réservation
		// Cherche toutes les réservations qui se superpose à la réservation en édition
		// dans le même hôtel, même chambre et stricteemnt différente de notre réservation
		$sql = "SELECT 	res_id
		FROM reservation
		WHERE ((:res_date_debut >= res_date_debut OR :res_date_fin >= res_date_debut)
		AND (:res_date_debut <= res_date_fin OR :res_date_fin <= res_date_fin) )
		AND res_hotel = :res_hotel
		AND res_chambre = :res_chambre
		AND res_id != :res_id";

		$stmt = Table::$link->prepare($sql);
		$stmt->bindValue(':res_id', $data['res_id'], PDO::PARAM_INT);

		$stmt->bindValue(':res_chambre', $data['res_chambre'], PDO::PARAM_STR);
		$stmt->bindValue(':res_hotel', $data['res_hotel'], PDO::PARAM_INT);

		$stmt->bindValue(':res_date_debut', $data['res_date_debut'], PDO::PARAM_STR);
		$stmt->bindValue(':res_date_fin', $data['res_date_fin'], PDO::PARAM_STR);

		$stmt->execute();
		return $stmt->fetchAll();
	}
}
