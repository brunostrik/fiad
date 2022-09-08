<?php
	require_once "common.php"; //HELPER
	
	include "head.php";

    $chave = safe($_REQUEST["chave"]);

?>

  <body>
    <div id="login">
		
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-8">
                    <div id="login-box" class="col-md-12 card mt-3">
        				<h3 class="text-center pt-5">Nova Senha</h3>
                        <form id="login-form" class="form" method="post" action="novasenha_salva.php" onsubmit="return ">
                            <input type="hidden" name="chave" value="<?=$chave?>">
							<div class="form-group">
                                <label for="senha1">Senha:</label><br>
                                <input type="password" name="senha1" id="senha1" class="form-control" required>
                            </div>       
                            <div class="form-group">
                                <label for="senha2">Repita a senha:</label><br>
                                <input type="password" name="senha2" id="senha2" class="form-control" required>
                            </div>                      
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-md" value="Confirmar">								
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