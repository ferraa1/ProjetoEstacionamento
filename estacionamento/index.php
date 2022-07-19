<!DOCTYPE html>
<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once "autoload.php";
    session_start();
    if (isset($_SESSION['tentativas'])) {
        if ($_SESSION['tentativas'] >= 10) {
            if (isset($_SESSION['desbloqueio'])) {
                if (strtotime(date('Y-m-d H:i:s')) < strtotime($_SESSION['desbloqueio'])) {
                    if ($_GET['msg'] != "blocked") {
                        header("location:index.php?msg=blocked");
                    }
                } else {
                    $_SESSION['tentativas'] = 0;
                    unset($_SESSION['desbloqueio']);
                    header("location:index.php");
                }
            } else {
                $_SESSION['desbloqueio'] = date('Y-m-d H:i:s', time()+(60*60));
                header("location:index.php?msg=blocked");
            }
        } elseif (isset($_SESSION['id'])) {
            $_SESSION['tentativas'] = 0;
        }
    } else {
        $_SESSION['tentativas'] = 0;
    }
    /*
    echo "\$_SESSION var_dump = ";
    var_dump($_SESSION);
    echo "<br>\$_GET var_dump = ";
    var_dump($_GET);
    echo "<br>\$_POST var_dump = ";
    var_dump($_POST);
    echo "<br><a href=\"test.php\">test.php</a>";
    */
?>
<html lang="pt-br">
<head>
    <?php include("head.php");?>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar exclusão?"))
                location.href = url; 
        }
        function sairOperacao(url,entrada,preco) {
            var saida = new Date();
            var entrada = new Date(Date.parse(entrada));
            var horas = Math.abs(saida - entrada) / (60*60*1000);
            var total = horas * preco;
            if (confirm("Finalizar operação?\nPreço: R$"+total.toFixed(2)))
                location.href = url; 
        }
    </script>
</head>
<body>
    <div class="container text-center my-5 p-5 rounded shadow-lg">
        <?php
            if (isset($_SESSION['id'])) {
                if (isset($_GET['selectedClass'])) {
                    $selectedClass = $_GET['selectedClass'];
                    $crud = isset($_GET["crud"]) ? $_GET["crud"] : "";
                    $title = ucfirst($selectedClass);
                    include "cruds/".$selectedClass.".crud.php";
                    #include "crud.php";
                    include "buttons.php";
                } else {
                    $title = "Menu";
                    include "menu.php";
                }
            } else {
                $title = "Estacionamento";
                $msg = isset($_GET['msg']) ? $_GET['msg'] : "";
                include "login.php";
            }
        ?>
    </div>
    <?php
        include("body.php");
    ?>
</body>
</html>