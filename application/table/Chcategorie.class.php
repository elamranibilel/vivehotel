<?php

/**
Classe créé par le générateur.
 */
class Chcategorie extends Table
{
	public function __construct()
	{
		parent::__construct("chcategorie", "chc_id");
	}

	public function selectAll(): array
	{
		$sql = 'SELECT chc_categorie from chcategorie';
		$resultats = self::$link->query($sql);
		$chcCats = [];

		while ($nomCat = $resultats->fetchColumn()) {
			$chcCats[] = $nomCat;
		}

		return $chcCats;
	}

	static public function OPTIONchcategories($id)
	{
		return self::HTMLoptions('SELECT chc_id, chc_categorie FROM chcategorie', 'chc_id', 'chc_categorie', $id);
	}

	public function countCat()
	{
		$sql = "SELECT COUNT(DISTINCT chc_categorie) `nb_chc` FROM chcategorie";
		$result = self::$link->query($sql);
		return $result->fetch()['nb_chc'];
	}
}
