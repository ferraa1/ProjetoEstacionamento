<!DOCTYPE html>
<?php
    include "validate.php";
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    $title = "Preço/Hora - Estacionamento";
    $crud = isset($_GET["crud"]) ? $_GET["crud"] : "";
    $name = "precoHora";
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
        <form action="../actions/precoHora.action.php" method="post">
            <fieldset>
                <legend>Cadastrar Preço/Hora</legend>
                <label for="preco">Preço</label>
                <br>
                <input required=true type="number" name="preco" id="preco" value="" min="0">
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
        <form action="../actions/precoHora.action.php" method="post">
            <fieldset>
                <legend>Editar Preço/Hora</legend>
                <input require=true type="hidden" name="id" id="id" value="<?=$id?>">
                <label for="preco">Preço</label>
                <br>
                <input required=true type="number" name="preco" id="preco" value="" min="0">
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
                <legend>Consultar Preço/Horas</legend>
                <label for="consulta">Preço</label>
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
                    <th scope="col">PREÇO</th>
                    <th scope="col">EDITAR</th>
                    <th scope="col">EXCLUIR</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM preco_hora WHERE preco LIKE '$consulta%'");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <th scope="row"><?php echo $linha['id'];?></th>
                        <td><?php echo $linha['preco'];?></td>
                        <td><a href="precoHora.crud.php?crud=update&id=<?php echo $linha['id'];?>">Editar</a></td>
                        <td><a href="javascript:excluirRegistro('../actions/precoHora.action.php?action=excluir&id=<?php echo $linha['id'];?>')">Excluir</a></td>
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