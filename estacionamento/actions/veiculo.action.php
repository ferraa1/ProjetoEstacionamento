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
        $stmt = $pdo->prepare('INSERT INTO veiculo (placa) VALUES(:placa)');
        $stmt->bindParam(':placa', $placa, PDO::PARAM_STR);
        $placa = $dados['placa'];
        $stmt->execute();
        header("location:../index.php?selectedClass=veiculo");
    }

    function editar($id){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE veiculo SET placa = :placa WHERE id = :id');
        $stmt->bindParam(':placa', $placa, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $placa = $dados['placa'];
        $id = $dados['id'];
        $stmt->execute();
        header("location:../index.php?selectedClass=veiculo");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from veiculo WHERE id = :id');
        $stmt->bindParam(':id', $idD, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();
        header("location:../index.php?selectedClass=veiculo");
    }

    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM veiculo WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['placa'] = $linha['placa'];
        }
        return $dados;
    }

    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['placa'] = $_POST['placa'];
        return $dados;
    }

?>