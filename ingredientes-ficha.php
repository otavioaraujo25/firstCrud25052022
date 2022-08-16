<?php
	$acao = @$_POST['acao'];
	$cod_ingrediente = @$_POST['cod_ingrediente'];

	$descricao = '';
	$valor_unitario   = '';
	$cod_unidade = '';

	if( $acao == 'alterar' )
	{
		$sql = " select *
				 from ingredientes
				 where cod_ingrediente = '$cod_ingrediente'
		       ";

		$r = $pdo->query( $sql );		
		$dados = $r->fetch(PDO::FETCH_ASSOC);

		if( $dados )
		{
			$descricao       = $dados['descricao'];
			$valor_unitario  = floatBR($dados['valor_unitario']);
			$cod_unidade     = $dados['cod_unidade'];
		}
		else
		{
			// emite uma msg e interrompe o script neste ponto
			die("Registro de ingrediente não encontrado!");

			//echo "Registro de ingrediente não encontrado!";
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

		var descricao, valor_unitario;
		descricao = $.trim($("#descricao").val());
		valor_unitario = $.trim($("#valor_unitario").val());

		if( descricao == '' )
		{
			erros++;
			$("#div_erro_descricao").html("O campo descricao deve ser preenchido !");
		}

		if( $("#cod_unidade").val() == '' )
		{
			erros++;
			$("#div_erro_cod_unidade").html("O campo unidade de medida deve ser preenchido !");
		}

		if( !numReal(valor_unitario) )
		{
			erros++;
			$("#div_erro_valor_unitario").html("O campo valor unitário deve ser preenchido com um número válido !");
		}

		if( erros > 0 ) $("#div_erro_geral").html("Não foi possível enviar os dados, pois há campos inválidos !");

		return erros == 0;


	} // enviar()



</script>	

	<h3>Cadastro de Ingredientes</h3>

	<form name="fcad" id="fcad" method="post" action="ingredientes-gravar.php">

		<input type="hidden" name="cod_ingrediente" id="cod_ingrediente" value="<?=$cod_ingrediente;?>">	
		<input type="hidden" name="acao" id="acao" value="<?=$acao;?>">	

		Descrição do Ingrediente:<br>
		<input type="text" name="descricao" id="descricao" maxlength="100" size="60" value="<?=$descricao;?>">
		<div id="div_erro_descricao"></div>

		<p></p>
		Unidade de Medida:<br>

		<select name="cod_unidade" id="cod_unidade">
			<option value="">Selecione uma unidade</option>

			<?php
				$r = $pdo->query("select * from unidades order by descricao");

				while( $d = $r->fetch(PDO::FETCH_ASSOC) )
				{
					$sel = $d['cod_unidade'] == $cod_unidade ? ' selected="selected" ' : '';
					echo '<option value="'.$d['cod_unidade'].'" '.$sel.'>'.$d['descricao'].'</option>';
				}

			?>

		</select>

		<div id="div_erro_cod_unidade"></div>

		<p></p>
		Valor Unitário:<br>
		<input type="text" name="valor_unitario" id="valor_unitario" size="30" value="<?=$valor_unitario;?>">
		<div id="div_erro_valor_unitario"></div>

		<p></p>
		<div id="div_erro_geral"></div>

		<input type="submit" name="btsub" id="btsub" value=" Gravar ">
		&nbsp;&nbsp;
		<input type="button" name="btcancel" id="btcancel" value=" Cancelar " onclick="document.location='index.php?modulo=ingredientes';">

	</form>

