<?php
    include "cookier.php";
    include "head.php";
    
    require_once "model/DB.php";
    require_once "model/Aluno.php";
    require_once "model/Registro.php";
    require_once "model/Turma.php";

    require_once "common.php"; //HELPER
	
?>
<body>
<?php
    include "nav.php";
?>

<main role="main" class="container">
    <div class="container">
    <h1>Lista de Estudantes Egressos</h1>

    <?php
        //Carrega uma lista de turmas
        //
        $turmas = Turma::SelectInativas();
        foreach ($turmas as $turma){
    ?>

    <h2>Turma <?=$turma->turma?></h2>
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
            <th scope="col">Matrícula</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">E-mail</th>
            <th></th>
            </tr>
        </thead>
        <tbody>

            <?php
                //Selecionar todos os estudantes daquela turma
                $alunos = Aluno::SelectAllByTurma($turma->turma);
                foreach($alunos as $aluno){
                    
            ?>

            <tr>
            <td><?=$aluno->matricula?></td>
            <td><?=$aluno->nome?></td>
            <td><?=$aluno->telefone?></td>
            <td><?=$aluno->email?></td>
            <td><a href="registros_aluno.php?mat=<?=$aluno->matricula?>" alt="Visualizar ficha"><img src="img/application_view_list.png" title="Visualizar ficha"></a>
             <a href="perfil.php?mat=<?=$aluno->matricula?>" alt="Dados Pessoais"><img src="img/user.png" title="Dados Pessoais"></a></td>
            </tr> 
            
            <?php
                } //END FOREACH ALUNOS
            ?>
        </tbody>
    </table>
    <?php
        } //END FOREACH TURMAS
    ?>
</main> 
</body>
<?php
    include "foot.php";
?>
