<h1><?=$title?></h1>
<?php
    if ($crud == "create") {
?>
<form action="actions/<?=$selectedClass?>.action.php" method="post">
    <fieldset>
        <legend>Cadastrar <?php echo (ucfirst($selectedClass));?></legend>
        <input required=true type="hidden" name="funcionario" id="funcionario" value="<?=$_SESSION['id']?>">
        <?php
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query("SELECT id FROM preco_hora ORDER BY id DESC LIMIT 1");
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                echo "<input required=true type=\"hidden\" name=\"precoHora\" id=\"precoHora\" value=\"".$linha['id']."\">";
            }
        ?>
        <label for="vaga">Vaga</label>
        <br>
        <select required=true name="vaga" id="vaga">
            <?php
                $sub = $pdo->query("SELECT * FROM vaga WHERE id not in (SELECT vaga_id FROM operacao WHERE data_saida IS NULL)");
                while ($subLinha = $sub->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?=$subLinha['id']?>"><?=$subLinha['numero']?></option>
            <?php
                }
            ?>
        </select>
        <br>
        <label for="veiculo">Veículo</label>
        <br>
        <select required=true name="veiculo" id="veiculo">
            <?php
                $sub = $pdo->query("SELECT * FROM veiculo WHERE id not in (SELECT veiculo_id FROM operacao WHERE data_saida IS NULL)");
                while ($subLinha = $sub->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?=$subLinha['id']?>"><?=$subLinha['placa']?></option>
            <?php
                }
            ?>
        </select>
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
        <input required=true type="hidden" name="id" id="id" value="<?=$id?>">
        <input required=true type="hidden" name="funcionario" id="funcionario" value="<?=$_SESSION['id']?>">
        <?php
            $pdo = Conexao::getInstance();
            $consulta = $pdo->query("SELECT id FROM preco_hora ORDER BY id DESC LIMIT 1");
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                echo "<input required=true type=\"hidden\" name=\"precoHora\" id=\"precoHora\" value=\"".$linha['id']."\">";
            }
            $consulta = $pdo->query("SELECT * FROM ".$selectedClass." WHERE id = ".$id." LIMIT 1");
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <label for="vaga">Vaga</label>
        <br>
        <select required=true name="vaga" id="vaga">
            <?php
                $sub = $pdo->query("SELECT * FROM vaga");
                while ($subLinha = $sub->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?=$subLinha['id']?>" <?php echo ($subLinha['id'] == $linha['vaga_id']) ? "selected" : ""; ?>><?=$subLinha['numero']?></option>
            <?php
                }
            ?>
        </select>
        <br>
        <label for="veiculo">Veículo</label>
        <br>
        <select required=true name="veiculo" id="veiculo">
            <?php
                $sub = $pdo->query("SELECT * FROM veiculo");
                while ($subLinha = $sub->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <option value="<?=$subLinha['id']?>" <?php echo ($subLinha['id'] == $linha['veiculo_id']) ? "selected" : ""; ?>><?=$subLinha['placa']?></option>
            <?php
                }
            ?>
        </select>
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
        <legend>Consultar <?php echo (ucfirst($selectedClass));?></legend>
        <input required=true type="hidden" name="selectedClass" id="selectedClass" value="<?=$selectedClass?>">
        <label for="consulta">Data de entrada</label>
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
            <th scope="col">DATA DE ENTRADA</th>
            <th scope="col">DATA DE SAÍDA</th>
            <th scope="col">FUNCIONARIO</th>
            <th scope="col">VAGA</th>
            <th scope="col">PREÇO/HORA</th>
            <th scope="col">VEÍCULO</th>
            <th scope="col">PREÇO</th>
            <?php
                if ($_SESSION['admin'] == 1) {
            ?>
            <th scope="col">EDITAR</th>
            <th scope="col">EXCLUIR</th>
            <?php
                }
                if ($_SESSION['tipo'] == "funcionario") {
            ?>
            <th scope="col">SAIR</th>
            <?php
                }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php 
            $pdo = Conexao::getInstance();
            if ($_SESSION['tipo'] == "funcionario") {
                $consulta = $pdo->query("SELECT * FROM ".$selectedClass." WHERE data_entrada LIKE '$consulta%'");
            } else {
                $consulta = $pdo->query("SELECT * FROM ".$selectedClass." o JOIN veiculo v on o.veiculo_id = v.id JOIN cliente_has_veiculo chv on v.id = chv.veiculo_id WHERE chv.cliente_id = ".$_SESSION['id']." AND data_entrada LIKE '$consulta%'");
            }
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $sub = $pdo->query("SELECT * FROM funcionario WHERE id = ".$linha['funcionario_id']);
                $funcionario = null;
                while ($subLinha = $sub->fetch(PDO::FETCH_ASSOC)) {
                    $funcionario = new funcionario($subLinha['id'],$subLinha['nome'],$subLinha['usuario'],$subLinha['senha'],$subLinha['ativado'],$subLinha['admin']);
                }
                $sub = $pdo->query("SELECT * FROM vaga WHERE id = ".$linha['vaga_id']);
                $vaga = null;
                while ($subLinha = $sub->fetch(PDO::FETCH_ASSOC)) {
                    $vaga = new vaga($subLinha['id'],$subLinha['numero']);
                }
                $sub = $pdo->query("SELECT * FROM preco_hora WHERE id = ".$linha['preco_hora_id']);
                $precoHora = null;
                while ($subLinha = $sub->fetch(PDO::FETCH_ASSOC)) {
                    $precoHora = new precoHora($subLinha['id'],$subLinha['preco'],$subLinha['atualizado']);
                }
                $sub = $pdo->query("SELECT * FROM veiculo WHERE id = ".$linha['veiculo_id']);
                $veiculo = null;
                while ($subLinha = $sub->fetch(PDO::FETCH_ASSOC)) {
                    $veiculo = new veiculo($subLinha['id'],$subLinha['placa']);
                }
                $instance = new operacao($linha['id'],$linha['data_entrada'],$linha['data_saida'],$funcionario,$vaga,$precoHora,$veiculo);
        ?>
                <tr>
                    <th scope="row"><a href="qrcode.php?id=<?php echo $instance->getId();?>"><?php echo $instance->getId();?></a></th>
                    <td><?php echo $instance->getDataEntrada();?></td>
                    <td><?php echo $instance->getDataSaida();?></td>
                    <td><?php echo $instance->getFuncionario()->getNome();?></td>
                    <td><?php echo $instance->getVaga()->getNumero();?></td>
                    <td><?php echo "R$".number_format($instance->getPrecoHora()->getPreco(),2);?></td>
                    <td><?php echo $instance->getVeiculo()->getPlaca();?></td>
                    <td><?php echo "R$".number_format($instance->calcPreco(), 2);?></td>
                    <?php
                        if ($_SESSION['admin'] == 1) {
                    ?>
                    <td><a class="btn btn-sm btn-secondary" href="index.php?selectedClass=<?=$selectedClass?>&crud=update&id=<?php echo $instance->getId();?>">Editar</a></td>
                    <td><a class="btn btn-sm btn-secondary" href="javascript:excluirRegistro('actions/<?=$selectedClass?>.action.php?action=excluir&id=<?php echo $instance->getId();?>')">Excluir</a></td>
                    <?php
                        }
                        if ($_SESSION['tipo'] == "funcionario") {
                    ?>
                    <td><a class="btn btn-sm btn-secondary <?php echo ($instance->getDataSaida() == null) ? "" : "disabled"; ?>" href="javascript:sairOperacao('actions/<?=$selectedClass?>.action.php?action=sair&id=<?php echo $instance->getId();?>',<?php echo "'".$instance->getDataEntrada()."',".$instance->getPrecoHora()->getPreco();?>)">Sair</a></td>
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