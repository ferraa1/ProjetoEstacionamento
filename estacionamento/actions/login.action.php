<?php

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    $action = isset($_GET['action']) ? $_GET['action'] : "";
    if ($action == "logoff") {
		session_start();
		session_destroy();
		header("location:../login.php");
	}

    $action = isset($_POST['action']) ? $_POST['action'] : "";
    if ($action == "login") {
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
        $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
        login($usuario, $senha);
    }

    function login($usuario, $senha){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM funcionario WHERE usuario = '$usuario'");
        $nome = "";
        $senha_bd = "";
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $nome = $linha['nome'];
            $senha_bd = $linha['senha'];
        }
        if (sha1($senha) == $senha_bd) {
            session_start();
			$_SESSION['usuario'] = $usuario;
			$_SESSION['nome'] = $nome;
			header("location:../index.php");	
		} else {
            header("location:../login.php?msg=Login Incorreto!");
        }
    }

?>