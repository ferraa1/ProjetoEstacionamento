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
    } elseif ($action == "addVeiculo") {
        addVeiculo($id);
    } elseif ($action == "subVeiculo") {
        subVeiculo($id);
    }

    function inserir(){
        $dados = dadosForm();
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO cliente (nome,usuario,senha,email,telefone,ativado) VALUES(:nome,:usuario,:senha,:email,:telefone,:ativado)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindParam(':ativado', $ativado, PDO::PARAM_STR);
        $nome = $dados['nome'];
        $usuario = $dados['usuario'];
        $senha = $dados['senha'];
        $email = $dados['email'];
        $telefone = $dados['telefone'];
        $ativado = $dados['ativado'];
        $stmt->execute();
        header("location:../index.php?selectedClass=cliente");
    }

    function editar($id){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE cliente SET nome = :nome, usuario = :usuario, senha = :senha, email = :email, telefone = :telefone, ativado = :ativado WHERE id = :id');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindParam(':ativado', $ativado, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $nome = $dados['nome'];
        $usuario = $dados['usuario'];
        $senha = $dados['senha'];
        if ($senha == "") {
            $consulta = $pdo->query("SELECT * FROM cliente WHERE id = ".$id." LIMIT 1");
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $senha = $linha['senha'];
            }
        }
        $email = $dados['email'];
        $telefone = $dados['telefone'];
        $ativado = $dados['ativado'];
        $id = $dados['id'];
        $stmt->execute();
        header("location:../index.php?selectedClass=cliente");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from cliente WHERE id = :id');
        $stmt->bindParam(':id', $idD, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();
        header("location:../index.php?selectedClass=cliente");
    }

    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM cliente WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['nome'] = $linha['nome'];
            $dados['usuario'] = $linha['usuario'];
            $dados['email'] = $linha['email'];
            $dados['telefone'] = $linha['telefone'];
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
        $dados['email'] = $_POST['email'];
        $dados['telefone'] = $_POST['telefone'];
        $dados['ativado'] = isset($_POST['ativado']) ? $_POST['ativado'] : 1;
        return $dados;
    }

    function addVeiculo($id) {
        $idVeiculo = isset($_POST['veiculo']) ? $_POST['veiculo'] : 0;

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO cliente_has_veiculo (cliente_id,veiculo_id) VALUES(:clienteId,:veiculoId)');
        $stmt->bindParam(':clienteId', $idD, PDO::PARAM_INT);
        $stmt->bindParam(':veiculoId', $idVeiculoD, PDO::PARAM_INT);
        $idD = $id;
        $idVeiculoD = $idVeiculo;
        $stmt->execute();
        header("location:../index.php?selectedClass=cliente");
    }

    function subVeiculo($id) {
        $idVeiculo = isset($_POST['veiculo']) ? $_POST['veiculo'] : 0;

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from cliente_has_veiculo WHERE cliente_id = :clienteId AND veiculo_id = :veiculoId');
        $stmt->bindParam(':clienteId', $idD, PDO::PARAM_INT);
        $stmt->bindParam(':veiculoId', $idVeiculoD, PDO::PARAM_INT);
        $idD = $id;
        $idVeiculoD = $idVeiculo;
        $stmt->execute();
        header("location:../index.php?selectedClass=cliente");
    }

?>