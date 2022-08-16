<?php
	require_once("bd.php");
	$pdo = BD::Conectar();

	$acao = @$_POST['acao'];
	$cod_prato = @$_POST['cod_prato'];

	//-----------------------------------------------
	if( $acao == 'incluir' )
	{
		$sql = " insert into pratos (descricao, valor_unitario, cod_categoria) 
				 values (:descricao, :valor_unitario, :cod_categoria)
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":descricao" , $_POST['descricao']);
		$cmd->bindValue(":valor_unitario" , $_POST['valor_unitario']);
		$cmd->bindValue(":cod_categoria" , $_POST['cod_categoria']);

	} // incluir
	else 
	//-----------------------------------------------
	if( $acao == 'alterar' )
	{
		$sql = " update pratos set 
				 	descricao = :descricao
				 	valor_unitario = :valor_unitario
				 	cod_categoria = :cod_categoria
				 where cod_prato = :cod_prato
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":descricao" , $_POST['descricao']);
		$cmd->bindValue(":valor_unitario" , $_POST['valor_unitario']);
		$cmd->bindValue(":cod_categoria" , $_POST['cod_categoria']);
		$cmd->bindValue(":cod_prato" , $_POST['cod_prato']);
	} // alterar
	else 
	//-----------------------------------------------
	if( $acao == 'excluir' )
	{
		$sql = " delete from pratos
				 where cod_prato = :cod_prato
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_prato" , $_POST['cod_prato']);

	} // excluir
	else
	{
		die("Ação inválida!");
	}


	if( $cmd->execute() )
	{
		// redireciona para outra página
		header("Location: index.php?modulo=pratos");
	}
	else
	{
		header("Location: index.php?modulo=pratos&erro=Não foi possível efetuar a operação com o Banco de Dados !");	
	}





?>