<?php
	require_once "common.php"; //HELPER
	
	include "head.php";

?>

  <body>
    <div id="login">
		
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-8">
                    <div id="login-box" class="col-md-12 card mt-3">
        				<h3 class="text-center pt-5">Recuperação de Senha</h3>
                        <form id="login-form" class="form" method="post" action="esqueci_envia.php">
                            <div class="form-group">
                                <label for="acesso">Acesso:</label><br>
                                <select name="acesso" id="acesso" class="form-control">
									<option value="0">Estudante</option>
									<option value="1">Professor</option>
								</select>
                            </div>
							<div class="form-group">
                                <label for="email">E-mail:</label><br>
                                <input type="email" name="email" id="email" class="form-control" required>
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