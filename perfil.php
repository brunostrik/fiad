<?php
    include "cookier.php";
    include "head.php";

    require_once "model/DB.php";
    require_once "model/Aluno.php";
    require_once "model/Registro.php";
    require_once "model/Professor.php";

    require_once "common.php"; //HELPER

    //Segurança - área limitada para professores ou alunos
    include "cookier.php";

    //Carregar os dados do aluno a partir da matricula que vem como parametro
    $matricula = $_REQUEST["mat"];
    $aluno = Aluno::Load($matricula);

?>
<body>
<?php
    if (isset($_COOKIE["matricula"])){
        include "navaluno.php";
    }else if (isset($_COOKIE["siape"])){
        include "nav.php";
    }
    
?>

<main role="main" class="container">
    <div class="container">
    <h1>Dados do Estudante</h1>
    <table class="table table-sm table-striped table-hover table-bordered">
        <tbody>
        <tr>
                <th>Foto</th>
                <td><img src="fotos/<?=$aluno->matricula?>.jpeg" alt="Sem foto" style="height:300px"></td>
            </tr> 
            <tr>
                <th>Nome Completo</th>
                <td><?=$aluno->nome?></td>
            </tr> 
            <tr>
                <th>Matrícula</th>
                <td><?=$aluno->matricula?></td>
            </tr> 
            <tr>
                <th>Data de Nascimento</th>
                <td><?=FormataData($aluno->nascimento)?></td>
            </tr>
            <tr>
                <th>Turma</th>
                <td><?=$aluno->turma?></td>
            </tr> 
            <tr>
                <th>RG</th>
                <td><?=$aluno->rg?></td>
            </tr> 
            <tr>
                <th>CPF</th>
                <td><?=$aluno->cpf?></td>
            </tr> 
            <tr>
                <th>E-mail</th>
                <td><?=$aluno->email?></td>
            </tr> 
            <tr>
                <th>Telefone</th>
                <td><?=$aluno->telefone?></td>
            </tr>            
            <tr>
                <th>Pai</th>
                <td><?=$aluno->pai?></td>
            </tr>            
            <tr>
                <th>Mãe</th>
                <td><?=$aluno->mae?></td>
            </tr> 
            <tr>
                <th>Telefone familiar</th>
                <td><?=$aluno->telefone_familiar?></td>
            </tr> 
            <tr>
                <th>Endereço</th>
                <td><?=$aluno->endereco?></td>
            </tr>
            <tr>
                <th>Cidade</th>
                <td><?=$aluno->cidade?></td>
            </tr>
            <tr>
                <th>Escola de origem</th>
                <td><?=$aluno->origem?></td>
            </tr>
            <tr>
                <th>Acompanhamento egresso</th>
                <td><?=$aluno->destino?></td>
            </tr>
        </tbody>
    </table>
</div>
</main> 
</body>
<?php
    include "foot.php";
?>
