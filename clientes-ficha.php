<?php
	$acao = @$_POST['acao'];
	$cod_cliente = @$_POST['cod_cliente'];

	if( $acao != 'alterar' and $acao != 'incluir' )
	{
		echo '<script language="javascritp">
					document.location = "index.php?modulo=clientes&erro=Ação inválida !!!";
			  </script>
			 ';
	}


	if( $acao == 'alterar' )
	{
		// buscar os dados do registro a ser alterado

		$sql = " select * from clientes where cod_cliente = '$cod_cliente' ";

		$r = $pdo->query($sql);

		$dados = $r->fetch(PDO::FETCH_ASSOC);

		// se conseguiu obter o registro
		if( $dados )
		{
			$nome                  = $dados['nome'];
			$cpf                   = $dados['cpf'];    
			$rg                    = $dados['rg'];    
			//$sexo                  = $dados['sexo'];    
			//$data_nascimento       = dataBR($dados['data_nascimento']);    
			//$renda_familiar        = floatBR($dados['renda_familiar']);    
			$telefone              = $dados['telefone'];    
			$email                 = $dados['email'];    
			$endereco              = $dados['endereco'];    
			$bairro                = $dados['bairro'];    
			$cod_cidade            = $dados['cod_cidade'];    
			$cep                   = $dados['cep'];    
		}
		else
		{
			echo '<script language="javascritp">
						document.location = "index.php?modulo=clientes&erro=Cidade não encontrada para alteração !!!";
				  </script>
				 ';
		}

	} // se estiver alterando
	else
	{
		$nome                  = "";
		$cpf                   = "";
		$rg                    = "";
		$telefone              = "";
		$email                 = "";
		$endereco              = "";
		$bairro                = "";
		$cod_cidade            = "";
		$cep                   = "";

	} // se estiver incluindo


?>

<script type="text/javascript">
	
	$(document).ready(function(){

		//-------------------------------------------------------------
		$("div[id*=erro]").css("color", "#f00");

		//-------------------------------------------------------------
		$("#btcancelar").click(function(){
			document.location="index.php?modulo=clientes";
		});

		//-------------------------------------------------------------
		$("#fcad").submit(function(){

			var erros = 0;

			$("div[id*=erro]").html("");

			$("#nome").val(  $.trim($("#nome").val() ) );

			if( $("#nome").val() == "" )
			{
				$("#div_error_nome").html("O campo Nome deve ser preenchido !!!");
				erros++;
			}

			return erros == 0;

		}); // submit de fcad


	}); // read

</script>




	<h2>Cadastro de Clientes</h2>

	<form name="fcad" id="fcad" method="post" action="clientes-gravar.php">

		<input type="hidden" name="acao" id="acao" value="<?php echo $acao; ?>">
		<input type="hidden" name="cod_cliente" id="cod_cliente" value="<?= $cod_cliente; ?>">

		<p>		
			Nome:<br>
			<input type="text" name="nome" id="nome" maxlength="100" value="<?= $nome; ?>" size="60">
			<div id="div_error_nome"></div>
		</p>

		<p>		
			CPF:<br>
			<input type="text" name="cpf" id="cpf" maxlength="11" value="<?= $cpf; ?>" size="20">
			<div id="div_error_cpf"></div>
		</p>

		<p>		
			RG:<br>
			<input type="text" name="rg" id="rg" maxlength="16" value="<?= $rg; ?>" size="20">
			<div id="div_error_rg"></div>
		</p>



		<p>
			Telefone:<br>
			<input type="text" name="telefone" id="telefone" maxlength="20" value="<?= $telefone; ?>">
			<div id="erro_telefone"></div>
		</p>

		<p>
			E-mail:<br>
			<input type="text" name="email" id="email" maxlength="150" size="60" value="<?= $email; ?>">
			<div id="erro_email"></div>
		</p>

		<p>
			Logradouro:(Rua, Avenida, Alameda...)<br>
			<input type="text" name="endereco" id="endereco" maxlength="200" size="60" value="<?= $endereco; ?>">
			<div id="erro_endereco"></div>
		</p>

		<p>
			Bairro:<br>
			<input type="text" name="bairro" id="bairro" maxlength="100" size="60" value="<?= $bairro; ?>">
			<div id="erro_bairro"></div>
		</p>

		<p>
			Cidade:<br>
			<select name="cod_cidade" id="cod_cidade">
				<option value="0">Selecione uma cidade</option>	

				<?php
					$r = $pdo->query("select * from cidades order by nome");

					while( $d = $r->fetch(PDO::FETCH_ASSOC) )
					{

						if( $cod_cidade == $d['cod_cidade'] ) 
							$selected = ' selected="selected" ';
						else
							$selected = '';

						echo '<option value="'.$d['cod_cidade'].'"  '.$selected.'  >'.$d['nome'].'-'.$d['uf'].'</option>';

					} // while

				?>


			</select>
			<div id="erro_cod_cidade"></div>
		</p>

		<p>
			Cep:<br>
			<input type="text" name="cep" id="cep" maxlength="8" size="10" value="<?= $cep; ?>">
			<div id="erro_cep"></div>
		</p>		



		<input type="submit" name="btgravar" id="btgravar" value=" Gravar ">
	
		&nbsp;&nbsp;
	
		<input type="button" name="btcancelar" id="btcancelar" value=" Cancelar ">

	</form>

