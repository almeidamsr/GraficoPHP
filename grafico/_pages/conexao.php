<?php
$servername = "localhost";
$username = "root";
$password = "matheus";
$dbname = "banco_7per_php";

	// Criando conex�o
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Testando conex�o
	if ($conn->connect_error) {
		die("Falha na conex�o: " . $conn->connect_error);
	} 

?>