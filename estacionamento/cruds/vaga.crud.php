<!DOCTYPE html>
<?php
    include "validate.php";
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    $title = "Vaga - Estacionamento";
    $crud = isset($_GET["crud"]) ? $_GET["crud"] : "";
    $name = "vaga";
?>
<html lang="pt-br">
<head>
    <?php include("head.php");?>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url; 
        }
    </script>
</head>
<body>
    <div class="text-center m-5 p-5 rounded shadow-lg">
        <h1><?=$title?></h1>
        <?php
            if ($crud == "create") {
        ?>
        <form action="../actions/vaga.action.php" method="post">
            <fieldset>
                <legend>Cadastrar Vaga</legend>
                <label for="numero">Número</label>
                <br>
                <input required=true type="number" name="numero" id="numero" value="" min="0">
                <br>
                <br>
                <button class="btn btn-lg btn-primary" type="submit" name="action" value="cadastrar">Cadastrar</button>
            </fieldset>
        </form>
        <?php
                include "buttons.php";
            } elseif ($crud == "update") {
                $id = isset($_GET["id"]) ? $_GET["id"] : "";
        ?>
        <form action="../actions/vaga.action.php" method="post">
            <fieldset>
                <legend>Editar Vaga</legend>
                <input require=true type="hidden" name="id" id="id" value="<?=$id?>">
                <label for="numero">Número</label>
                <br>
                <input required=true type="number" name="numero" id="numero" value="" min="0">
                <br>
                <br>
                <button class="btn btn-lg btn-primary" type="submit" name="action" value="editar">Editar</button>
            </fieldset>
        </form>
        <?php
                include "buttons.php";
            } else {
                $consulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";
        ?>
        <form method="post">
            <fieldset>
                <legend>Consultar Vagas</legend>
                <label for="consulta">Número</label>
                <br>
                <input type="text" name="consulta" id="consulta" value="<?=$consulta?>">
                <br>
                <br>
                <button class="btn btn-lg btn-primary" type="submit">Consultar</button>
            </fieldset>
        </form>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NÚMERO</th>
                    <th scope="col">EDITAR</th>
                    <th scope="col">EXCLUIR</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM vaga WHERE numero LIKE '$consulta%'");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <th scope="row"><?php echo $linha['id'];?></th>
                        <td><?php echo $linha['numero'];?></td>
                        <td><a href="vaga.crud.php?crud=update&id=<?php echo $linha['id'];?>">Editar</a></td>
                        <td><a href="javascript:excluirRegistro('../actions/vaga.action.php?action=excluir&id=<?php echo $linha['id'];?>')">Excluir</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
                include "buttons.php";
            }
        ?>
    </div>

    <?php include("body.php");?>
</body>
</html>