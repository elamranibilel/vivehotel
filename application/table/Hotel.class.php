<?php
/**
Classe créé par le générateur.
*/
class Hotel extends Table {
	public function __construct() {
		parent::__construct("hotel", "hot_id");
	}
	
// creation d'une table hotel categore
public function selectAllcategorie(): array
{
	$sql="select * from hotel, hocategorie where hot_id=hoc_categorie order by hoc_categorie;";
	        $result=self::$link->query($sql);
        return $result->fetchAll();
}
}
?>
