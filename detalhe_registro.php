<?php
    include "cookier.php";
    include "head.php";
    
    require_once "model/DB.php";
    require_once "model/Aluno.php";
    require_once "model/Registro.php";
    require_once "model/Professor.php";
    require_once "model/Encaminhamento.php";
	require_once "model/Categoria.php";

    require_once "common.php"; //HELPER

    //Segurança - área limitada para professores
    include "onlyprofs.php";

    //Carregar os dados do registro, do professor e do aluno
    $idRegistro = $_REQUEST["id"];
    $registro = Registro::Load($idRegistro);
    $professor = Professor::Load($registro->professor);
    $aluno = Aluno::Load($registro->aluno);
    $profLogado = Professor::Load($_SESSION["siape"]);
	$categoria = Categoria::Load($registro->categoria);

    //Carregar os encaminhamentos do registro
    $encaminhamentosDTO = Encaminhamento::SelectDTOByRegistro($idRegistro);

?>
<body>
<?php
    include "nav.php";
?>

<main role="main" class="container">
    <div class="container">


    <div class="card">
        <div class="card-header">
            <img src="img/<?=$categoria->icone?>" alt=""> Registro Nro.: <?=$idRegistro?>
        </div>
        <div class="card-body">
        <?php
        if($registro->sigiloso == 1){
        ?>
        <div class="alert alert-warning" role="alert">
            <strong>Atenção:</strong> Este registro é de circulação restrita pois pode conter informação sensível ou sigilosa.
        </div>
        <?php
        }else if($registro->sigiloso == 2){            
        ?>
        <div class="alert alert-danger" role="alert">
            <strong>Atenção:</strong> Este registro é considerado SECRETO.
        </div>
        <?php
        } //END IF SIGILOSO
        ?>
            <h5 class="card-title"><?=$aluno->nome?> (Turma <?=$aluno->turma?>)</h5>
            <p class="card-text">Em <?=FormataData($registro->data)?> por <?=$professor->nome?> / Categoria: <?=$categoria->nome?></p>        
            <h5>Conteúdo do registro</h5>
            <p class="card-text"><?=$registro->texto?></p>  
            <h5>Encaminhamentos</h5>
            <table class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Remetente</th>
                        <th scope="col">Destinatário</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Mensagem</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($encaminhamentosDTO as $enc){
                    ?>
                    <tr>                       
                        <td><?=FormataData($enc->data)?></td>
                        <td><?=$enc->nomeRemetente?></td>     
                        <td><?=$enc->nomeDestinatario?></td>   
                        <td><?=($enc->resolvido ? "Resolvido" : "Pendente")?></td>
                        <td><?=$enc->assunto?></td>
                        <td><form action="resolver_encaminhamento.php" onsubmit="return confirm('Deseja mesmo marcar este encaminhamento como resolvido?');" method="POST"><input type="hidden" name="idEncaminhamento" value="<?=$enc->idEncaminhamento?>"><button type="submit" class="btn btn-link btn-sm"><img src="img/accept.png" title="Marcar como resolvido"></button></form></td>
                    </tr> 
                    <?php
                    } //END LOOP ENCAMINHAMENTOS
                    ?>
                </tbody>
            </table>
            <a href="novo_encaminhamento.php?id=<?=$idRegistro?>"><button class="btn btn-success">Novo encaminhamento</button></a>
        </div>
    </div>
    <div class="pt-2">
        <button class="btn btn-primary" onclick="window.print();return false;"><img src="img/printer.png"> Imprimir</button>
        <?php
        //Somente admin pode gerar advertencia
        if ($profLogado->admin){
        ?>        
            <a href="advertencia.php?id=<?=$idRegistro?>"><button class="btn btn-warning"><img src="img/flag_red.png"> Gerar Advertência</button></a>
			<form class="mt-2" method="POST" action="apagar_registro.php" onsubmit="return confirm('Deseja mesmo apagar este registro?');"><input type="hidden" name="idRegistro" value="<?=$idRegistro?>"><button type="submit" class="btn btn-danger"><img src="img/delete.png"> Apagar Registro</button></form>
		<?php
        }
        ?>
    </div>
</main> 
</body>
<?php
    include "foot.php";
?>
