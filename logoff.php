<?php
    session_start();
    if (isset($_SESSION['siape'])) {
        unset($_SESSION['siape']); 
        //setcookie('siape', null, -1, '/');
    }
    if (isset($_SESSION['matricula'])) {
        unset($_SESSION['matricula']); 
        //setcookie('matricula', null, -1, '/');
    }
    header("Location: index.php");
   	exit();
?>