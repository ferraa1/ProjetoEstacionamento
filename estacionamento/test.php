<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once "autoload.php";

    $pdo = Conexao::getInstance();
    echo "VAGA<br>";
    $consulta = $pdo->query("SELECT * FROM vaga");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        var_dump($linha);
        echo "<br>";
    }
    echo "<br><br>";
    echo "PRECO_HORA<br>";
    $consulta = $pdo->query("SELECT * FROM preco_hora");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        var_dump($linha);
        echo "<br>";
    }
    echo "<br><br>";
    echo "FUNCIONARIO<br>";
    $consulta = $pdo->query("SELECT * FROM funcionario");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        var_dump($linha);
        echo "<br>";
    }
    echo "<br><br>";
    echo "CLIENTE<br>";
    $consulta = $pdo->query("SELECT * FROM cliente");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        var_dump($linha);
        echo "<br>";
    }
    echo "<br><br>";
    echo "VEICULO<br>";
    $consulta = $pdo->query("SELECT * FROM veiculo");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        var_dump($linha);
        echo "<br>";
    }
    echo "<br><br>";
    echo "OPERACAO<br>";
    $consulta = $pdo->query("SELECT * FROM operacao");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        var_dump($linha);
        echo "<br>";
    }
    echo "<br><br>";
    echo "CLIENTE_HAS_VEICULO<br>";
    $consulta = $pdo->query("SELECT * FROM cliente_has_veiculo");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        var_dump($linha);
        echo "<br>";
    }
    echo "<br><br>";
?>