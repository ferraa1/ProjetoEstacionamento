<h1><?=$title?></h1>
<h2>Olá, <?=$_SESSION['nome']?>.</h2>
<br>
<div class="btn-group">
    <?php
        if ($_SESSION['tipo'] == "funcionario") {
    ?>
    <a class="btn btn-primary" href="index.php?selectedClass=vaga">Vagas</a>
    <a class="btn btn-primary" href="index.php?selectedClass=precoHora">Preço/Hora</a>
    <a class="btn btn-primary" href="index.php?selectedClass=funcionario">Funcionários</a>
    <a class="btn btn-primary" href="index.php?selectedClass=cliente">Clientes</a>
    <a class="btn btn-primary" href="index.php?selectedClass=veiculo">Veículos</a>
    <?php
        }
    ?>
    <a class="btn btn-primary" href="index.php?selectedClass=operacao">Operações</a>
    <a class="btn btn-primary" role="button" href="actions/login.action.php?action=logoff">Sair</a>
</div>