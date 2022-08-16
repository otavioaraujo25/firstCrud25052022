<?php
	require_once("bd.php");
	$pdo = BD::Conectar();

	$acao = @$_POST['acao'];
	$cod_categoria = @$_POST['cod_categoria'];

	//-----------------------------------------------
	if( $acao == 'incluir' )
	{
		$sql = " insert into categorias (descricao) 
				 values (:descricao)
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":descricao" , $_POST['descricao']);
	
	} // incluir
	else 
	//-----------------------------------------------
	if( $acao == 'alterar' )
	{
		$sql = " update categorias set 
				 	descricao = :descricao
				 where cod_categoria = :cod_categoria
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":descricao" , $_POST['descricao']);
		
		$cmd->bindValue(":cod_categoria" , $_POST['cod_categoria']);
	} // alterar
	else 
	//-----------------------------------------------
	if( $acao == 'excluir' )
	{
		$sql = " delete from categorias
				 where cod_categoria = :cod_categoria
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_categoria" , $_POST['cod_categoria']);

	} // excluir
	else
	{
		die("Ação inválida!");
	}


	if( $cmd->execute() )
	{
		// redireciona para outra página
		header("Location: index.php?modulo=categorias");
	}
	else
	{
		header("Location: index.php?modulo=categorias&erro=Não foi possível efetuar a operação com o Banco de Dados !");	
	}





?>