<?php
try {
	$pdo = new PDO("mysql:dbname=projeto_reservas;host=localhost:3306", "mateus", "");
} catch(PDOException $e) {
	echo "Erro: ".$e->getMessage();
	die;
}
?>