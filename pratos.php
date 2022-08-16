<script type="text/javascript">	
	//-------------------------------------------------------------		
	function Incluir()
	{
		$("#acao").val('incluir');
		$("#cod_prato").val('0');
		$("#foculto").attr("action","index.php?modulo=pratos-ficha");
		$("#foculto").submit();
	} // Incluir()

	//-------------------------------------------------------------		
	function Alterar(cod_prato)
	{
		$("#acao").val('alterar');
		$("#cod_prato").val( cod_prato );
		$("#foculto").attr("action","index.php?modulo=pratos-ficha");
		$("#foculto").submit();
	} // Alterar()

	//-------------------------------------------------------------		
	function Excluir(cod_prato)
	{
		if( confirm("Deseja realmente excluir este registro ?") )
		{
			$("#acao").val('excluir');
			$("#cod_prato").val( cod_prato );
			$("#foculto").attr("action","pratos-gravar.php");
			$("#foculto").submit();
		} // se confirmou a exclusão
	} // Excluir()
</script>

	<h3>Cadastro de pratos</h3>
	
	<form name="foculto" id="foculto" method="post" action="">
		<input type="hidden" name="acao" id="acao" value="">
		<input type="hidden" name="cod_prato" id="cod_prato" value="">
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

	$sql = " select *
			 from pratos
			 where descricao like '%$pesquisa%'
			 order by descricao 
	       ";

	$r = $pdo->query( $sql );

	echo '<table width="100%" cellpadding="5">
			<tr bgcolor="#cbcbcb" >
				<td align="center">Código</td>
				<td>descricao</td>
				<td align="center">Valor Unitário</td>
				<td align="center">Categoria</td>
			</tr>
		 ';

	while( $dados = $r->fetch(PDO::FETCH_ASSOC) )
	{

		$str_alt = '<a href="javascript:Alterar('.$dados['cod_prato'].');">Alterar</a>';
		$str_exc = '<a href="javascript:Excluir('.$dados['cod_prato'].');">Excluir</a>';

		echo '
				<tr bgcolor="#efefef">
					<td align="center">'.$dados['cod_prato'].'</td>
					<td>'.$dados['descricao'].'</td>
					<td align="center">'.$dados['valor_unitario'].'</td>
					<td align="center">'.$dados['descricao'].'</td>

					<td align="center">'.$str_alt.' &nbsp;&nbsp; '.$str_exc.'</td>
				</tr>
			 ';

	} // while...

	echo '</table>';

?>
