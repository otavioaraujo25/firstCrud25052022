<?php
	$acao = @$_POST['acao'];
	$cod_prato = @$_POST['cod_prato'];

	$descricao = '';
	$valor_unitario   = '';

	if( $acao == 'alterar' )
	{
		$sql = " select *
				 from pratos
				 where cod_prato = '$cod_prato'
		       ";

		$r = $pdo->query( $sql );		
		$dados = $r->fetch(PDO::FETCH_ASSOC);

		if( $dados )
		{
			$cod_categoria = $dados['cod_categoria'];
			$descricao = $dados['descricao'];
			$valor_unitario   = floatBR($dados['valor_unitario']);
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

		var descricao, valor_unitario;
		descricao = $.trim($("#descricao").val());
		valor_unitario = $.trim($("#valor_unitario").val());
		cod_categoria = $.trim($("#cod_categoria").val());

		if( descricao == '' )
		{
			erros++;
			$("#div_erro_descricao").html("O campo descricao deve ser preenchido !");
		}

		if( valor_unitario == '' )
		{
			erros++;
			$("#div_erro_valor_unitario").html("O campo valor_unitario deve ser preenchido !");
		}


		if( erros > 0 ) $("#div_erro_geral").html("Não foi possível enviar os dados, pois há campos inválidos !");

		return erros == 0;


	} // enviar()



</script>	

	<h3>Cadastro de pratos</h3>

	<form name="fcad" id="fcad" method="post" action="pratos-gravar.php">

		<input type="hidden" name="cod_prato" id="cod_prato" value="<?=$cod_prato;?>">	
		<input type="hidden" name="acao" id="acao" value="<?=$acao;?>">	

		descricao da prato:<br>
		<input type="text" name="descricao" id="descricao" maxlength="100" size="60" value="<?=$descricao;?>">
		<div id="div_erro_descricao"></div>

		<p></p>
		valor:<br>
		<input type="text" name="valor_unitario" id="valor_unitario" size="30" value="<?=$valor_unitario;?>">
		<div id="div_erro_valor_unitario"></div>

		<p>
			Categorias:<br>
			<select name="cod_categoria" id="cod_categoria">
				<option value="0">Selecione uma categoria</option>	

				<?php
					$r = $pdo->query("select * from categorias order by descricao");

					while( $d = $r->fetch(PDO::FETCH_ASSOC) )
					{

						if( $cod_categoria == $d['cod_categoria'] ) 
							$selected = ' selected="selected" ';
						else
							$selected = '';

						echo '<option value="'.$d['cod_categoria'].'"  '.$selected.'  >'.$d['descricao'].'-'.'</option>';

					} // while

				?>


			</select>
			<div id="erro_cod_categoria"></div>
		</p>


		<p></p>
		<div id="div_erro_geral"></div>

		<input type="submit" name="btsub" id="btsub" value=" Gravar ">
		&nbsp;&nbsp;
		<input type="button" name="btcancel" id="btcancel" value=" Cancelar " onclick="document.location='index.php?modulo=pratos';">

	</form>

