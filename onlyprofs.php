<?php
if (isset($_COOKIE["siape"])){
    //logado como professor
}else{
    header('HTTP/1.0 403 Forbidden');
    echo 'Acesso proibido!';
    exit();
}
?>