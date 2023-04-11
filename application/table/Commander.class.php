<?php
/**
Classe créé par le générateur.
*/
class Commander extends Table {
	public function __construct() {
		parent::__construct("commander", "com_id");
	}

	static public function selectResServices($reservation, $services): array
	{
		$sql = "SELECT res_nom, ser_nom 
		FROM commander, services, reservation
		WHERE com_services = :services
		AND com_services = ser_id
		AND com_reservation = res_id
		AND com_reservation = :reservation";

		$stmt = self::$link->prepare($sql);
		$stmt->bindValue(":reservation", $reservation, PDO::PARAM_INT);
		$stmt->bindValue(":services", $services, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(); 
	}

	function selecte(int $id)
	{
		$sql = "SELECT 
		* FROM commander, reservation, services 
		WHERE com_id = :id
		AND res_id = com_reservation
		AND ser_id = com_services";
		$statement = self::$link->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch();
	}
}
?>
