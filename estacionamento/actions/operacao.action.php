<?php
    
    include "validate.php";
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    $action = isset($_GET['action']) ? $_GET['action'] : "";
    if ($action == "excluir"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        excluir($id);
    } elseif ($action == "sair"){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        sair($id);
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
        $stmt = $pdo->prepare('INSERT INTO operacao (data_entrada,funcionario_id,vaga_id,preco_hora_id,veiculo_id) VALUES(:dataEntrada,:funcionario,:vaga,:precoHora,:veiculo)');
        $stmt->bindParam(':dataEntrada', $dataEntrada, PDO::PARAM_STR);
        $stmt->bindParam(':funcionario', $funcionario, PDO::PARAM_STR);
        $stmt->bindParam(':vaga', $vaga, PDO::PARAM_STR);
        $stmt->bindParam(':precoHora', $precoHora, PDO::PARAM_STR);
        $stmt->bindParam(':veiculo', $veiculo, PDO::PARAM_STR);
        $dataEntrada = $dados['dataEntrada'];
        $funcionario = $dados['funcionario'];
        $vaga = $dados['vaga'];
        $precoHora = $dados['precoHora'];
        $veiculo = $dados['veiculo'];
        $stmt->execute();
        header("location:../index.php?selectedClass=operacao");
    }

    function editar($id){
        $dados = dadosForm();

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE operacao SET funcionario_id = :funcionario, vaga_id = :vaga, preco_hora_id = :precoHora, veiculo_id = :veiculo WHERE id = :id');
        $stmt->bindParam(':funcionario', $funcionario, PDO::PARAM_STR);
        $stmt->bindParam(':vaga', $vaga, PDO::PARAM_STR);
        $stmt->bindParam(':precoHora', $precoHora, PDO::PARAM_STR);
        $stmt->bindParam(':veiculo', $veiculo, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $funcionario = $dados['funcionario'];
        $vaga = $dados['vaga'];
        $precoHora = $dados['precoHora'];
        $veiculo = $dados['veiculo'];
        $id = $dados['id'];
        $stmt->execute();
        header("location:../index.php?selectedClass=operacao");
    }

    function excluir($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from operacao WHERE id = :id');
        $stmt->bindParam(':id', $idD, PDO::PARAM_INT);
        $idD = $id;
        $stmt->execute();
        header("location:../index.php?selectedClass=operacao");
    }

    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM operacao WHERE id = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['dataEntrada'] = $linha['data_entrada'];
            $dados['dataSaida'] = $linha['data_saida'];
            $dados['funcionario'] = $linha['funcionario_id'];
            $dados['vaga'] = $linha['vaga_id'];
            $dados['precoHora'] = $linha['preco_hora_id'];
            $dados['veiculo'] = $linha['veiculo_id'];
        }
        return $dados;
    }

    function dadosForm(){
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['dataEntrada'] = date('Y-m-d H:i:s');
        $dados['funcionario'] = $_POST['funcionario'];
        $dados['vaga'] = $_POST['vaga'];
        $dados['precoHora'] = $_POST['precoHora'];
        $dados['veiculo'] = $_POST['veiculo'];
        return $dados;
    }

    function sair($id){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE operacao SET data_saida = :dataSaida WHERE id = :id');
        $stmt->bindParam(':dataSaida', $dataSaida, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $dataSaida = date('Y-m-d H:i:s');
        $stmt->execute();
        header("location:../index.php?selectedClass=operacao");
    }

?>