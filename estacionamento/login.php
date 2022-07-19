<h1><?=$title?></h1>
<?php
	if ($_SESSION['tentativas'] < 10) {
?>
<form action="actions/login.action.php" method="post">
	<fieldset>
		<legend>Login</legend>

		<label for="usuario">Usuário</label>
		<br>
		<input required=true type="text" name="usuario" id="usuario" value="">
		<br>
		<label for="senha">Senha</label>
		<br>
		<input required=true type="password" name="senha" id="senha" value="">
		<br>
        <label for="tipo">Tipo de Usuário</label>
        <br>
        <input required=true type="radio" name="tipo" id="tipo" value="funcionario" checked>
        <label for="tipo">Funcionário</label>
        <input required=true type="radio" name="tipo" id="tipo" value="cliente">
        <label for="tipo">Cliente</label>
		<br>
		<br>
		<button class="btn btn-primary" type="submit" name="action" id="action" value="login">Entrar</button>
	</fieldset>
</form>
<?php
	}
	if ($msg == "error") {
		echo "<p class=\"h1 fw-bold text-white bg-danger mt-5 p-2\">LOGIN INCORRETO!</p>";
	} elseif ($msg == "deactivated") {
		echo "<p class=\"h1 fw-bold text-white bg-danger mt-5 p-2\">USUÁRIO DESATIVADO!</p>";
	} elseif ($msg == "blocked") {
		echo "<p class=\"h1 fw-bold text-white bg-danger mt-5 p-2\">MUITAS TENTATIVAS INCORRETAS, TENTE NOVAMENTE EM: ".$_SESSION['desbloqueio']."!</p>";
	}
?>