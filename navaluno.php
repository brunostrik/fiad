<?php
require_once "model/Aluno.php";
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <span class="navbar-brand" href="#">FIAD - Estudante</span>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="msgaluno.php">Enviar Mensagem</a>
          </li>   
          <li class="nav-item">
            <a class="nav-link" href="carteirinha.php?mat=<?=$_SESSION["matricula"]?>">Carteirinha</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="perfil.php?mat=<?=$_SESSION["matricula"]?>">Dados Pessoais</a>
          </li> 
        </ul>
        <ul class="navbar-nav">
        <li class="nav-item">
                <a class="nav-link"><?=Aluno::Load($_SESSION["matricula"])->nome?></a> 
            </li>
            <li class="nav-item">
                <a class="nav-link" href="trocasenha.php">Trocar senha</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logoff.php">Sair</a>
            </li>
        </ul>
    </nav>
