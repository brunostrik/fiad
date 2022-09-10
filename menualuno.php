<?php
	require_once "common.php"; //HELPER	
    require_once "model/Aluno.php";
    require_once "model/Professor.php";
	include "head.php";
    $aluno = Aluno::Load($_SESSION["matricula"]);
    $professores = Professor::SelectAll();
?>

<body>
<?php
    include "navaluno.php";
?>
    <div class="container">
        <div class="alert alert-info">
            <p>Utilize o menu acima para acessar as opções do sistema.</p>
        </div>     
    </div>
  </body>
<?php
    include "foot.php";
?>