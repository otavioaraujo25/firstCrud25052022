<?php
	require_once("bd.php");
	$pdo = BD::Conectar();

	include_once("funcoes.php");

	$acao = @$_POST['acao'];
	$cod_ingrediente = @$_POST['cod_ingrediente'];

	//-----------------------------------------------
	if( $acao == 'incluir' )
	{
		$sql = " insert into ingredientes (descricao, valor_unitario, cod_unidade) 
				 values (:descricao, :valor_unitario, :cod_unidade)
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":descricao" , $_POST['descricao']);
		$cmd->bindValue(":cod_unidade" , $_POST['cod_unidade']);
		$cmd->bindValue(":valor_unitario" , floatUSA($_POST['valor_unitario']) );

	} // incluir
	else 
	//-----------------------------------------------
	if( $acao == 'alterar' )
	{
		$sql = " update ingredientes set 
				 	descricao = :descricao,
				 	valor_unitario = :valor_unitario,
				 	cod_unidade = :cod_unidade
				 where cod_ingrediente = :cod_ingrediente
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":descricao" , $_POST['descricao']);
		$cmd->bindValue(":cod_unidade" , $_POST['cod_unidade']);
		$cmd->bindValue(":valor_unitario" , floatUSA($_POST['valor_unitario']) );
		$cmd->bindValue(":cod_ingrediente" , $_POST['cod_ingrediente']);
	} // alterar
	else 
	//-----------------------------------------------
	if( $acao == 'excluir' )
	{
		$sql = " delete from ingredientes
				 where cod_ingrediente = :cod_ingrediente
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_ingrediente" , $_POST['cod_ingrediente']);

	} // excluir
	else
	{
		die("Ação inválida!");
	}


	if( $cmd->execute() )
	{
		// redireciona para outra página
		header("Location: index.php?modulo=ingredientes");
	}
	else
	{
		header("Location: index.php?modulo=ingredientes&erro=Não foi possível efetuar a operação com o Banco de Dados !");	
	}





?>