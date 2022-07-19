<?php
    
    include "validate.php";
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    $action = isset($_GET['action']) ? $_GET['action'] : "";
    if ($action == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        excluir($id);
    }

    $action = isset($_POST['action']) ? $_POST['action'] : "";
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    if ($action == "cadastrar"){
        inserir();
    } elseif ($action == "editar") {
        editar($id);
    }

    function inserir(){
        $dados = dadosForm();
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO funcionario (nome,usuario,senha,admin,ativado) VALUES(:nome,:usuario,:senha,:admin,:ativado)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':admin', $admin, PDO::PARAM_STR);
        $stmt->bindParam(':ativado', $ativado, PDO::PARAM_STR);
        $nome = $dados['nome'];
        $usuario = $dados['usuario'];
        $senha = $dados['senha'];
        $admin = $dados['admin'];
        $ativado = $dados['ativado'];
        $stmt->execute();
        header("location:../index.php?selectedClass=funcionario");
    }

    function editar($id){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE funcionario SET nome = :nome, usuario = :usuario, senha = :senha, admin = :admin, ativado = :ativado WHERE id = :id');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':admin', $admin, PDO::PARAM_STR);
        $stmt->bindParam(':ativado', $ativado, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $nome = $dados['nome'];
        $usuario = $dados['usuario'];
        $senha = $dados['senha'];
        if ($senha == "") {
            $consulta = $pdo->query("SELECT * FROM funcionario WHERE id = ".$id." LIMIT 1");
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $senha = $linha['senha'];
            }
        }
        $admin = $dados['admin'];
        $ativado = $dados['ativado'];
        $id = $dados['id'];
        $stmt->execute();
        header("location:../index.php?selectedClass=funcionario");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from funcionario WHERE id = :id');
        $stmt->bindParam(':id', $idD, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();
        header("location:../index.php?selectedClass=funcionario");
    }

    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM funcionario WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['nome'] = $linha['nome'];
            $dados['usuario'] = $linha['usuario'];
            $dados['admin'] = $linha['admin'];
            $dados['ativado'] = $linha['ativado'];
        }
        return $dados;
    }

    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['nome'] = $_POST['nome'];
        $dados['usuario'] = $_POST['usuario'];
        $dados['senha'] = (isset($_POST['senha']) && $_POST['senha'] != "") ? sha1($_POST['senha']) : "";
        $dados['admin'] = $_POST['admin'];
        $dados['ativado'] = isset($_POST['ativado']) ? $_POST['ativado'] : 1;
        return $dados;
    }

?>