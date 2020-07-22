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

	public function getNameOfCar($id_carro) {
	    $sql = $this->pdo->prepare("SELECT * FROM carros WHERE id = :id_carro");
	    $sql->bindValue(":id_carro", $id_carro);
	    $sql->execute();

	    $array = array();

	    if($sql->rowCount() > 0) {
	        $array = $sql->fetch();
	        return $array;
        } else {
	        return false;
        }
    }

}
?>