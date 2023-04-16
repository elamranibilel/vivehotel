<?php

/**
Classe créé par le générateur.
 */

class Hotel extends Table
{
	const STATUT = [
		"En attente",
		"Initialisé",
		"Annnulé",
		"Validé",
		"Supprimé"
	];
	public function __construct()
	{
		parent::__construct("hotel", "hot_id");
	}


	//retourne un enregistrement vide
	function emptyRecord(): array
	{
		$fields = $this->getFields();
		$row = [];
		foreach ($fields as $name)
			$row[$name] = "";
		$row[$this->pk] = 0;
		return $row;
	}

	public function select(int $id): array
	{
		$sql = "SELECT * FROM hotel, hocategorie 
		WHERE hot_hocategorie = hoc_id
		AND hot_id = :id";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	// creation d'une table de catégorie d'hotel
	public function selectAll(): array
	{
		$sql = "SELECT * FROM hotel, hocategorie 
		WHERE hot_hocategorie = hoc_id
		ORDER BY hot_id";
		$result = self::$link->query($sql);
		return $result->fetchAll();
	}

	public function countAll(): int
	{
		$listeHotel = $this->selectAll();
		return count($listeHotel);
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

	public function chiffreAffTot()
	{
		$sql = 'SELECT SUM(tar_prix* res_duree) `c_affaire` FROM
		(SELECT hot_id, tar_prix, DATEDIFF(res_date_fin, res_date_debut) `res_duree`
		FROM chambre, reservation, tarifer, hotel
		WHERE res_chambre = cha_id
		AND res_hotel = hot_id 
		AND tar_chcategorie = cha_chcategorie 
		AND tar_hocategorie = hot_hocategorie
		AND res_etat != "Annulé"
		)  reservations';
		$stmt = self::$link->query($sql);
		return $stmt->fetch()['c_affaire'];
	}

	public function chiffreAffaire(int $id): array
	{
		$sql = 'SELECT hot_id, SUM(tar_prix* res_duree) `c_affaire` FROM
		(SELECT hot_id, tar_prix, DATEDIFF(res_date_fin, res_date_debut) `res_duree`
		FROM chambre, reservation, tarifer, hotel
		WHERE res_chambre = cha_id
		AND res_hotel = hot_id 
		AND tar_chcategorie = cha_chcategorie 
		AND tar_hocategorie = hot_hocategorie
		AND hot_id = :id) reservations
		GROUP BY hot_id';
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function CAservices(int $hot_id): array
	{
		$sql = 'SELECT pro_hotel, SUM(pro_prix*com_quantite) `ca_service`
		FROM commander, services, proposer
		WHERE com_services = ser_id 
		AND ser_id = pro_services
		AND pro_hotel = :id
		GROUP BY pro_hotel
		ORDER BY ca_service DESC';
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $hot_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function ChambreActifs(int $id): array
	{
		$sql = "SELECT hot_id, hot_nom, COUNT(DISTINCT(cha_id)) `nb_chambres`
		FROM hotel, reservation, chambre
		WHERE res_hotel = hot_id
		AND res_chambre = cha_id
		AND cha_statut = 'Validé'
		AND hot_id = :id
		GROUP BY hot_id
		ORDER BY nb_chambres";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function ChambreLibres(int $id): array
	{
		$sql = "SELECT hot_id, hot_nom, COUNT(DISTINCT(cha_id)) 'nb_chambreLibres', res_hotel
		FROM hotel, reservation, chambre
		WHERE res_hotel = hot_id
		AND res_chambre = cha_id
		AND res_etat = 'En attente'
		AND hot_id = :id
		GROUP BY hot_id
		ORDER BY nb_chambreLibres";
		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	static public function OPTIONhotel(string $selected)
	{
		return Table::HTMLoptions('SELECT * FROM hotel', 'hot_id', 'hot_nom', $selected);
	}

	public function delete($id)
	{
		$sql = 'UPDATE hotel 
		SET hot_statut = "Annulé" 
		WHERE hot_id=:id';
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
	}
}
