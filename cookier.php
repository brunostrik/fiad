<?php
session_start();
if (isset($_SESSION["matricula"])){
    //logado como aluno
}else if (isset($_SESSION["siape"])){
    //logado como professor
}else{
    //sem login, encaminhar para index
    header("Location: index.php");
    exit();
}


?>