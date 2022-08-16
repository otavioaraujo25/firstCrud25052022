<?php
	$acao = @$_POST['acao'];
	$cod_cidade = @$_POST['cod_cidade'];

	$nome = '';
	$uf   = '';

	if( $acao == 'alterar' )
	{
		$sql = " select *
				 from cidades
				 where cod_cidade = '$cod_cidade'
		       ";

		$r = $pdo->query( $sql );		
		$dados = $r->fetch(PDO::FETCH_ASSOC);

		if( $dados )
		{
			$nome = $dados['nome'];
			$uf   = $dados['uf'];
		}
		else
		{
			// emite uma msg e interrompe o script neste ponto
			die("Registro de cidade não encontrado!");

			//echo "Registro de cidade não encontrado!";
			//exit; // interrompe o script neste ponto
		}

	} // acao == 'alterar'
?>

<script type="text/javascript">
	
	//--------------------------------------------------------
	$(document).ready(function(){

		// capturando o evento submit do formulário
		// quando o form for submetido a função enviar() será chamada
		$("#fcad").submit( enviar );

		// formantando com a fonte vermelha os divs de erros
		$("div[id*='div_erro']").css("color","#ff0000")

	}); // $(document).ready(function(){

	//--------------------------------------------------------
	function enviar()
	{
		// limpando as mensagens de erro
		$("div[id*='div_erro']").html('');

		var erros = 0;

		var nome, uf;
		nome = $.trim($("#nome").val());
		uf = $.trim($("#uf").val());

		if( nome == '' )
		{
			erros++;
			$("#div_erro_nome").html("O campo nome deve ser preenchido !");
		}

		if( uf == '' )
		{
			erros++;
			$("#div_erro_uf").html("O campo uf deve ser preenchido !");
		}


		if( erros > 0 ) $("#div_erro_geral").html("Não foi possível enviar os dados, pois há campos inválidos !");

		return erros == 0;


	} // enviar()



</script>	

	<h3>Cadastro de Cidades</h3>

	<form name="fcad" id="fcad" method="post" action="cidades-gravar.php">

		<input type="hidden" name="cod_cidade" id="cod_cidade" value="<?=$cod_cidade;?>">	
		<input type="hidden" name="acao" id="acao" value="<?=$acao;?>">	

		Nome da Cidade:<br>
		<input type="text" name="nome" id="nome" maxlength="100" size="60" value="<?=$nome;?>">
		<div id="div_erro_nome"></div>

		<p></p>
		Unidade Federal:<br>
		<input type="text" name="uf" id="uf" maxlength="2" size="30" value="<?=$uf;?>">
		<div id="div_erro_uf"></div>

		<p></p>
		<div id="div_erro_geral"></div>

		<input type="submit" name="btsub" id="btsub" value=" Gravar ">
		&nbsp;&nbsp;
		<input type="button" name="btcancel" id="btcancel" value=" Cancelar " onclick="document.location='index.php?modulo=cidades';">

	</form>

