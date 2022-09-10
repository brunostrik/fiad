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

    //......................
    $erro = "";

    try{
        //Coleta o registro
        $registro = new Registro();      
        $registro->id = 0;
        $registro->texto = safe($_POST["txtTexto"]);
        $registro->professor = safe($_SESSION["siape"]);
        $registro->aluno = safe($_POST["matricula"]);
        $registro->data = safe($_POST["txtData"]);
        $registro->sigiloso = safe($_POST["rbtSigiloso"]);
		$registro->categoria = safe($_POST["cmbCategoria"]);
        //Coleta o encaminhamento, se houver
        $enc = null;
        if (safe($_POST["cmbDestinatario"]) != "0"){     
            $enc = new Encaminhamento();
            $enc->registro = $registro->id; //Chave estrangeira do registro
            $enc->data = date("Y-m-d");
            $enc->remetente = $registro->professor;
            $enc->destinatario = safe($_POST["cmbDestinatario"]);
            $enc->resolvido = false;
            $enc->assunto = safe($_POST["txtMensagem"]);
        }
        //Salva no banco de dados
        DB::SalvaRegistroEncaminhamento($registro, $enc);
        
        //Carrega o aluno
        $aluno = Aluno::Load($registro->aluno);

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
        //AVISAR COORDENADOR E AVISA TAMBÉM A SEPAE, SOMENTE SE NAO FOR SECRETO
        if ($registro->sigiloso < 2){
            $emailCoordenacaoAviso = EMAIL_COORDENACAO;
            $emailSepaeAviso = EMAIL_SEPAE;
            $autor = Professor::Load($registro->professor);
            $assuntoAviso = "Novo registro FIAD $aluno->nome por $autor->nome";
            $mensagemHTMLAviso = "Autor: $autor->nome<br>Estudante: $aluno->nome<br>Data: ".FormataData($registro->data)."<br>Sigiloso: ".SimNao($registro->sigiloso)."<br>Texto: $registro->texto";
            if ($enc != null){
                $mensagemHTMLAviso .= "<br>A mensagem foi encaminhada para: $destinatario->nome";
            }
            SendEmailHTMLDireto($emailCoordenacaoAviso, $autor, $assuntoAviso, $mensagemHTMLAviso);       
            SendEmailHTMLDireto($emailSepaeAviso, $autor, $assuntoAviso, $mensagemHTMLAviso);    
        }  


    } catch (Exception $e) {
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
        Seu registro foi salvo e os encaminhamentos necessários foram realizados com sucesso!<br>
        A coordenação do curso e a SEPAE serão informados.
        </div>
        <a href="index.php"><button type="button" class="btn btn-primary">Menu principal</button></a>
        
    <?php
    }else{
    ?>
        <div class="alert alert-danger" role="alert">
        Houve um erro e seu registro não foi salvo.
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
