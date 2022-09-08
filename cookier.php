<?php

if (isset($_COOKIE["matricula"])){
    //logado como aluno
}else if (isset($_COOKIE["siape"])){
    //logado como professor
}else{
    //sem login, encaminhar para index
    header("Location: index.php");
    exit();
}


?>