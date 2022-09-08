<?php
require_once "common.php"; //HELPER
//Segurança - área limitada para professores
include "onlyprofs.php";
require_once "model/Registro.php";

$idRegistro = safe($_POST["idRegistro"]);
$registro = Registro::Load($idRegistro);
Registro::Delete($idRegistro);
header("Location: registros_aluno.php?mat=$registro->aluno");
exit();
?>