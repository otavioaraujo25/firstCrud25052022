<?php
	require_once("bd.php");
	$pdo = BD::Conectar();

	$acao = @$_POST['acao'];
	$cod_unidade = @$_POST['cod_unidade'];

	//-----------------------------------------------
	if( $acao == 'incluir' )
	{
		$sql = " insert into unidades (descricao, sigla) 
				 values (:descricao, :sigla)
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":descricao" , $_POST['descricao']);
		$cmd->bindValue(":sigla" , $_POST['sigla']);

	} // incluir
	else 
	//-----------------------------------------------
	if( $acao == 'alterar' )
	{
		$sql = " update unidades set 
				 	descricao = :descricao,
				 	sigla = :sigla
				 where cod_unidade = :cod_unidade
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":descricao" , $_POST['descricao']);
		$cmd->bindValue(":sigla" , $_POST['sigla']);
		$cmd->bindValue(":cod_unidade" , $_POST['cod_unidade']);
	} // alterar
	else 
	//-----------------------------------------------
	if( $acao == 'excluir' )
	{
		$sql = " delete from unidades
				 where cod_unidade = :cod_unidade
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_unidade" , $_POST['cod_unidade']);

	} // excluir
	else
	{
		die("Ação inválida!");
	}


	if( $cmd->execute() )
	{
		// redireciona para outra página
		header("Location: index.php?modulo=unidades");
	}
	else
	{
		header("Location: index.php?modulo=unidades&erro=Não foi possível efetuar a operação com o Banco de Dados !");	
	}





?>