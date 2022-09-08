<?php
    include "cookier.php";
    include "head.php";

    require_once "model/DB.php";
    require_once "model/Aluno.php";

    require_once "common.php"; //HELPER

    //Segurança - área limitada para professores ou alunos
    include "cookier.php";

    //Carregar os dados do aluno a partir da matricula que vem como parametro
    $matricula = $_REQUEST["mat"];
    $aluno = Aluno::Load($matricula);

?>
<body>
<?php
    include "navaluno.php";    
?>

<main role="main" class="container">
    <div class="card">
        <div class="row no-gutters">          
            <div class="col-md-4">
            <img src="fotos/<?=$matricula?>.jpeg" class="card-img" alt="foto" style="height: 100%;">
            </div>
            <div class="col-md-8">
                <div class="card-body">       
                    <img src="img/logo.png" class="mx-auto d-block img-fluid mt-3" alt="logo" width="450">                
                    <div class="card-text mt-3">
                        <h4 class="card-title text-center">Identificação do Estudante</h4>
                        <p class="text-center">Nome<br><strong><?=$aluno->nome?></strong></p>
                        <p class="text-center">Matrícula<br><strong><?=$aluno->matricula?></strong></p>
                        <p class="text-center">Curso e turma<br><strong><?=$aluno->turma?></strong></p>
                        <p class="text-center">CPF<br><strong><?=$aluno->cpf?></strong></p>
                        <p class="text-center">Data de Nascimento<br><strong><?=FormataData($aluno->nascimento)?></strong></p>
                        <p class="text-center">Validade<br><strong>dezembro/<?=date("Y")?></strong></p>
                        <p class="text-center">Código de Validação<br><strong><?=md5(serialize($aluno))?></strong></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main> 
</body>
<?php
    include "foot.php";
?>
