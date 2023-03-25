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
}
