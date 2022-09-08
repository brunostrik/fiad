<?php
require_once "model/Professor.php";
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <span class="navbar-brand" href="#">FIAD - Professor</span>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="menuprofessor.php">Painel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="alunos.php">Estudantes</a>
          </li>   
          <li class="nav-item">
            <a class="nav-link" href="estatisticas.php">Estatísticas</a>
          </li> 
        </ul>
        <ul class="navbar-nav">
        <li class="nav-item">
                <a class="nav-link"><?=Professor::Load($_COOKIE["siape"])->nome?></a> 
            </li>
            <li class="nav-item">
                <a class="nav-link" href="trocasenha.php">Trocar senha</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logoff.php">Sair</a>
            </li>
        </ul>
    </nav>
