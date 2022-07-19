<h1><?=$title?></h1>
<?php
    if ($crud == "create") {
?>
<form action="actions/<?=$selectedClass?>.action.php" method="post">
    <fieldset>
        <legend>Cadastrar <?php echo (ucfirst($selectedClass));?></legend>
        <label for="nome">Nome</label>
        <br>
        <input required=true type="text" name="nome" id="nome" value="">
        <br>
        <label for="usuario">Usuário</label>
        <br>
        <input required=true type="text" name="usuario" id="usuario" value="">
        <br>
        <label for="senha">Senha</label>
        <br>
        <input required=true type="password" name="senha" id="senha" value="">
        <br>
        <label for="email">Email</label>
        <br>
        <input required=true type="email" name="email" id="email" value="">
        <br>
        <label for="telefone">Telefone</label>
        <br>
        <input required=true type="tel" name="telefone" id="telefone" value="">
        <br>
        <input required=true type="checkbox" id="concordar" name="concordar" value="Concordo">
        <label for="concordar">O usuário concorda com o armazenamento de seus dados no sistema.</label>
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
        <label for="nome">Nome</label>
        <br>
        <input required=true type="text" name="nome" id="nome" value="<?=$linha['nome']?>">
        <br>
        <label for="usuario">Usuário</label>
        <br>
        <input required=true type="text" name="usuario" id="usuario" value="<?=$linha['usuario']?>">
        <br>
        <label for="senha">Senha<br>(mantenha vazio para não alterar)</label>
        <br>
        <input type="password" name="senha" id="senha" value="">
        <br>
        <label for="email">Email</label>
        <br>
        <input required=true type="email" name="email" id="email" value="<?=$linha['email']?>">
        <br>
        <label for="telefone">Telefone</label>
        <br>
        <input required=true type="tel" name="telefone" id="telefone" value="<?=$linha['telefone']?>">
        <br>
        <?php
                if ($_SESSION['admin'] == 1) {
        ?>
        <label for="ativado">Ativado</label>
        <br>
        <input required=true type="radio" name="ativado" id="ativado" value="1" <?php echo ($linha['ativado'] == 1) ? "checked" : ""; ?>>
        <label for="ativado">Sim</label>
        <input required=true type="radio" name="ativado" id="ativado" value="0" <?php echo ($linha['ativado'] == 0) ? "checked" : ""; ?>>
        <label for="ativado">Não</label>
        <br>
        <?php
                }
            }
        ?>
        <br>
        <button class="btn btn-primary" type="submit" name="action" value="editar">Editar</button>
    </fieldset>
</form>
<?php
    } elseif ($crud == "addVeiculo" || $crud == "subVeiculo") {
        $id = isset($_GET["id"]) ? $_GET["id"] : "";
?>
<form action="actions/<?=$selectedClass?>.action.php" method="post">
        <fieldset>
            <legend><?php echo ($crud == "addVeiculo") ? "Adicionar" : "Remover"; ?> Veículo</legend>
            <input require=true type="hidden" name="id" id="id" value="<?=$id?>">
            <?php
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM ".$selectedClass." WHERE id = ".$id." LIMIT 1");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <label for="veiculo">Veículo</label>
            <br>
            <select required=true name="veiculo" id="veiculo">
                <?php
                    if ($crud == "addVeiculo") {
                        $sub = $pdo->query("SELECT * from veiculo WHERE id not in (SELECT veiculo_id FROM cliente_has_veiculo WHERE cliente_id = ".$linha['id'].")");
                    } else {
                        $sub = $pdo->query("SELECT v.* FROM veiculo v JOIN cliente_has_veiculo c ON v.id = c.veiculo_id WHERE c.cliente_id = ".$linha['id']);
                    }
                    while ($subLinha = $sub->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option value="<?=$subLinha['id']?>"><?=$subLinha['placa']?></option>
                <?php
                    }
                ?>
            </select>
            <br>
            <?php
                }
            ?>
            <br>
            <button class="btn btn-primary" type="submit" name="action" value="<?=$crud?>"><?php echo ($crud == "addVeiculo") ? "Adicionar" : "Remover"; ?></button>
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
        <label for="consulta">Nome</label>
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
            <th scope="col">NOME</th>
            <th scope="col">USUÁRIO</th>
            <th scope="col">EMAIL</th>
            <th scope="col">TELEFONE</th>
            <th scope="col">ATIVADO</th>
            <th scope="col">VEÍCULOS</th>
            <?php
                if ($_SESSION['admin'] == 1) {
            ?>
            <th scope="col">EDITAR</th>
            <th scope="col">EXCLUIR</th>
            <?php
                }
            ?>
            <th scope="col">+VEÍCULO</th>
            <th scope="col">-VEÍCULO</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query("SELECT * FROM ".$selectedClass." WHERE nome LIKE '$consulta%'");
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $veiculos = array();
                $sub = $pdo->query("SELECT v.id FROM veiculo v JOIN cliente_has_veiculo c ON v.id = c.veiculo_id WHERE c.cliente_id = ".$linha['id']);
                while ($subLinha = $sub->fetch(PDO::FETCH_ASSOC)) {
                    $veiculos[] = $subLinha['id'];
                }
                $instance = new cliente($linha['id'],$linha['nome'],$linha['usuario'],$linha['senha'],$linha['ativado'],$linha['email'],$linha['telefone'],$veiculos);
        ?>
                <tr>
                    <th scope="row"><?php echo $instance->getId();?></th>
                    <td><?php echo $instance->getNome();?></td>
                    <td><?php echo $instance->getUsuario();?></td>
                    <td><?php echo $instance->getEmail();?></td>
                    <td><?php echo $instance->getTelefone();?></td>
                    <td><?php echo ($instance->getAtivado() == 1) ? "Sim" : "Não";?></td>
                    <td>
                        <?php
                            foreach ($veiculos as $veiculoId) {
                                $sub = $pdo->query("SELECT placa from veiculo where id = ".$veiculoId." LIMIT 1");
                                while ($subLinha = $sub->fetch(PDO::FETCH_ASSOC)) {
                                    echo $subLinha['placa'];
                                }
                                echo "<br>";
                            }
                        ?>
                    </td>
                    <?php
                        if ($_SESSION['admin'] == 1) {
                    ?>
                    <td><a class="btn btn-sm btn-secondary" href="index.php?selectedClass=<?=$selectedClass?>&crud=update&id=<?php echo $instance->getId();?>">Editar</a></td>
                    <td><a class="btn btn-sm btn-secondary" href="javascript:excluirRegistro('actions/<?=$selectedClass?>.action.php?action=excluir&id=<?php echo $instance->getId();?>')">Excluir</a></td>
                    <?php
                        }
                    ?>
                    <td><a class="btn btn-sm btn-secondary" href="index.php?selectedClass=<?=$selectedClass?>&crud=addVeiculo&id=<?php echo $instance->getId();?>">+Veículo</a></td>
                    <td><a class="btn btn-sm btn-secondary" href="index.php?selectedClass=<?=$selectedClass?>&crud=subVeiculo&id=<?php echo $instance->getId();?>">-Veículo</a></td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<?php
    }
?>