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
}
