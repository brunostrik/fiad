<?php
	require_once "common.php"; //HELPER	
	include "head.php";
    require_once "model/Reset.php";
    require_once "model/Professor.php";
    require_once "model/Aluno.php";

    $erro = "";
    try{
        //Coleta os valores
        $senha1 = safe($_POST["senha1"]);
        $senha2 = safe($_POST["senha2"]);
        $senhaMD5 = md5($senha1);
        $chave = safe($_POST["chave"]);
        if ($senha1 != $senha2){
            $erro = "As duas senhas digitadas não são iguais.";
        }else if(strlen($senha1) < 6){
            $erro = "Sua senha é muito curta, por favor utilize 6 ou mais caracteres.";
        }else{
            //Carrega o reset e descobre se é aluno ou professor
            $reset = Reset::SelectByChave($chave);
            if(!$reset){
                //chave nao encontrada ou ja utilizada
                $erro = "Chave de autenticação inválida.";
            }else if ($reset->siape > 0){
                //é prof
                Professor::TrocaSenha($reset->siape, $senhaMD5);
                Reset::Queimar($chave);
            }else if ($reset->matricula > 0){
                //é aluno
                Aluno::TrocaSenha($reset->matricula, $senhaMD5);
                Reset::Queimar($chave);
            }else{
                //bugado
                $erro = "Estudante ou professor não identificado.";
            }
            //Atualiza a senha e queima o reset
        }
    }catch(Exception $e){
        $erro = $e->getMessage();
    }
?>

  <body>
    <div id="login">		
        <div class="container pt-3">        
        <?php
        if ($erro == ""){
        ?>
            <div class="alert alert-success" role="alert">
            Sua senha foi atualizada.
            </div>
            <a href="index.php"><button type="button" class="btn btn-primary">Início</button></a>
            
        <?php
        }else{
        ?>
            <div class="alert alert-danger" role="alert">
            Erro ao trocar senha:<br><?=$erro?>
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