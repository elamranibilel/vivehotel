<?php

/**
Classe créé par le générateur.
 */
class Utilisateur extends Table
{
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
		$sql = "SELECT * FROM personnel WHERE per_email=:mail";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":mail", $per_email);
		$statement->execute();
		return $statement->fetch();
	}
}
