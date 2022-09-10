<?php
    include "cookier.php";
    include "head.php";

    require_once "model/Professor.php";
    require_once "model/Encaminhamento.php";

    require_once "common.php"; //HELPER

    //Segurança - área limitada para professores
    include "onlyprofs.php";

    //......................
    $erro = "";

    try{
        //Coleta os parametros
        $enc = new Encaminhamento();
        $enc->registro = safe($_POST["idRegistro"]);
        $enc->destinatario = safe($_POST["cmbDestinatario"]);
        $enc->assunto = safe($_POST["txtMensagem"]);
        $enc->data = date("Y-m-d");
        $enc->resolvido = 0;
        $enc->remetente = $_SESSION["siape"];

        //Salva o encaminhamento
        $enc->Insert();

        //Manda email de encaminhamento
        if (safe($_POST["cmbDestinatario"]) != "0"){          
            //Carregar o email do professor destino
            $destinatario = Professor::Load($enc->destinatario);
            //Carregar o email do professor remetente
            $remetente = Professor::Load($enc->remetente);
            $assunto = "Novo encaminhamento Sistema FIAD";
            $mensagemHTML = "Olá!<br>Um novo encaminhamento foi direcionado a você no Sistema FIAD do IFPR Astorga:<br>$enc->assunto<br><a href='".URL."'>Clique aqui para mais detalhes</a>.";           
            $respEmail = SendEmailHTML($destinatario, $remetente, $assunto, $mensagemHTML);
        }    

    } catch (Exception $e) {
        var_dump($e);
        $erro =  $e->getMessage;
    }
?>
<body>
<?php
    include "nav.php";
?>

<main role="main" class="container">
    <div class="container">   
    <?php
    if ($erro == ""){
    ?>
        <div class="alert alert-success" role="alert">
        Seu encaminhamento foi realizado com sucesso!<br>
        O destinatário foi informado.
        </div>
        <a href="detalhe_registro.php?id=<?=$enc->registro?>"><button type="button" class="btn btn-primary">Voltar para o registro</button></a>
        
    <?php
    }else{
    ?>
        <div class="alert alert-danger" role="alert">
        Houve um erro e seu encaminhamento não foi salvo.
        <br><?=$erro?>
        </div>
        <button type="button" class="btn btn-primary" onclick="history.back()">Voltar</button>
    <?php
    }
    ?>
    
</main> 
</body>
<?php
    include "foot.php";
?>
