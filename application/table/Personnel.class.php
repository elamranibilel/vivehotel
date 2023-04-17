<?php

/**
Classe créé par le générateur.
 */
class Personnel extends Table
{
	const ROLE = [
		'gestionnaire',
		'teleconseiller',
		'personnel'
	];
	public function __construct()
	{
		parent::__construct("personnel", "per_id");
	}




	static public function estEmailUnique(string $per_email): bool
	{
		$sql = "select * from personnel where per_email=:mail";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":mail", $per_email);
		$statement->execute();
		if ($statement->rowCount() > 0)
			return false;
		else
			return true;
	}

	static public function selectByEmail(string $per_email)
	{
		$sql = "SELECT per_nom, per_identifiant, 
		per_email, per_mdp, per_role
		FROM personnel
		WHERE per_email=:mail";
		// per_hotel=hot_id 
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":mail", $per_email);
		$statement->execute();
		return $statement->fetch();
	}

	static public function selectHotel(int $id)
	{
		$sql = "SELECT hot_id FROM hotel, personnel
		WHERE per_hotel = hot_id
		AND per_id = :id";

		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id);
		$statement->execute();
		$res = $statement->fetch();
		debug($res);
		exit();
		return is_array($res) ? $res['hot_id'] : NULL;
	}
}
