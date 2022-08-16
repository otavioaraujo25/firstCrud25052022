<?php
	$acao = @$_POST['acao'];
	$cod_categoria = @$_POST['cod_categoria'];

	$descricao = '';



	if( $acao == 'alterar' )
	{
		$sql = " select *
				 from categorias
				 where cod_categoria = '$cod_categoria'
		       ";

		$r = $pdo->query( $sql );		
		$dados = $r->fetch(PDO::FETCH_ASSOC);

		if( $dados )
		{
			$descricao = $dados['descricao'];
			
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

		var descricao;
		descricao = $.trim($("#descricao").val());
		

		if( descricao == '' )
		{
			erros++;
			$("#div_erro_descricao").html("O campo descricao deve ser preenchido !");
		}

	


		if( erros > 0 ) $("#div_erro_geral").html("Não foi possível enviar os dados, pois há campos inválidos !");

		return erros == 0;


	} // enviar()



</script>	

	<h3>Cadastro de categorias</h3>

	<form name="fcad" id="fcad" method="post" action="categorias-gravar.php">

		<input type="hidden" name="cod_categoria" id="cod_categoria" value="<?=$cod_categoria;?>">	
		<input type="hidden" name="acao" id="acao" value="<?=$acao;?>">	

		descricao da Categoria:<br>
		<input type="text" name="descricao" id="descricao" maxlength="100" size="60" value="<?=$descricao;?>">
		<div id="div_erro_descricao"></div>

		

		<p></p>
		<div id="div_erro_geral"></div>

		<input type="submit" name="btsub" id="btsub" value=" Gravar ">
		&nbsp;&nbsp;
		<input type="button" name="btcancel" id="btcancel" value=" Cancelar " onclick="document.location='index.php?modulo=categorias';">

	</form>

