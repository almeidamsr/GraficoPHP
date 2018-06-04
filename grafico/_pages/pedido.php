<h1> Pedidos </h1><hr>

<form action="index.php?id=pedido" method="post">
	<span id="tituloDtMes">Mes</span>
	<div id="divDtMes" style="margin:10px;">  
		<input id="inputDtMes" name="inputDtMes" type="text"></input> 
	</div>
	<span id="tituloDtMes">Ano</span>
	<div id="divDtAno" style="margin:10px;"> 
		<input id="inputDtAno" name="inputDtAno" type="text" value="2017" ></input>
	</div>
	<input type="submit" value="Mostrar">
</form>
<hr>

<?php
	require('conexao.php');
	
	// verificando se os inputs estão vazios
	if(($_POST["inputDtAno"]!="") and ($_POST["inputDtMes"]!="")){
		@$dataMes = $_POST["inputDtMes"];
		@$dataAno = $_POST["inputDtAno"];
	}	
	
		$totalVendas = 0;
		$totalPorProduto = 0;
		$codigoProd = 0;
	
		//pega varios valores no mes e ano digitado
		$sql = "SELECT codVenda,codPedido,codProduto,nomeProduto,quantidadeProduto,valor,dataVenda,
				Month(dataVenda) as mes, Year(dataVenda) as ano
				FROM pedido
				where Month(dataVenda) = $dataMes and Year(dataVenda) = $dataAno;";
		$result = $conn->query($sql);
	
		//somente para trazer o total na tela
		$sql2 = "select sum(quantidadeProduto) as produtosVendidos
				 FROM pedido where Month(dataVenda) = $dataMes and Year(dataVenda) = $dataAno;";
		
		$resultCountVendas = $conn->query($sql2);		

		if ($result->num_rows > 0) {
		// for each pra imprimir a tabela
			echo "<table class='table' border='1'>".
				 "<thead>".
				 "<tr>".
				 "<td>Nome</td>".
				 "<td>Quantidade vendida por pedido</td>".
				 "<td>Mes</td>".
				 "<td>Ano</td>".
				 "<td>Grafico do Produto</td>".
				 "</tr>".
				 "</thead>";
			echo "<tbody>";
				//somente para trazer o total na tela
				while($total = $resultCountVendas->fetch_assoc()) { 
					$totalVendas = $total["produtosVendidos"];
					echo "Total de Produtos Vendido no Periodo Informado: ".$total["produtosVendidos"];
				}
				//imprime os dados do banco na tabela
				while($row = $result->fetch_assoc()) {
					//guarda o codigo para ser usado na query do grafico
					$codigoProd = $row["codProduto"];
					echo "<tr>".
						 "<td>". $row["nomeProduto"]. "</td>".
						 "<td>". $row["quantidadeProduto"]. "</td>".
						 "<td>". $row["mes"]. "</td>".
						 "<td>". $row["ano"]. "</td>".
						 "<td>". "<a href='index.php?id=grafico&valor1=$totalVendas&codigo=$codigoProd&mes=$dataMes&ano=$dataAno'>".$row["nomeProduto"]."</a>". "</td>".
						 "</tr>";
				}
				echo "</tbody></table>";
		} else {
			// echo "0 resultados";
		}
		
		$conn->close();
?>
