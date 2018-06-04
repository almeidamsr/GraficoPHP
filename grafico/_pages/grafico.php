<html>

<?php
 require('conexao.php');

$conn = new mysqli($servername, $username, $password, $dbname);

	//pega a quantidade de Produto vendido no mes e ano exceto o que foi escolhido
	$sql4 = "select sum(quantidadeProduto) as produtosVendidos
			FROM pedido 
			where Month(dataVenda) = ".$_GET['mes']." and Year(dataVenda) = ".$_GET['ano']." and codProduto!= ".$_GET['codigo']." ";
		
			$resultCountVendas = $conn->query($sql4);
			
				while($total = $resultCountVendas->fetch_assoc()) { 
					$totalVendas = $total["produtosVendidos"];
					if($totalVendas == NULL){
						$totalVendas = 0;
					}
				}

	//pega a quantidade de Produto vendido no mes e ano do produto selecionado
	$sql3 = "select nomeProduto, sum(quantidadeProduto) as produtosVendidosPorCod
			FROM pedido 
			where Month(dataVenda) = ".$_GET['mes']." and Year(dataVenda) = ".$_GET['ano']." and codProduto= ".$_GET['codigo']." ";
							
			$resultCountProduto = $conn->query($sql3);
			
			while($totalProd = $resultCountProduto->fetch_assoc()) { 
				$totalPorProduto = $totalProd["produtosVendidosPorCod"];
				$nomeProduto = $totalProd["nomeProduto"];
			}
?>


  <head>
	<style>
	div#chart_div{
		position: relative;
		left:0%;
	}
	div#tabela{
		position: relative;
		left:0px;
	}
	</style>
	
	
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Outros produtos vendidos no período informado',<?=$totalVendas?>],
          ['Produto Selecionado',<?=$totalPorProduto?>]
        ]);

        // Set chart options
        var options = {'title':'percentual que este produto teve de vendas no período informado',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
	<div id="tabela">
	<?php
		@include $pages["pedido"]="./_pages/pedido.php";
	?>
	</div>
	<h1> Grafico do produto <?=$nomeProduto?> no mês <?=$_GET["mes"]?> de <?=$_GET["ano"]?></h1>
    <div id="chart_div"></div>
  </body>
</html>