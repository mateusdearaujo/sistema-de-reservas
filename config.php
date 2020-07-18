<?php
try {
	$pdo = new PDO("mysql:dbname=projeto_reservas;host=localhost", "mateus", "");
} catch(PDOException $e) {
	echo "Erro: ".$e->getMessage();
}
?>