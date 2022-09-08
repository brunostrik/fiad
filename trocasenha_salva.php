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
        $senhaAtual = md5($_POST["senhaAtual"]);
        if ($senha1 != $senha2){
            $erro = "As duas senhas digitadas não são iguais.";
        }else if(strlen($senha1) < 6){
            $erro = "Sua senha é muito curta, por favor utilize 6 ou mais caracteres.";
        }else{
            //Descobre se é aluno ou professor
            if (isset($_COOKIE["siape"])){
                //é prof
                $siape = $_COOKIE["siape"];
                //checa se a senha atual está correta
                $prof = Professor::ChecaSenha($siape, $senhaAtual);
                if(!$prof){
                    $erro = "Professor, sua senha atual está incorreta.";
                }else{
                    Professor::TrocaSenha($siape, $senhaMD5);
                }
            }else if (isset($_COOKIE["matricula"])){
                //é aluno
                $matricula = $_COOKIE["matricula"];
                //checa se a senha atual está correta
                $aluno = Aluno::ChecaSenha($matricula, $senhaAtual);
                if(!$aluno){
                    $erro = "Estudante, sua senha atual está incorreta.";
                }else{
                    Aluno::TrocaSenha($matricula, $senhaMD5);
                }
            }else{
                //bugado
                $erro = "Estudante ou professor não identificado.";
            }
        }
    }catch(Exception $e){
        $erro = $e->getMessage();
    }
?>

<body>
<?php
    if (isset($_COOKIE["matricula"])){
        include "navaluno.php";
    }else if (isset($_COOKIE["siape"])){
        include "nav.php";
    }
?>
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