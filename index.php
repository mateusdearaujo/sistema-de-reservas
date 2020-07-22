<?php
require "config.php";
require "classes/carros.class.php";
require "classes/reservas.class.php";

$reservas = new Reservas($pdo);
$carros = new Carros($pdo);
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
        <form method="GET">
            <label>
                <select name="ano">
                    <?php for($q=date('Y');$q>2000;$q--) :?>
                        <option><?php echo $q; ?></option>
                    <?php endfor; ?>
                </select>
            </label>
            <label>
                <select name="mes">
                    <option>01</option>
                    <option>02</option>
                    <option>03</option>
                    <option>04</option>
                    <option>05</option>
                    <option>06</option>
                    <option>07</option>
                    <option>08</option>
                    <option>09</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                </select>
            </label>
            <button type="submit" class="btn btn-primary mb-2">Mostrar</button>
        </form>
        <?php
            if(empty($_GET['ano'])) {
                exit;
            }

        $data = $_GET['ano'].'-'.$_GET['mes'];
        $dia1 = date("w", strtotime($data."-01"));
        $dias = date("t", strtotime($data));
        $linhas = ceil(($dia1 + $dias) / 7);
        $dia1 = -$dia1;
        $data_inicio = date("Y-m-d", strtotime($dia1." days", strtotime($data)));
        $data_fim = date("Y-m-d", strtotime(( ($dia1 + ($linhas * 7) - 1) )." days", strtotime($data)));

        $lista = $reservas->getReservas($data_inicio, $data_fim);

        ?>
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
                $id_carro = $item['id_carro'];
			    $nome_carro = $carros->getNameOfCar($id_carro);

				$data1 = date('d/m/Y', strtotime($item['data_inicio'])); 
				$data2 = date('d/m/Y', strtotime($item['data_fim'])) ?>
				<tr>
					<td><?php echo $nome_carro['nome']; ?></td>
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