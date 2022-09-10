<?php
	session_start();
	require_once "common.php"; //HELPER
	require_once "model/Professor.php";
	require_once "model/Aluno.php";
	
	$mostraErro = "hidden";

	//ANALISA SE TEM sessao E CASO SIM ENCAMINHA PARA O MENU ADEQUADO
	if (isset($_SESSION["matricula"])){
		//logado como estudante
		header("Location: menualuno.php");
   		exit();
	}else if (isset($_SESSION["siape"])){
		//logado como professor
		header("Location: menuprofessor.php");
   		exit();
	}

	//LOGIN (SELF-CALL)
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = safe($_POST["email"]);
		$senha = md5($_POST["senha"]);

		//Detecta se é acesso de professor ou estudante
		$acesso = 0;
		$acesso = Professor::Existe($email);
		

		if (!$acesso){//ESTUDANTE
			$aluno = Aluno::Login($email, $senha);
			if (!$aluno){//ACESSO NEGADO
				$mostraErro = "";
			}else{//ACESSO OK
				//setcookie("matricula",$aluno->matricula);
				session_start();
				$_SESSION["matricula"] = $aluno->matricula;
				header("Location: menualuno.php");
   				exit();
			}
		}else if ($acesso){//PROFESSOR
			$prof = Professor::Login($email, $senha);
			if (!$prof){//ACESSO NEGADO
				$mostraErro = "";
			}else{//ACESSO OK
				//setcookie("siape",$prof->siape);
				session_start();
				$_SESSION["siape"] = $prof->siape;
				header("Location: menuprofessor.php");
   				exit();
			}
		}else{//ERRO
			$mostraErro = "";
		}
	}
	
	include "head.php";

?>

  <body>
    <div id="login">
		
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-8">
                    <div id="login-box" class="col-md-12 card mt-3">
						<img src="img/logo.png" class="mx-auto d-block img-fluid mt-3" alt="logo">
        				<h3 class="text-center pt-5">Acompanhamento do Estudante TINFEM</h3>
                        <form id="login-form" class="form" method="post" action="<?php echo safe($_SERVER["PHP_SELF"]);?>">
							<div class="form-group">
                                <label for="email">E-mail:</label><br>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha:</label><br>
                                <input type="password" name="senha" id="senha" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-md" value="Entrar">
								<span class="text-danger pl-1" <?=$mostraErro ?>>
									Usuário e/ou senha inválidos!
								</span>
							</div>
                            <div id="register-link" class="text-right mb-3">
                                <a href="esqueci.php" class="text-info">Esqueci minha senha</a>
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