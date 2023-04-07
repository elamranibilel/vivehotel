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

	static public function OPTIONchcategories($id)
	{
		return self::HTMLoptions('SELECT chc_id, chc_categorie FROM chcategorie', 'chc_id', 'chc_categorie', $id);
	}

	public function selectDistinctCat()
	{
		$sql = "SELECT DISTINCT chc_categorie FROM chcategorie";
		$result = self::$link->query($sql);
		$data = $result->fetchAll();

		return array_map(function ($elem) {
			return $elem['chc_categorie'];
		}, $data);
	}
}
