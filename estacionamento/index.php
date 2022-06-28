<!DOCTYPE html>
<?php
    include "validate.php";
    $title = "Menu - Estacionamento";
?>
<html lang="pt-br">
<head>
    <?php include("head.php");?>
</head>
<body>
    <div class="text-center m-5 p-5 rounded shadow-lg">
        <h1><?=$title?></h1>
        <br>
        <div class="btn-group">
            <a class="btn btn-lg btn-primary" href="cruds/vaga.crud.php">Vagas</a>
            <a class="btn btn-lg btn-primary" href="cruds/precoHora.crud.php">Preço/Hora</a>
            <a class="btn btn-lg btn-primary" href="cruds/funcionario.crud.php">Funcionários</a>
            <a class="btn btn-lg btn-primary" href="cruds/cliente.crud.php">Clientes</a>
            <a class="btn btn-lg btn-primary" href="cruds/veiculo.crud.php">Veículos</a>
            <a class="btn btn-lg btn-primary" href="cruds/operacao.crud.php">Operações</a>
            <a class="btn btn-lg btn-primary" role="button" href="actions/login.action.php?action=logoff">Sair</a>
        </div>
    </div>

    <?php include("body.php");?>
</body>
</html>