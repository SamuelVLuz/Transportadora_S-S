<?php
	$conn = mysqli_connect("localhost", "root", "", "transportadora");

	if ($conn == false){
		die("Houve um erro ao conectar com o banco de dados");
	}
?>