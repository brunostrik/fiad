<?php
    include "cookier.php";
    include "head.php";

    require_once "model/DB.php";
    require_once "model/Aluno.php";
    require_once "model/Registro.php";
    require_once "model/Professor.php";
	require_once "model/Categoria.php";

    require_once "common.php"; //HELPER

    //Segurança - área limitada para professores
    include "onlyprofs.php";

    //Carregar os dados do aluno a partir da matricula que vem como parametro
    $matricula = $_REQUEST["mat"];
    $aluno = Aluno::Load($matricula);

    //Carregar os professores
    $professores = Professor::SelectAll();

    //carregar os registros sobre ele e mostrar: data, autor, texto (limitado) e se é sigiloso ou não. também mostrar botão para ver detalhes
	$registros = Registro::SelectByMatricula($matricula);

?>
<body>
<?php
    include "nav.php";
?>

<main role="main" class="container">
    <div class="container">
    <h1>Adicionar Registro</h1>
    <form class="mb-3" action="salvar_registro.php" method="POST" onsubmit="btnEnviar.disabled = true; btnEnviar.value='Enviando...'; return true;">
        <input type="hidden" name="matricula" value="<?=$matricula?>">
    <h4><?=$aluno->matricula?> <?=$aluno->nome?> - Turma <?=$aluno->turma?></h4>

    
        <div class="form-group">
            <label for="txtData">Data</label>
            <input type="date" class="form-control" id="txtData" name="txtData" required>
            <script>
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                today = yyyy + '-' + mm + '-' + dd;
                txtData.value = today;
            </script>
        </div>
		<div class="form-group">
            <label for="cmbCategoria">Categoria</label>
            <select class="form-control" id="cmbCategoria" name="cmbCategoria" required>
				<?php
				$categorias = Categoria::SelectAll();
				foreach($categorias as $categoria){
				?>
					<option value="<?=$categoria->id?>"><?=$categoria->nome?></option>
				<?php
				} //END FOREACH Categoria
				?>
            </select>
        </div>
        <div class="form-group">
            <label for="txtTexto">Texto</label>
            <textarea class="form-control" id="txtTexto" name="txtTexto" required maxlength="5000" style="height: 320px;"></textarea>
        </div>

        <label for="rbtSigiloso">Nível de acesso:</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rbtSigiloso" id="rbtSigiloso1" value="0" checked>
            <label class="form-check-label" for="rbtSigiloso1">Normal (Acesso livre)</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="rbtSigiloso" id="rbtSigiloso2" value="1">
            <label class="form-check-label" for="rbtSigiloso2">Sigiloso (Somente SEPAE e Coordenações)</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="rbtSigiloso" id="rbtSigiloso3" value="2">
            <label class="form-check-label" for="rbtSigiloso3">Secreto (Somente Psicóloga)</label>
        </div>

        <h4>Encaminhamento</h4>
        <div class="form-group">
            <label for="cmbDestinatario">Para</label>
            <select class="form-control" id="cmbDestinatario" name="cmbDestinatario">
                <option value="0">Sem encaminhamento</option>
                <?php
                foreach ($professores as $professor){
                ?>
                <option value="<?=$professor->siape?>"><?=$professor->nome?></option>
                <?php
                } //END LOOP PROFESSOR ENCAMINHAMENTO
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="txtMensagem">Mensagem</label>
            <textarea class="form-control" id="txtMensagem" name="txtMensagem" maxlength="1000"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" name="btnEnviar" value="Salvar Registro">
    </form>
</main> 
</body>
<?php
    include "foot.php";
?>
