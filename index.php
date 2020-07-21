<?php
require "config.php";
require "classes/carros.class.php";
require "classes/reservas.class.php";

$reservas = new Reservas($pdo);
$lista = $reservas->getReservas();
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
		<h1>Reservas</h1>
		<a class="btn btn-primary" href="reservar.php">Adicionar Reserva</a>
	</div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Veículo</th>
				<th>Início da Locação</th>
				<th>Fim da Locação</th>
				<th>Locador</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($lista as $item): 
				$data1 = date('d/m/Y', strtotime($item['data_inicio'])); 
				$data2 = date('d/m/Y', strtotime($item['data_fim'])) ?>
				<tr>
					<td><?php echo $item['id_carro']; ?></td>
					<td><?php echo $data1; ?></td>
					<td><?php echo $data2; ?></td>
					<td><?php echo utf8_encode($item['pessoa']); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<hr/>
<?php require "calendario.php"; ?>
</div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>