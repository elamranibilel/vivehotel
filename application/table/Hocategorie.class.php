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

	public function selectDistinctCat()
	{
		$sql = "SELECT DISTINCT hoc_categorie FROM hocategorie";
		$result = self::$link->query($sql);
		$data = $result->fetchAll();

		$hoCategorie = array_map(function ($elem) {
			return $elem['hoc_categorie'];
		}, $data);
		return $hoCategorie;
	}
}
