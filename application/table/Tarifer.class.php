<?php

/**
Classe créé par le générateur.
 */
class Tarifer extends Table
{
	public function __construct()
	{
		parent::__construct("tarifer", "tar_id");
	}

	public function selectAll(): array
	{
		$sql = "SELECT tar_prix, (tar_hocategorie-1) `tar_hocategorie`,
		(tar_chcategorie-1) `tar_chcategorie`
		FROM tarifer";
		$result = self::$link->query($sql);
		return $result->fetchAll();
	}
}
