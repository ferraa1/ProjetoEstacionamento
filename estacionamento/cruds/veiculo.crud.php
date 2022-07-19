<h1><?=$title?></h1>
<?php
    if ($crud == "create") {
?>
<form action="actions/<?=$selectedClass?>.action.php" method="post">
    <fieldset>
        <legend>Cadastrar <?php echo (ucfirst($selectedClass));?></legend>
        <label for="placa">Placa</label>
        <br>
        <input required=true type="text" name="placa" id="placa" value="">
        <br>
        <br>
        <button class="btn btn-primary" type="submit" name="action" value="cadastrar">Cadastrar</button>
    </fieldset>
</form>
<?php
    } elseif ($crud == "update") {
        $id = isset($_GET["id"]) ? $_GET["id"] : "";
?>
<form action="actions/<?=$selectedClass?>.action.php" method="post">
    <fieldset>
        <legend>Editar <?php echo (ucfirst($selectedClass));?></legend>
        <input require=true type="hidden" name="id" id="id" value="<?=$id?>">
        <?php
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query("SELECT * FROM ".$selectedClass." WHERE id = ".$id." LIMIT 1");
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <label for="placa">Placa</label>
        <br>
        <input required=true type="text" name="placa" id="placa" value="<?=$linha['placa']?>">
        <br>
        <?php
            }
        ?>
        <br>
        <button class="btn btn-primary" type="submit" name="action" value="editar">Editar</button>
    </fieldset>
</form>
<?php
    } else {
        $consulta = isset($_GET['consulta']) ? $_GET['consulta'] : "";
?>
<form method="get">
    <fieldset>
        <legend>Consultar <?php echo (ucfirst($selectedClass));?>s</legend>
        <input require=true type="hidden" name="selectedClass" id="selectedClass" value="<?=$selectedClass?>">
        <label for="consulta">Placa</label>
        <br>
        <input type="text" name="consulta" id="consulta" value="<?=$consulta?>">
        <br>
        <br>
        <button class="btn btn-primary" type="submit">Consultar</button>
    </fieldset>
</form>
<br>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">PLACA</th>
            <?php
                if ($_SESSION['admin'] == 1) {
            ?>
            <th scope="col">EDITAR</th>
            <th scope="col">EXCLUIR</th>
            <?php
                }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php 
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query("SELECT * FROM ".$selectedClass." WHERE placa LIKE '$consulta%'");
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $instance = new veiculo($linha['id'],$linha['placa']);
        ?>
                <tr>
                    <th scope="row"><?php echo $instance->getId();?></th>
                    <td><?php echo $instance->getPlaca();?></td>
                    <?php
                        if ($_SESSION['admin'] == 1) {
                    ?>
                    <td><a class="btn btn-sm btn-secondary" href="index.php?selectedClass=<?=$selectedClass?>&crud=update&id=<?php echo $instance->getId();?>">Editar</a></td>
                    <td><a class="btn btn-sm btn-secondary" href="javascript:excluirRegistro('actions/<?=$selectedClass?>.action.php?action=excluir&id=<?php echo $instance->getId();?>')">Excluir</a></td>
                    <?php
                        }
                    ?>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<?php
    }
?>