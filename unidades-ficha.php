<?php
	$acao = @$_POST['acao'];
	$cod_unidade = @$_POST['cod_unidade'];

	$descricao = '';
	$sigla   = '';

	if( $acao == 'alterar' )
	{
		$sql = " select *
				 from unidades
				 where cod_unidade = '$cod_unidade'
		       ";

		$r = $pdo->query( $sql );		
		$dados = $r->fetch(PDO::FETCH_ASSOC);

		if( $dados )
		{
			$descricao = $dados['descricao'];
			$sigla   = $dados['sigla'];
		}
		else
		{
			// emite uma msg e interrompe o script neste ponto
			die("Registro de unidade não encontrado!");

			//echo "Registro de unidade não encontrado!";
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

		var descricao, sigla;
		descricao = $.trim($("#descricao").val());
		sigla = $.trim($("#sigla").val());

		if( descricao == '' )
		{
			erros++;
			$("#div_erro_descricao").html("O campo descricao deve ser preenchido !");
		}

		if( sigla == '' )
		{
			erros++;
			$("#div_erro_sigla").html("O campo sigla deve ser preenchido !");
		}


		if( erros > 0 ) $("#div_erro_geral").html("Não foi possível enviar os dados, pois há campos inválidos !");

		return erros == 0;


	} // enviar()



</script>	

	<h3>Cadastro de Unidades</h3>

	<form name="fcad" id="fcad" method="post" action="unidades-gravar.php">

		<input type="hidden" name="cod_unidade" id="cod_unidade" value="<?=$cod_unidade;?>">	
		<input type="hidden" name="acao" id="acao" value="<?=$acao;?>">	

		Descricao da Unidade:<br>
		<input type="text" name="descricao" id="descricao" maxlength="100" size="60" value="<?=$descricao;?>">
		<div id="div_erro_descricao"></div>

		<p></p>
		Sigla:<br>
		<input type="text" name="sigla" id="sigla" maxlength="5" size="30" value="<?=$sigla;?>">
		<div id="div_erro_sigla"></div>

		<p></p>
		<div id="div_erro_geral"></div>

		<input type="submit" name="btsub" id="btsub" value=" Gravar ">
		&nbsp;&nbsp;
		<input type="button" name="btcancel" id="btcancel" value=" Cancelar " onclick="document.location='index.php?modulo=unidades';">

	</form>

