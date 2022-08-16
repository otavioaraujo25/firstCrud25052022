<script type="text/javascript">	
	//-------------------------------------------------------------		
	function Incluir()
	{
		$("#acao").val('incluir');
		$("#cod_cidade").val('0');
		$("#foculto").attr("action","index.php?modulo=cidades-ficha");
		$("#foculto").submit();
	} // Incluir()

	//-------------------------------------------------------------		
	function Alterar(cod_cidade)
	{
		$("#acao").val('alterar');
		$("#cod_cidade").val( cod_cidade );
		$("#foculto").attr("action","index.php?modulo=cidades-ficha");
		$("#foculto").submit();
	} // Alterar()

	//-------------------------------------------------------------		
	function Excluir(cod_cidade)
	{
		if( confirm("Deseja realmente excluir este registro ?") )
		{
			$("#acao").val('excluir');
			$("#cod_cidade").val( cod_cidade );
			$("#foculto").attr("action","cidades-gravar.php");
			$("#foculto").submit();
		} // se confirmou a exclusão
	} // Excluir()
</script>

	<h3>Cadastro de Cidades</h3>
	
	<form name="foculto" id="foculto" method="post" action="">
		<input type="hidden" name="acao" id="acao" value="">
		<input type="hidden" name="cod_cidade" id="cod_cidade" value="">
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
			 from cidades
			 where nome like '%$pesquisa%'
			 order by nome 
	       ";

	$r = $pdo->query( $sql );

	echo '<table width="100%" cellpadding="5">
			<tr bgcolor="#cbcbcb" >
				<td align="center">Código</td>
				<td>Nome</td>
				<td align="center">Unidade Federal</td>
				<td align="center">Opções</td>
			</tr>
		 ';

	while( $dados = $r->fetch(PDO::FETCH_ASSOC) )
	{

		$str_alt = '<a href="javascript:Alterar('.$dados['cod_cidade'].');">Alterar</a>';
		$str_exc = '<a href="javascript:Excluir('.$dados['cod_cidade'].');">Excluir</a>';

		echo '
				<tr bgcolor="#efefef">
					<td align="center">'.$dados['cod_cidade'].'</td>
					<td>'.$dados['nome'].'</td>
					<td align="center">'.$dados['uf'].'</td>
					<td align="center">'.$str_alt.' &nbsp;&nbsp; '.$str_exc.'</td>
				</tr>
			 ';

	} // while...

	echo '</table>';

?>
