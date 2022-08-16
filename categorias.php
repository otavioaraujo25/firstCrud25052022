<script type="text/javascript">	
	//-------------------------------------------------------------		
	function Incluir()
	{
		$("#acao").val('incluir');
		$("#cod_categoria").val('0');
		$("#foculto").attr("action","index.php?modulo=categorias-ficha");
		$("#foculto").submit();
	} // Incluir()

	//-------------------------------------------------------------		
	function Alterar(cod_categoria)
	{
		$("#acao").val('alterar');
		$("#cod_categoria").val( cod_categoria );
		$("#foculto").attr("action","index.php?modulo=categorias-ficha");
		$("#foculto").submit();
	} // Alterar()

	//-------------------------------------------------------------		
	function Excluir(cod_categoria)
	{
		if( confirm("Deseja realmente excluir este registro ?") )
		{
			$("#acao").val('excluir');
			$("#cod_categoria").val( cod_categoria );
			$("#foculto").attr("action","categorias-gravar.php");
			$("#foculto").submit();
		} // se confirmou a exclusão
	} // Excluir()
</script>

	<h3>Cadastro de categorias</h3>
	
	<form name="foculto" id="foculto" method="post" action="">
		<input type="hidden" name="acao" id="acao" value="">
		<input type="hidden" name="cod_categoria" id="cod_categoria" value="">
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
			 from categorias
			 where descricao like '%$pesquisa%'
			 order by descricao 
	       ";

	$r = $pdo->query( $sql );

	echo '<table width="100%" cellpadding="5">
			<tr bgcolor="#cbcbcb" >
				<td align="center">Código</td>
				<td>descricao</td>
				<td align="center">Opções</td>
			</tr>
		 ';

	while( $dados = $r->fetch(PDO::FETCH_ASSOC) )
	{

		$str_alt = '<a href="javascript:Alterar('.$dados['cod_categoria'].');">Alterar</a>';
		$str_exc = '<a href="javascript:Excluir('.$dados['cod_categoria'].');">Excluir</a>';

		echo '
				<tr bgcolor="#efefef">
					<td align="center">'.$dados['cod_categoria'].'</td>
					<td>'.$dados['descricao'].'</td>
					<td align="center">'.$str_alt.' &nbsp;&nbsp; '.$str_exc.'</td>
				</tr>
			 ';

	} // while...

	echo '</table>';

?>
