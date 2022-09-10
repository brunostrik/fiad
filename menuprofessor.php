<?php
    include "cookier.php";
    include "head.php";

	require_once "common.php"; //HELPER

    require_once "model/DB.php";
    require_once "model/Aluno.php";
    require_once "model/Registro.php";
    require_once "model/Professor.php";
    require_once "model/Encaminhamento.php";

    //Segurança - área limitada para professores
    include "onlyprofs.php";

    //Carrega o siape do professor que está logado
    $siapeProfessor = $_SESSION["siape"];

    //Carrega os encaminhamentos pendentes recebidos
    $recebidos = Encaminhamento::SelectRecebidosDTO($siapeProfessor);

    //Carrega os encaminhamentos pendentes enviados
    $enviados = Encaminhamento::SelectEnviadosDTO($siapeProfessor);


	
?>
<body>
<?php
include "nav.php";
?>

<main role="main" class="container">
    <div class="container">
    <h1>Meus encaminhamentos não resolvidos</h1>
    <h2>Recebidos</h2>
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th></th>
                <th scope="col">Data</th>
                <th scope="col">Remetente</th>
                <th scope="col">Estudante</th>
                <th scope="col">Mensagem</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($recebidos as $recebido){
            ?>
            <tr>
                <td><img src="img/note.png" alt="recebido"></td>
                <td><?=FormataData($recebido->dataEncaminhamento)?></td>
                <td><?=$recebido->nomeRemetente?></td>
                <td> <?=$recebido->nomeAluno?></td>
                <td><?=LimitText($recebido->assunto)?></td>
                <td><a href="detalhe_registro.php?id=<?=$recebido->idRegistro?>" alt="Detalhes"><img src="img/table.png" title="Detalhes"></a> </td>
            </tr>
            <?php
            } //END LOOP RECEBIDOS
            ?>           
        </tbody>
    </table>
    <h2>Enviados</h2>
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th></th>
                <th scope="col">Data</th>
                <th scope="col">Destinatário</th>
                <th scope="col">Estudante</th>
                <th scope="col">Mensagem</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($enviados as $enviado){
            ?>
            <tr>
                <td><img src="img/note_go.png" alt="recebido"></td>
                <td><?=FormataData($enviado->dataEncaminhamento)?></td>
                <td><?=$enviado->nomeDestinatario?></td>
                <td> <?=$enviado->nomeAluno?></td>
                <td><?=LimitText($enviado->assunto)?></td>
                <td><a href="detalhe_registro.php?id=<?=$enviado->idRegistro?>" alt="Detalhes"><img src="img/table.png" title="Detalhes"></a> </td>
            </tr>
            <?php
            } //END LOOP RECEBIDOS
            ?>           
        </tbody>
    </table>
    </div>
</main> 
</body>
<?php
    include "foot.php";
?>
