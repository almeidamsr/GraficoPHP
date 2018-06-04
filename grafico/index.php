<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> </title>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" type="text/css" href="_css/meuestilo.css">
	
</head>
<body>

<div id="header">
<h1>TECNOLOGIA DA PROGRAMAÇÃO V</h1>
</div>

<div id="nav">
<a href="index.php">Inicio</a><br>
<a href="index.php?id=pedido">Pedidos</a><br>
</div>

<?php
	@$id = $_GET["id"];
	$pages["pedido"]="./_pages/pedido.php";
	$pages["grafico"]="./_pages/grafico.php";
?>

<div id="section">

<?php
	if(is_null($id)){
		@include $pages["pedido"]="./_pages/pedido.php";
	}
	@include $pages[$id];
?>

</div>

<div id="footer">

</div>

</body>
</html>