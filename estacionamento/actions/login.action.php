<?php

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    $action = isset($_GET['action']) ? $_GET['action'] : "";
    if ($action == "logoff") {
		session_start();
		session_destroy();
		header("location:../index.php");
	}

    $action = isset($_POST['action']) ? $_POST['action'] : "";
    if ($action == "login") {
        session_start();
        if ($_SESSION['tentativas'] < 10) {
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
            $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
            $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "";
            if ($tipo == "funcionario") {
                loginFuncionario($usuario, $senha);
            } else {
                loginCliente($usuario, $senha);
            }
        } else {
            header("location:../index.php?msg=blocked");
        }
    }

    function loginFuncionario($usuario, $senha){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM funcionario WHERE usuario = '$usuario'");
        $id = "";
        $nome = "";
        $senha_bd = "";
        $admin = 0;
        $ativado = 0;
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $id = $linha['id'];
            $nome = $linha['nome'];
            $senha_bd = $linha['senha'];
            $ativado = $linha['ativado'];
            $admin = $linha['admin'];
        }
        if (sha1($senha) == $senha_bd) {
            if ($ativado == 1) {
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['tipo'] = "funcionario";
                $_SESSION['nome'] = $nome;
                $_SESSION['admin'] = $admin;
                header("location:../index.php");
            } else {
                header("location:../index.php?msg=deactivated");
            }
        } else {
            $_SESSION['tentativas'] += 1;
            header("location:../index.php?msg=error");
        }
    }

    function loginCliente($usuario, $senha){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM cliente WHERE usuario = '$usuario'");
        $id = "";
        $nome = "";
        $senha_bd = "";
        $ativado = 0;
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $id = $linha['id'];
            $nome = $linha['nome'];
            $senha_bd = $linha['senha'];
            $ativado = $linha['ativado'];
        }
        if (sha1($senha) == $senha_bd) {
            if ($ativado == 1) {
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['tipo'] = "cliente";
                $_SESSION['nome'] = $nome;
                $_SESSION['admin'] = $admin;
                header("location:../index.php");
            } else {
                header("location:../index.php?msg=deactivated");
            }
        } else {
            $_SESSION['tentativas'] += 1;
            header("location:../index.php?msg=error");
        }
    }

?>