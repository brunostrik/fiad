<?php
	require_once "common.php"; //HELPER	
	include "head.php";
    require_once "model/Reset.php";
    require_once "model/Professor.php";
    require_once "model/Aluno.php";

    $erro = "";

    $reset = new Reset();
    $reset->utilizado = 0;
    $reset->chave = "";
    $reset->siape = 0;
    $reset->matricula = 0;
    $reset->email = safe($_POST["email"]);

    //coleta o tipo 0-estudante 1-professor
    $tipo = safe($_POST["acesso"]);  
    //analisa o tipo e checa se o email existe, e executa as operações necessárias
    if($tipo == 0){
        //aluno
        $aluno = Aluno::SelectByEmail($reset->email);
        if($aluno){
        $reset->chave = md5(serialize($aluno));
        $reset->matricula = $aluno->matricula;      
        $reset->Insert();
        }else{
            $erro = "404";
        }
    }else{
        //professor
        $prof = Professor::SelectByEmail($reset->email);
        if ($prof){
            $reset->chave = md5(serialize($prof));
            $reset->siape = $prof->siape;
            $reset->Insert();
        }else{
            $erro = "404";
        }
    }
    
    //Envia o email
    $mensagem = "<p>Você solicitou uma nova senha no Sistema FIAD.</p><p><a href='".URL."/novasenha.php?chave=$reset->chave'>Clique aqui para criar uma nova senha</a>.</p>";
    SendEmailRecuperarSenha($reset->email, "Recuperação de senha Sistema FIAD", $mensagem);      

?>

  <body>
    <div id="login">		
        <div class="container pt-3">        
        <?php
        if ($erro == ""){
        ?>
            <div class="alert alert-success" role="alert">
            Um link para recuperação de sua senha foi enviado para seu email.<br>
            Caso não encontre verifique também a caixa de spam.
            </div>
            <a href="index.php"><button type="button" class="btn btn-primary">Início</button></a>
            
        <?php
        }else{
        ?>
            <div class="alert alert-danger" role="alert">
            E-mail não encontrado.
            </div>
            <button type="button" class="btn btn-primary" onclick="history.back()">Voltar</button>
        <?php
        }
        ?>
        </div>
    </div>
  </body>
<?php
    include "foot.php";
?>