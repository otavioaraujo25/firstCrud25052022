<script type="text/javascript">	
	//-------------------------------------------------------------		
	function Incluir()
	{
		$("#acao").val('incluir');
		$("#cod_ingrediente").val('0');
		$("#foculto").attr("action","index.php?modulo=ingredientes-ficha");
		$("#foculto").submit();
	} // Incluir()

	//-------------------------------------------------------------		
	function Alterar(cod_ingrediente)
	{
		$("#acao").val('alterar');
		$("#cod_ingrediente").val( cod_ingrediente );
		$("#foculto").attr("action","index.php?modulo=ingredientes-ficha");
		$("#foculto").submit();
	} // Alterar()

	//-------------------------------------------------------------		
	function Excluir(cod_ingrediente)
	{
		if( confirm("Deseja realmente excluir este registro ?") )
		{
			$("#acao").val('excluir');
			$("#cod_ingrediente").val( cod_ingrediente );
			$("#foculto").attr("action","ingredientes-gravar.php");
			$("#foculto").submit();
		} // se confirmou a exclusão
	} // Excluir()
</script>

	<h3>Cadastro de Ingredientes</h3>
	
	<form name="foculto" id="foculto" method="post" action="">
		<input type="hidden" name="acao" id="acao" value="">
		<input type="hidden" name="cod_ingrediente" id="cod_ingrediente" value="">
	</form>


	<p>
		<a href="javascript:Incluir();">Novo Registro</a>
	</p>

	<form name="fpesq" id="fpesq" method="post" action="">

		Pesquisa<br>
		<input type="text" name="pesquisa" id="pesquisa" value="<?=@$_POST['pesquisa']; ?>" size="60">

		<input type="submit" name="btpesq" id="btpesq" value="Pesquisar">

	</form>

<?php
	$pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '';

	$sql = "select	i.*, u.descricao as unidade
			from	ingredientes i
					inner join unidades u on (i.cod_unidade = u.cod_unidade)

			where	i.descricao like '%$pesquisa%' or u.descricao like '%$pesquisa%'

			order by i.descricao
	       ";
	$r = $pdo->query( $sql );

	echo '<table width="100%" cellpadding="5">
			<tr bgcolor="#cbcbcb" >
				<td align="center">Código</td>
				<td>Descrição</td>
				<td>Unidade de Medida</td>
				<td align="center">Valor Unitário</td>
				<td align="center">Opções</td>
			</tr>
		 ';

	while( $dados = $r->fetch(PDO::FETCH_ASSOC) )
	{

		$str_alt = '<a href="javascript:Alterar('.$dados['cod_ingrediente'].');">Alterar</a>';
		$str_exc = '<a href="javascript:Excluir('.$dados['cod_ingrediente'].');">Excluir</a>';

		echo '
				<tr bgcolor="#efefef">
					<td align="center">'.$dados['cod_ingrediente'].'</td>
					<td>'.$dados['descricao'].'</td>
					<td>'.$dados['unidade'].'</td>
					<td align="right">'.number_format($dados['valor_unitario'],2,',','.').'</td>
					<td align="center">'.$str_alt.' &nbsp;&nbsp; '.$str_exc.'</td>
				</tr>
			 ';

	} // while...

	echo '</table>';

?>
