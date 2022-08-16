<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PDO : Inicio</title>
</head>
<body>
	<h2>Hello World com PDO</h2>

<?php

	// fazendo a conexão com o BD MySQL 
	//$pdo = new PDO("mysql:host=localhost;dbname=baseteste2021", "root", "vertrigo"); 

	// Exemplo de conexão com MS SQL Server no Linux
	// new PDO('dblib:host='.$this->servidor.';dbname='.$this->base,$this->usuario,$this->senha);


	/****************************************************************
	// Fazendo a conexão com o BD MS SQL Server no Windows
	// PDO(string de conexão, usuário, senha)
	$pdo = new PDO("sqlsrv:Server=.\SQLEXPRESS;Database=restaurante2022", 
					"sa", 
					"unifai2022");
	/****************************************************************/

	require_once("bd.php");

	$pdo = BD::Conectar();


	/****************************************************************

	// Enviando um comando select sql para o MS SQL Server
	$r = $pdo->query("select * from pratos order by descricao");

	// Obtendo UM registro da consulta em forma de objeto
	// Se chegou ao final da consulta, o comando fetch retorna false
	$dados = $r->fetch(PDO::FETCH_OBJ);

	echo '<p>';
	echo "Código do Prato: " . $dados->cod_prato;
	echo "<br>Descrição do Prato: " . $dados->descricao;
	echo "<br>Valor Unitário: " . $dados->valor_unitario;
	echo '</p>';

	$dados = $r->fetch(PDO::FETCH_OBJ);

	echo '<p>';
	echo "Código do Prato: " . $dados->cod_prato;
	echo "<br>Descrição do Prato: " . $dados->descricao;
	echo "<br>Valor Unitário: " . $dados->valor_unitario;
	echo '</p>';
	/****************************************************************/


	// automatizando a listagem completa

	/****************************************************************
	// Exemplo 1

	// Enviando um comando select sql para o MS SQL Server
	$r = $pdo->query("select * from pratos order by descricao");

	$dados = $r->fetch(PDO::FETCH_OBJ);

	while( $dados )
	{
		echo '<p>';
		echo "Código do Prato: " . $dados->cod_prato;
		echo "<br>Descrição do Prato: " . $dados->descricao;
		echo "<br>Valor Unitário: " . $dados->valor_unitario;
		echo '</p>';
	
		$dados = $r->fetch(PDO::FETCH_OBJ);

	} // while...
	/****************************************************************/	

	/****************************************************************
	// Exemplo 2

	// Enviando um comando select sql para o MS SQL Server
	$r = $pdo->query("select * from pratos order by descricao");

	while( $dados = $r->fetch(PDO::FETCH_OBJ) )
	{
		echo '<p>';
		echo "Código do Prato: " . $dados->cod_prato;
		echo "<br>Descrição do Prato: " . $dados->descricao;
		echo "<br>Valor Unitário: " . $dados->valor_unitario;
		echo '</p>';
	} // while...
	/****************************************************************/	

	/****************************************************************
	// Exemplo 3 : Colocando em tabela HTML

	// Enviando um comando select sql para o MS SQL Server
	$r = $pdo->query("select * from pratos order by descricao");

	echo "<h3>CADASTRO DE PRATOS</h3>";
	echo '<table width="100%" cellpadding="5">
			<tr bgcolor="#cbcbcb" >
				<td align="center">Código</td>
				<td>Descrição</td>
				<td align="center">Valor Unitário (R$)</td>
				<td align="center">Opções</td>
			</tr>
		 ';

	while( $dados = $r->fetch(PDO::FETCH_OBJ) )
	{
		echo '
				<tr bgcolor="#efefef">
					<td align="center">'.$dados->cod_prato.'</td>
					<td>'.$dados->descricao.'</td>
					<td align="right">'.number_format($dados->valor_unitario,2,',','.').'</td>
					<td align="center">Alterar &nbsp;&nbsp; Excluir</td>
				</tr>
			 ';

	} // while...

	echo '</table>';
	/****************************************************************/	

	/****************************************************************
	// Exemplo 4 : Utilizando o retorno dos registros em forma de vetores

	// Enviando um comando select sql para o MS SQL Server
	$r = $pdo->query("select * from pratos order by descricao");

	echo "<h3>CADASTRO DE PRATOS</h3>";
	echo '<table width="100%" cellpadding="5">
			<tr bgcolor="#cbcbcb" >
				<td align="center">Código</td>
				<td>Descrição</td>
				<td align="center">Valor Unitário (R$)</td>
				<td align="center">Opções</td>
			</tr>
		 ';

	while( $dados = $r->fetch(PDO::FETCH_ASSOC) )
	{
		echo '
				<tr bgcolor="#efefef">
					<td align="center">'.$dados['cod_prato'].'</td>
					<td>'.$dados['descricao'].'</td>
					<td align="right">'.number_format($dados['valor_unitario'],2,',','.').'</td>
					<td align="center">Alterar &nbsp;&nbsp; Excluir</td>
				</tr>
			 ';

	} // while...

	echo '</table>';
	/****************************************************************/	


	/****************************************************************/
	// Exemplo 5 : Utilizando o método prepare
	// Observação: O método query executa apenas Select. 
	//			   Já o método prepare executa tanto select quanto, insert, update, delete 

	
	$r = $pdo->prepare("select * from pratos order by descricao");
	$r->execute();


	echo "<h3>CADASTRO DE PRATOS</h3>";
	echo '<table width="100%" cellpadding="5">
			<tr bgcolor="#cbcbcb" >
				<td align="center">Código</td>
				<td>Descrição</td>
				<td align="center">Valor Unitário (R$)</td>
				<td align="center">Opções</td>
			</tr>
		 ';

	while( $dados = $r->fetch(PDO::FETCH_ASSOC) )
	{
		echo '
				<tr bgcolor="#efefef">
					<td align="center">'.$dados['cod_prato'].'</td>
					<td>'.$dados['descricao'].'</td>
					<td align="right">'.number_format($dados['valor_unitario'],2,',','.').'</td>
					<td align="center">Alterar &nbsp;&nbsp; Excluir</td>
				</tr>
			 ';

	} // while...

	echo '</table>';
	/****************************************************************/	


?>

</body>
</html>