<?php
class Reservas {

	private $pdo;

	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function getReservas() {
		$array = array();

		$sql = $this->pdo->query("SELECT * FROM reservas");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

}
?>