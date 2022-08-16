<?php
	require_once("bd.php");
	$pdo = BD::Conectar();

	$acao = @$_POST['acao'];
	$cod_cidade = @$_POST['cod_cidade'];

	//-----------------------------------------------
	if( $acao == 'incluir' )
	{
		$sql = " insert into cidades (nome, uf) 
				 values (:nome, :uf)
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":nome" , $_POST['nome']);
		$cmd->bindValue(":uf" , $_POST['uf']);

	} // incluir
	else 
	//-----------------------------------------------
	if( $acao == 'alterar' )
	{
		$sql = " update cidades set 
				 	nome = :nome,
				 	uf = :uf
				 where cod_cidade = :cod_cidade
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":nome" , $_POST['nome']);
		$cmd->bindValue(":uf" , $_POST['uf']);
		$cmd->bindValue(":cod_cidade" , $_POST['cod_cidade']);
	} // alterar
	else 
	//-----------------------------------------------
	if( $acao == 'excluir' )
	{
		$sql = " delete from cidades
				 where cod_cidade = :cod_cidade
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_cidade" , $_POST['cod_cidade']);

	} // excluir
	else
	{
		die("Ação inválida!");
	}


	if( $cmd->execute() )
	{
		// redireciona para outra página
		header("Location: index.php?modulo=cidades");
	}
	else
	{
		header("Location: index.php?modulo=cidades&erro=Não foi possível efetuar a operação com o Banco de Dados !");	
	}





?>