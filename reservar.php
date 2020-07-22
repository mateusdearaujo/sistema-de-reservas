<?php
include "config.php";
require "classes/carros.class.php";
require "classes/reservas.class.php";

$reservas = new Reservas($pdo);
$carros = new Carros($pdo);

$lista = $carros->getCarros();

if(!empty($_POST['carro'])) {
	$carro = addslashes($_POST['carro']);
	$data_inicio = explode('/', addslashes($_POST['data_inicio']));
	$data_fim = explode('/', addslashes($_POST['data_fim']));
	$pessoa = addslashes($_POST['pessoa']);

	// Convertendo a data para o padrão internacional
	$data_inicio = $data_inicio[2]."-".$data_inicio[1]."-".$data_inicio[0];
	$data_fim = $data_fim[2]."-".$data_fim[1]."-".$data_fim[0];

	if($reservas->verificarDisponibilidade($carro, $data_inicio, $data_fim)) {
		$reservas->reservar($carro, $data_inicio, $data_fim, $pessoa);
		header("Location: index.php");
		exit;
	} else {
		echo "Este carro já está reservado neste período.";
	}
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reserva de Carros</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<main>
<div class="container">
	<div id="top">
		<h1>Adicionar Reserva</h1>
		<a class="btn btn-primary" href="index.php">Início</a>
	</div>
	<form method="POST">
		<div class="form-group">
			Carro:<br/>
			<select name="carro" class="form-control" required>
				<option value=""></option>
				<?php foreach($lista as $carro): ?>
					<option value="<?php echo $carro['id']; ?>"><?php echo $carro['nome']; ?></option>
				<?php endforeach; ?>
			</select>

			Data de Início: <br/>
			<input type="text" name="data_inicio" class="form-control" required>

			Data de fim? <br/>
			<input type="text" name="data_fim" class="form-control" required>

			Nome da pessoa: <br/>
			<input type="text" name="pessoa" class="form-control" required>

			<br/>
			<button type="submit" class="btn btn-primary mb-2">Reservar</button>
		</div>
	</form>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>