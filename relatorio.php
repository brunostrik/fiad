<?php
    require_once "common.php"; //HELPER

    $tipoRelatorio = safe($_POST["cmbRelatorio"]);

    switch($tipoRelatorio){
        case "IG": //Ingressos geral
            header("Location: relatorio_ingressos_geral.php");
            break;
        case "IT": //Ingressos por turma
            header("Location: relatorio_ingressos_turma.php");
            break;
        case "EG": //Egressos Geral
			header("Location: relatorio_egressos_geral.php");
            break;
        case "ET": //Egressos por turma
			header("Location: relatorio_egressos_turma.php");
            break;
        case "RG": //Retenção Geral (2023+)

            break;
        case "RT": //Retenção por turma (2023+)

            break;
        default:
            header("Location: estatisticas.php");
            break;
    }
    exit();
?>