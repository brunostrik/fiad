<?php
    include "cookier.php";
    require_once "common.php"; //HELPER

    //Segurança - área limitada para professores
    include "onlyprofs.php";

    require_once "model/DB.php";
    require_once "model/Aluno.php";
    require_once "model/Registro.php";
    require_once "model/Professor.php";

    //ID DO REGISTRO
    $id = safe($_REQUEST['id']);
    //Carregar dados do registro
    $registro = Registro::Load($id);
    //Carregar dados do aluno
    $aluno = Aluno::Load($registro->aluno);
    //Carregar dados do professor
    $professor = Professor::Load($registro->professor);

?>
 <!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Advertência</title>
        <style>
            @media print
            {    
                .no-print, .no-print *
                {
                    display: none !important;
                }
            }
        </style>
    </head>
    <body>
        <div style="text-align:center; font-family: sans-serif;width:800px;margin: 0 auto; padding: 10px;">
            <img src="img/logo.png" alt="logo" height="80">
            <h1>ADVERTÊNCIA</h1>
            <div style="text-align: justify">
                <p>
                Com base no Regulamento Disciplinar do IFPR (Resolução 01/2012) o(a) estudante <strong><?=$aluno->nome?></strong> fica advertido pela violação do regimento disciplinar desta escola, com destaque para o seguinte ocorrido:
                </p>
                <em><?=$registro->texto?></em>
                </p>
                <p>Em caso de nova advertência o estudante estará sujeito a aplicação de suspensão, conforme Artigo 16 da Resolução 01/2012.</p>
                <p>OBS: O estudante deve devolver este documento assinado por seu responsável em até 05 (cinco) dias úteis.</p>
                <br>
                <div style="text-align: right">
                Astorga/PR, <?=FormataData($registro->data)?>.
                </div> 
                <div style="text-align: center">
                <p><?=$professor->nome?><br>Professor</p>
                <p><?=NOME_COORDENADOR?><br>Coordenador do Curso</p>
                </div>
            </div>
            <br>
            <div style="border: 2px solid black;padding:10px;"><em>Este documento foi assinado digitalmente pelo Sistema FIAD do IFPR Astorga<br>Código de verificação: <?=md5(serialize($registro))?></em></div>
            <div style="text-align: center; padding: 15px">
                <button class="no-print" onclick="window.print();return false;"><img src="img/printer.png" alt=""> Imprimir</button>
            </div>
        </div>
    </body>
</html> 