<?php
    include "cookier.php";
    include "head.php";
    require_once "common.php"; //HELPER

    require_once "model/DB.php"; 

    //Segurança - área limitada para professores
    include "onlyprofs.php";

    //Carrega os dados
    $sql = "SELECT destino, COUNT(destino) as qtd FROM aluno WHERE status = 1 GROUP BY destino";
    $items = DB::QueryAnonymous($sql); 
    usort($items, function ($a, $b) { //ordenação
        return $a->qtd < $b->qtd;
    });  


?>
<body>
<?php
    include "nav.php";
?>
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
        data.addColumn('string', 'Escola');
        data.addColumn('number', 'Quantidade');
        data.addRows([
          <?php
            foreach($items as $item){
                echo("['$item->destino', $item->qtd],");
            }
          ?>
        ]);

        // Set chart options
        var options = {'title':'Destino do Formando',
                       'width':900,
                       'height':600};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>



<main role="main" class="container" style="text-align:center;">
    <div class="card">
        <h4 class="card-header">Relatório de Egressos - Geral</h4>
        <div class="card-body">
            <!--Div that will hold the pie chart-->
            <div id="chart_div"></div>         
        </div>
    </div>
    


</main> 
</body>
<?php
    include "foot.php";
?>