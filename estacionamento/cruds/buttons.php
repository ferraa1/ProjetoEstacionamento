<br>
<div class="btn-group">
    <a class="btn btn-lg btn-primary <?php echo ($crud == "create") ? "disabled" : ""; ?>" role="button" href="<?=$name?>.crud.php?crud=create">Cadastrar</a>
    <a class="btn btn-lg btn-primary <?php echo ($crud != "create" && $crud != "update" && $crud != "delete") ? "disabled" : ""; ?>" role="button" href="<?=$name?>.crud.php">Consultar</a>
    <a class="btn btn-lg btn-primary" href="../index.php">Voltar</a>
</div>