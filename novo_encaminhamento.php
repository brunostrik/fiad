<?php
    include "cookier.php";
    include "head.php";

    require_once "model/DB.php";
    require_once "model/Aluno.php";
    require_once "model/Registro.php";
    require_once "model/Professor.php";
    require_once "model/Encaminhamento.php";

    require_once "common.php"; //HELPER

    //Segurança - área limitada para professores
    include "onlyprofs.php";

    //Carregar os dados do registro, do professor e do aluno
    $idRegistro = $_REQUEST["id"];
    $registro = Registro::Load($idRegistro);
    $professor = Professor::Load($registro->professor);
    $aluno = Aluno::Load($registro->aluno);

    //Carregar os encaminhamentos do registro
    $encaminhamentosDTO = Encaminhamento::SelectDTOByRegistro($idRegistro);

    //Carregar lista de professores
    $professores = Professor::SelectAll();

?>
<body>
<?php
    include "nav.php";
?>

<main role="main" class="container">
    <div class="container">


    <div class="card">
        <div class="card-header">
            Registro Nro.: <?=$idRegistro?>
        </div>
        <div class="card-body">
        <?php
        if($registro->sigiloso){
        ?>
        <div class="alert alert-warning" role="alert">
            <strong>Atenção:</strong> Este registro é de circulação restrita pois pode conter informação sensível ou sigilosa.
        </div>
        <?php
        } //END IF SIGILOSO
        ?>
            <h5 class="card-title"><?=$aluno->nome?> (Turma <?=$aluno->turma?>)</h5>
            <p class="card-text">Em <?=FormataData($registro->data)?> por <?=$professor->nome?></p>        
            <h5>Conteúdo do registro</h5>
            <p class="card-text"><?=$registro->texto?></p>  
            <h4>Novo Encaminhamento</h4>
            <form action="salvar_encaminhamento.php" method="POST" onsubmit="btnEnviar.disabled = true; btnEnviar.value='Enviando...'; return true;">
                <input type="hidden" name="idRegistro" value="<?=$idRegistro?>">              
                <div class="form-group">
                    <label for="cmbDestinatario">Para</label>
                    <select class="form-control" id="cmbDestinatario" name="cmbDestinatario">
                        <?php
                        foreach ($professores as $professor){
                        ?>
                        <option value="<?=$professor->siape?>"><?=$professor->nome?></option>
                        <?php
                        } //END LOOP PROFESSOR ENCAMINHAMENTO
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txtMensagem">Mensagem</label>
                    <textarea class="form-control" id="txtMensagem" name="txtMensagem" maxlength="1000"></textarea>
                </div>
                <input type="submit" class="btn btn-primary" name="btnEnviar" value="Salvar Encaminhamento">
            </form>
        </div>
    </div>
</main> 
</body>
<?php
    include "foot.php";
?>
