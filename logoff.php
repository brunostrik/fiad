<?php
    if (isset($_COOKIE['siape'])) {
        unset($_COOKIE['siape']); 
        setcookie('siape', null, -1, '/');
    }
    if (isset($_COOKIE['matricula'])) {
        unset($_COOKIE['matricula']); 
        setcookie('matricula', null, -1, '/');
    }
    header("Location: index.php");
   	exit();
?>