<?php

	// Fazendo a conexão com o Banco de Dados	
	require_once("bd.php");
	$pdo = BD::Conectar();

	include_once("funcoes.php");

	$acao = @$_POST['acao'];
	$cod_cliente = @$_POST['cod_cliente'];

	//--------------------------------------------------------------------
	if( $acao == 'incluir' )
	{

 

		$sql = " insert into clientes 	
					(nome,endereco,bairro,cod_cidade,cep,cpf,rg,telefone,email) 
				 values 
				 	(:nome,:endereco,:bairro,:cod_cidade,:cep,:cpf,:rg,:telefone,:email) 
				";

		//die($sql);

		$cmd = $pdo->prepare($sql);

	} // incluir
	else
	//--------------------------------------------------------------------
	if( $acao == 'alterar' )
	{
		$sql = " update clientes set
						nome                     = :nome                   , 
						cpf                      = :cpf                    ,
						rg                       = :rg                     ,
						telefone                 = :telefone               ,
						email                    = :email                  ,
						endereco                 = :endereco                    ,
						bairro                   = :bairro                 ,
						cod_cidade               = :cod_cidade             ,
						cep                      = :cep                    

				 where cod_cliente = :cod_cliente
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_cliente", $cod_cliente );

	} // alterar
	else
	//--------------------------------------------------------------------
	if( $acao == 'excluir' )
	{
		$sql = " delete from clientes where cod_cliente = :cod_cliente ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_cliente", $cod_cliente );

	} // excluir
	else
	{
		echo '<script language="javascript">
					document.location = "index.php?modulo=clientes&erro=Ação inválida !!!";
			  </script>
			 ';
	}

	//--------------------------------------------------------------------
	if( $acao == 'incluir' or $acao == 'alterar' )
	{

		$nome                     = $_POST['nome'];                    
		$cpf                      = $_POST['cpf'];
		$rg                       = $_POST['rg'];                     
		//$sexo                     = @$_POST['sexo'];                   
		//$data_nascimento          = trim($_POST['data_nascimento']) == "" ? null : dataUSA($_POST['data_nascimento']);     
		//$renda_familiar           = trim($_POST['renda_familiar']) == "" ? null : floatUSA($_POST['renda_familiar']);         
		$telefone                 = $_POST['telefone'];               
		$email                    = $_POST['email'];                  
		$endereco                 = $_POST['endereco'];                    
		$bairro                   = $_POST['bairro'];   
		$cod_cidade               = $_POST['cod_cidade'] == '0' ? null : $_POST['cod_cidade'];
		$cep                      = $_POST['cep'];                    
		//$conheceu_por_jornais     = @$_POST['conheceu_por_jornais'];   
		//$conheceu_por_internet    = @$_POST['conheceu_por_internet'];  
		//$conheceu_por_outro       = @$_POST['conheceu_por_outro'];     

		$cmd->bindValue(":nome"                     , $nome);                    
		$cmd->bindValue(":cpf"                      , $cpf);
		$cmd->bindValue(":rg"                       , $rg);                     
		$cmd->bindValue(":telefone"                 , $telefone);               
		$cmd->bindValue(":email"                    , $email);                  
		$cmd->bindValue(":endereco"                 , $endereco);                    
		$cmd->bindValue(":bairro"                   , $bairro);                 
		$cmd->bindValue(":cod_cidade"               , $cod_cidade);             
		$cmd->bindValue(":cep"                      , $cep);                    

	} // if( $acao == 'incluir' or $acao == 'alterar' )


	// se conseguiu executar o comando sql sem erros
	if( $cmd->execute() )
	{
		echo '<script language="javascript">
					document.location = "index.php?modulo=clientes";
			  </script>
			 ';
	}
	else
	{

		//die( $sql );

		//echo "<p>Data: " . $data_nascimento . "</p>";
		//echo "<p>Renda: " . $renda_familiar . "</p>";

		//print_r( $cmd->errorInfo() ); exit;		

		echo '<script language="javascript">
					document.location = "index.php?modulo=clientes&erro=Não foi possível gravar as informações, houve algum erro na transação com o Banco de Dados!!!";
			  </script>
			 ';
	}

?>