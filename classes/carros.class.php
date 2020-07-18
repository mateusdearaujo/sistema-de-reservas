<?php
class Carros {

	private $pdo;

	public function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function getCarros() {
		$array = array();

		$sql = $this->pdo->query("SELECT * FROM carros");
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

}
?>