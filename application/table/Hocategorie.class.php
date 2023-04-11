<?php

/**
Classe créé par le générateur.
 */
class Hocategorie extends Table
{
	public function __construct()
	{
		parent::__construct("hocategorie", "hoc_id");
	}

	public function selectAll(): array
	{
		$sql = 'SELECT hoc_categorie from hocategorie';
		$resultats = self::$link->query($sql);
		$hocCats = [];

		while ($nomCat = $resultats->fetchColumn()) {
			$hocCats[] = $nomCat;
		}

		return $hocCats;
	}


	public function countCat()
	{
		$sql = "SELECT COUNT(DISTINCT hoc_categorie) `nb_hoc` FROM hocategorie";
		$result = self::$link->query($sql);
		return $result->fetch()['nb_hoc'];
	}
}
