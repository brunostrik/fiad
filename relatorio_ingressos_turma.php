<?php
    include "cookier.php";
    include "head.php";
    require_once "common.php"; //HELPER

    require_once "model/DB.php"; 

    //Segurança - área limitada para professores
    include "onlyprofs.php";

    //Carrega os dados
    //LISTA DE ESCOLAS, horizontal
    $sql = "SELECT origem AS nome FROM aluno GROUP BY origem ORDER BY origem ASC";
    $escolas = DB::QueryAnonymous($sql); 
    //LISTA DE TURMAS, vertical
    $sql = "SELECT ano, turma AS nome FROM turma ORDER BY ano ASC";
    $turmas = DB::QueryAnonymous($sql); 
    //PARA CADA TURMA BUSCA OS NUMEROS DE CADA ESCOLA
    $valores = array();
    foreach($turmas as $turma){
        $linha = array($turma->ano);
        foreach($escolas as $escola){
            $sql = "SELECT COUNT(matricula) AS total FROM aluno WHERE turma = '$turma->nome' AND origem = '$escola->nome';";
            $item = DB::QueryOneAnonymous($sql); 
            array_push($linha, $item->total);
        }
        array_push($valores, $linha);
    }    
?>
<body>
<?php
    include "nav.php";
?>
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    google.charts.load('current', {'packages':['line']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number','Ano');
      <?php
        foreach($escolas as $escola){
            echo("data.addColumn('number', '$escola->nome');\r\n");
        }
      ?>

      data.addRows([
        <?php
        for($i = 0; $i < count($valores); $i++) {
            echo("[");
            echo(implode(",", $valores[$i]));
            echo("],");
        }
        ?>
      ]);

      var options = {
        chart: {
          title: 'Escola de origem dos alunos',
        },
        width: 900,
        height: 500
      };

      var chart = new google.charts.Line(document.getElementById('chart_div'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
    </script>



<main role="main" class="container" style="text-align:center;">
    <div class="card">
        <h4 class="card-header">Relatório de Ingressos - Por Turma/Ano</h4>
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