<?php
    include "cookier.php";
    include "head.php";

	require_once "common.php"; //HELPER	
    require_once "model/Aluno.php";
    require_once "model/Professor.php";
    require_once "model/Mensagem.php";

	include "head.php";

    $erro = "";

    try{
        //coleta as variaveis
        $destinatario = safe($_POST["destinatario"]);
        $mensagem = safe($_POST["msg"]);

        $aluno = Aluno::Load($_SESSION["matricula"]);
        $professor = Professor::Load($destinatario);

        $msg = new Mensagem();
        $msg->data = date("Y-m-d H:i:s");
        $msg->aluno = $aluno->matricula;
        $msg->professor = $professor->siape;
        $msg->mensagem = $mensagem;
        $msg->Insert();

        SendEmailHTML($professor, $aluno, "Sistema FIAD: $aluno->nome mandou uma mensagem pra você", $mensagem);
    }catch(Exception $e){
        $erro = $e->getMessage();
    }

?>

<body>
<?php
    include "navaluno.php";
?>
<main role="main" class="container">
    <div class="container pt-2">   
    <?php
    if ($erro == ""){
    ?>
        <div class="alert alert-success" role="alert">
        Sua mensagem foi enviada.
        </div>        
    <?php
    }else{
    ?>
        <div class="alert alert-danger" role="alert">
        Houve um erro e sua mensagem não foi enviada.
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