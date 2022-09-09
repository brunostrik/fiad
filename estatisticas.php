<?php
    include "cookier.php";
    include "head.php";
    require_once "common.php"; //HELPER

    //Segurança - área limitada para professores
    include "onlyprofs.php";
?>
<body>
<?php
    include "nav.php";
?>

<main role="main" class="container">
    <div class="container">


    <div class="card">       
        <div class="card-body">
        
            <h5 class="card-title">Relatórios estatísticos</h5>           
            <form action="relatorio.php" method="POST" onsubmit="btnEnviar.disabled = true; btnEnviar.value='Aguarde...'; return true;">
                <div class="form-group">
                    <label for="cmbRelatorio">Escolha o tipo de relatório</label>
                    <select class="form-control" id="cmbRelatorio" name="cmbRelatorio">
                        
                        <option value="IG">Ingressos geral</option>
                        <option value="IT">Ingressos por turma</option>
                        <option value="EG">Egressos Geral</option>
                        <option value="ET">Egressos por turma</option>
                        <option value="RG" disabled>Retenção Geral (2023+)</option>
                        <option value="RT" disabled>Retenção por turma (2023+)</option>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" name="btnEnviar" value="Gerar">
            </form>
        </div>
    </div>
    
</main> 
</body>
<?php
    include "foot.php";
?>
