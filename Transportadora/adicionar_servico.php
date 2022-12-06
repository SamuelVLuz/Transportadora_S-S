<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Adicionar Serviço</title>
</head>

<body>
	<form method="POST">
		<fieldset>
			<legend>Novo serviço</legend>
			<div>
				<label>Cliente</label>
			 	<select name="cliente" id="cliente">
					<?php
						// abre a conexao com o banco de dados
						require_once("conectar.php");

						if ($conn) {
							$sql = "SELECT cliente.nome AS cliente, cliente.id FROM cliente";

							$registros = mysqli_query($conn, $sql);

							if (mysqli_num_rows($registros) > 0){

								while ($registro = mysqli_fetch_array($registros) ){
									echo("<option value='$registro[id]'>$registro[cliente]</option>");
								}
							}							
						}
					?>
				</select>
			</div>
			<div>
				<label>Coleta</label>
			 	<select name="coleta" id="coleta">
					<?php
					
						if ($conn) {
							$sql = "SELECT cliente.nome AS coleta, cliente.id FROM cliente";

							$registros = mysqli_query($conn, $sql);

							if (mysqli_num_rows($registros) > 0){

								while ($registro = mysqli_fetch_array($registros) ){
									echo("<option value='$registro[id]'>$registro[coleta]</option>");
								}
							}							
						}
					?>
				</select>
			</div>
			<div>
				<label>Data</label>
				<input type="date" name="data"> 
			</div>
			<div>
				<label>Peso</label>
				<input type="number" name="peso"> 
			</div>
			<div>
				<label>Quantidade</label>
				<input type="number" name="quantidade"> 
			</div>
			<div>
				<label>Preço</label>
				<input type="number" step=".01" name="preco"> 
			</div>
			<div>
				<label>Funcionário</label>
			 	<select name="funcionario" id="funcionario">
					<?php
						if ($conn) {
							$sql = "SELECT usuario.nome AS funcionario, usuario.id FROM usuario WHERE permissao != 1";

							$registros = mysqli_query($conn, $sql);

							if (mysqli_num_rows($registros) > 0){

								while ($registro = mysqli_fetch_array($registros) ){
									echo("<option value='$registro[id]'>$registro[funcionario]</option>");
								}
							}							
						}
					?>
				</select>
			</div>
			
			<input type="submit" name="enviar" value="Enviar">
		</fieldset>
	</form>

	<?php
	// isset testa se uma variavel existe
	if (isset($_POST['enviar']) == true) {
		// codigo a ser executado se a variavel estiver definida
		
		if (empty($_POST["data"])){
			echo("Preencha a <b>data</b>");
		} else if (empty($_POST["peso"])) {
			echo("Preencha o <b>peso</b>");
		} else if(empty($_POST["quantidade"])){
			echo("Preencha a <b>quantidade</b>");
		} else if(empty($_POST["preco"])){
			echo("Preencha o <b>preço</b>");
		} else {
			// testa se a conexao com o banco de dados foi bem sucedida
			if ($conn) {
				$cliente = $_POST["cliente"];
				$coleta = $_POST["coleta"];
				$data = $_POST["data"];
				$peso = $_POST["peso"];
				$quantidade = $_POST["quantidade"];
				$preco = $_POST["preco"];				
				$funcionario = $_POST["funcionario"];
				
				// Conseguindo o novo id de servico
				$id = "SELECT Max(id)+1 AS id FROM `servico`";
				$id = mysqli_query($conn, $id);
				$id = mysqli_fetch_array($id);

				// Consultas para inserir no banco de dados
				$sql = "INSERT INTO servico (peso, quantidade, data, preco, id_coleta, cliente_id) VALUES ('$peso', '$quantidade', '$data', '$preco', $coleta, $cliente)";
				$sql1 = "INSERT INTO realiza (usuario_id, servico_id) VALUES ('$funcionario', '$id[id]')";
					
				// mandando executar a consulta sql
				// a funcao mysqli_query retorna true se a consulta foi executada com sucesso
				if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)){
					echo ("Servico adicionado com sucesso!<br>");
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