<?php
	require_once("bd.php");
	$pdo = BD::Conectar();

	include_once("funcoes.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistema de Gestão Comercial</title>
	<script type="text/javascript" src="_js/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="_js/funcoes.js"></script>


</head>
<body>
	<h2>Sistema de Gestão Comercial</h2>


	<?php
		include_once("menu.php");

		$arquivo =  @$_GET['modulo'] . '.php';

		if( file_exists($arquivo) )
		{
			include_once($arquivo);
		}
		else
		{
			include_once("home.php");	
		}

	?>


</body>
</html>