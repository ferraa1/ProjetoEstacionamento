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
        $stmt = $pdo->prepare('INSERT INTO vaga (numero) VALUES(:numero)');
        $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
        $numero = $dados['numero'];
        $stmt->execute();
        header("location:../index.php?selectedClass=vaga");
    }

    function editar($id){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE vaga SET numero = :numero WHERE id = :id');
        $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $numero = $dados['numero'];
        $id = $dados['id'];
        $stmt->execute();
        header("location:../index.php?selectedClass=vaga");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from vaga WHERE id = :id');
        $stmt->bindParam(':id', $idD, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();
        header("location:../index.php?selectedClass=vaga");
    }

    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM vaga WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['numero'] = $linha['numero'];
        }
        return $dados;
    }

    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['numero'] = $_POST['numero'];
        return $dados;
    }

?>