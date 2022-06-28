<!DOCTYPE html>
<?php
    session_start();

    if (isset($_SESSION['usuario'])) {
        header("location:index.php");
	}

    $title = "Login - Estacionamento";
    $msg = isset($_GET['msg']) ? $_GET['msg'] : "";
?>
<html lang="pt-br">
<head>
    <?php include("head.php");?>
</head>
<body>
	<div class="text-center m-5 p-5 rounded shadow-lg">
    	<h1><?=$title?></h1>
    	<form action="actions/login.action.php" method="post">
			<fieldset>
				<legend>Login - Funcionario</legend>
				<label for="usuario">Usuário</label>
				<br>
				<input required=true type="text" name="usuario" id="usuario" value="">
				<br>
				<label for="senha">Senha</label>
				<br>
				<input required=true type="password" name="senha" id="senha" value="">
				<br>
				<br>
				<button class="btn btn-lg btn-primary" type="submit" name="action" id="action" value="login">Entrar</button>
			</fieldset>
		</form>
		<?php
		if (isset($_GET['msg'])) {
			echo "<p class=\"h1 fw-bold text-white bg-danger mt-5 p-2\">".$msg."</p>";
		}
		?>
	</div>
	
    <?php include("body.php");?>
</body>
</html>