<?php
	require_once "common.php"; //HELPER	
    require_once "model/Aluno.php";
    require_once "model/Professor.php";
	include "head.php";
    $aluno = Aluno::Load($_SESSION["matricula"]);
    $professores = Professor::SelectAll();
?>

  <body>
  <?php
    include "navaluno.php";
?>
    <div id="login">
		
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-8">
                    <div id="login-box" class="col-md-12 card mt-3">
                        <img src="img/logo.png" class="mx-auto d-block img-fluid mt-3" alt="logo">
                        <h3 class="text-center pt-5">Enviar mensagem</h3>
                        <form id="login-form" class="form" method="post" action="enviamsg_aluno.php" onsubmit="btnEnviar.disabled = true; btnEnviar.value='Enviando...'; return true;">
                            <div class="form-group">
                                <label for="remetente">Remetente</label><br>
                                <input type="text" name="remetente" id="remetente" class="form-control" disabled value="<?=$aluno->nome?>">
                            </div> 
                            <div class="form-group">
                                <label for="destinatario">Destinatário</label><br>
                                <select name="destinatario" id="destinatario" class="form-control">
                                    <?php
                                    foreach ($professores as $professor){
                                    ?>
                                    <option value="<?=$professor->siape?>"><?=$professor->nome?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>       
                            <div class="form-group">
                                <label for="msg">Mensagem</label><br>
                                <textarea name="msg" id="msg" class="form-control" style="height:200px" required maxlength="3000"></textarea>
                            </div>                      
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-md" value="Enviar">	
                                <a href="logoff.php"><button type="button" class="btn btn-danger">Sair</button></a>							
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
<?php
    include "foot.php";
?>