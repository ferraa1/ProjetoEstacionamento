<br>
<div class="btn-group">
    <a class="btn btn-primary <?php echo ($crud != "create" && $crud != "update" && $crud != "delete" && $crud != "addVeiculo" && $crud != "subVeiculo") ? "disabled" : ""; ?>" role="button" href="index.php?selectedClass=<?=$selectedClass?>">Consultar</a>
    <?php
        if ($_SESSION['tipo'] == "funcionario") {
    ?>
    <a class="btn btn-primary <?php echo ($crud == "create") ? "disabled" : ""; ?>" role="button" href="index.php?selectedClass=<?=$selectedClass?>&crud=create">Cadastrar</a>
    <?php
        }
    ?>
    <a class="btn btn-primary" href="index.php">Voltar</a>
</div>