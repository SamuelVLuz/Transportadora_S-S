<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Adicionar Cliente</title>
</head>

<body>
	<form method="POST">
		<fieldset>
			<legend>Novo cliente</legend>
			<div>
				<label>Nome</label>
				<input type="text" name="nome"> 
			</div>
			<div>
				<label>Cidade</label>
				<input type="text" name="cidade"> 
			</div>
			<div>
				<label>Email</label>
				<input type="email" name="email"> 
			</div>
			<div>
				<label>Telefone</label>
				<input type="text" name="telefone"> 
			</div>
			<input type="submit" name="enviar" value="Enviar">
		</fieldset>
	</form>

	<?php
	// Abrindo a conexão com o banco de dados
	require_once("conectar.php");
	
	// isset testa se uma variavel existe
	if (isset($_POST['enviar']) == true) {
		// codigo a ser executado se a variavel estiver definida
		
		if (empty($_POST["nome"])){
			echo("Preencha o <b>nome</b>");
		} else if (empty($_POST["cidade"])) {
			echo("Preencha a <b>cidade</b>");
		} else if(empty($_POST["email"])){
			echo("Preencha o <b>email</b>");
		} else if(empty($_POST["telefone"])){
			echo("Preencha o <b>telefone</b>");
		} else {
			// testa se a conexao com o banco de dados foi bem sucedida
			if ($conn) {
				$nome = $_POST["nome"];
				$cidade = $_POST["cidade"];
				$email = $_POST["email"];
				$telefone = $_POST["telefone"];

				// Consulta para inserir no banco de dados
				$sql = "INSERT INTO cliente (nome, cidade, email, telefone) VALUES ('$nome', '$cidade', '$email', '$telefone')";
	
				// mandando executar a consulta sql
				// a funcao mysqli_query retorna true se a consulta foi executada com sucesso
				if (mysqli_query($conn, $sql)){
					echo ("Cliente adicionado com sucesso!<br>");
				} else {
					// erro ao executar a consulta
					echo ("Erro: $sql <br>" . mysqli_error($conn) );
				}

				// encerrando a conexao
				mysqli_close($conn);
			} else {
				// informando qual o erro que houve na hora da conexao
				echo ("Falha na conexão " . mysqli_connect_error() );
			}
		}
	}
	?>
</body>
</html>