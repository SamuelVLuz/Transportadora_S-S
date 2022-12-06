<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Serviços</title>
</head>
<body>
	<?php
		/*require_once("cabecalho.php");*/
	?>
	<div>
	<?php
		/*require_once("protege.php");*/
		require_once("conectar.php");

		//	funcionário, peso, quantidade, data, preco, cliente	
		$sql = "SELECT usuario.nome AS funcionario, servico.peso, servico.quantidade, servico.data, servico.preco, cliente.nome AS cliente FROM usuario INNER JOIN realiza ON usuario.id = realiza.usuario_id INNER JOIN servico ON realiza.servico_id = servico.id INNER JOIN cliente ON servico.cliente_id = cliente.id ORDER BY data";
		
		// coleta
		$sql1 = "SELECT cliente.nome AS coleta FROM servico INNER JOIN cliente ON servico.id_coleta = cliente.id ORDER BY data";

		$registros = mysqli_query($conn, $sql);
		$registros1 = mysqli_query($conn, $sql1);

		if (mysqli_num_rows($registros) > 0 && mysqli_num_rows($registros1) > 0){
			/*echo ("<a href='inserir_contato.php' class='btn btn_primary'>Inserir contato</a><br><br>");*/

			echo ("<div>");

			// abrindo a tabela
			echo ("<table><tr><th>Cliente</th><th>Coleta</th><th>Data</th><th>Peso</th><th>Quantidade</th><th>Preço</th><th>Funcionário</th><th>Opções</th></tr>");
			
			while ($registro = mysqli_fetch_array($registros)){
				$registro1 = mysqli_fetch_array($registros1);
				echo ("<tr><td>$registro[cliente]</td><td>$registro1[coleta]</td><td>$registro[data]</td><td>$registro[peso]</td><td>$registro[quantidade]</td><td>$registro[preco]</td><td>$registro[funcionario]</td></tr>");
			}

			echo ("</table>");
			echo ("</div>");
		

			mysqli_close($conn); // fechando a conexao com o BD

		} else {
			echo ("Houve um erro ao conectar com o banco de dados");
		}


	?>
	</div>
	<script src="js/mobile-navbar.js"></script>
</body>
</html>