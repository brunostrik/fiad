<?php
require_once "common.php"; //HELPER
//Segurança - área limitada para professores
include "onlyprofs.php";
require_once "model/Registro.php";
require_once "model/Encaminhamento.php";

$idEncaminhamento = safe($_POST["idEncaminhamento"]);
$encaminhamento = Encaminhamento::Load($idEncaminhamento);
$encaminhamento->Resolver();
header("Location: detalhe_registro.php?id=$encaminhamento->registro");
exit();
?>