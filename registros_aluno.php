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
	
	//Carrega os dados de categoria para aplicar texto e ícone
	$categorias = Categoria::SelectAll();

    $registros = null;
    //Analisa se é administrador (pode ver tudo) ou não (só pode ver o que não é sigiloso)
    if(Professor::Load($_SESSION["siape"])->admin == 1){
        //carregar os registros sobre ele e mostrar: data, autor, texto (limitado) e se é sigiloso ou não. também mostrar botão para ver detalhes
        $registros = Registro::SelectByMatriculaAdmin($matricula);
    }else if(Professor::Load($_SESSION["siape"])->admin == 2){
        //carregar os super sigilosos também
        $registros = Registro::SelectByMatriculaSuperAdmin($matricula);
    }else{
        //carregar LIMITADAMENTE os registros sobre ele e mostrar: data, autor, texto (limitado) e se é sigiloso ou não. também mostrar botão para ver detalhes
        $registros = Registro::SelectByMatricula($matricula);
    }

?>
<body>
<?php
    include "nav.php";
?>

<main role="main" class="container">
    <div class="container">
    <h1>Ficha do Estudante</h1>
    <h2><?=$aluno->matricula?> <?=$aluno->nome?> - Turma <?=$aluno->turma?></h2>
    
    <a href="registrar.php?mat=<?=$aluno->matricula?>" alt="Adicionar registro"><button class="btn btn-primary">Novo Registro</button></a>

    <table class="table table-striped table-hover table-sm mt-2">
        <thead>
            <tr>
                <th></th>
                <th scope="col">Data</th>
                <th scope="col">Autor</th>
				<th scope="col">Categoria</th>
                <th scope="col">Nível</th>
                <th scope="col">Texto</th>
                <th scope="col">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($registros as $registro){
					//Carrega a categoria
					$cat = $categorias[$registro->categoria];
                    //Pega o nome do docente que fez o registro
                    $professor = Professor::Load($registro->professor);
                    //Coloca sigiloso como texto
                    $nivel = "Normal";
                    $icone = "flag_green.png";
                    if ($registro->sigiloso == 1){
                        $nivel = "Sigiloso";
                        $icone = "error.png";
                    }else if($registro->sigiloso == 2){
                        $nivel = "Secreto";
                        $icone = "stop.png";
                    }else{
						$nivel = "Normal";
						$icone = $cat->icone;
					}
					
            ?>
            <tr>
                <td><img src="img/<?=$icone?>" alt="registro"></td>
                <td><?=FormataData($registro->data)?></td>
                <td><?=$professor->nome?></td>
				<td><?=$cat->nome?></td>
                <td><?=$nivel?></td>
                <td><?=LimitText($registro->texto)?></td>
                <td>
                    <a href="detalhe_registro.php?id=<?=$registro->id?>"><img src="img/table.png" alt="Visualizar completo"></a>
                </td>
            </tr> 
            <?php
                } //END LOOP REGISTROS
            ?>
        </tbody>
    </table>
    <p class="card-text"><em>Registros marcados como sigilosos são exibidos somente para SEPAE e coordenação.<br>Registros secretos são restritos à psicóloga.</em></p>
</main> 
</body>
<?php
    include "foot.php";
?>
