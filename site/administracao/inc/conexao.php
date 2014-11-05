<?php
	
	$conexao = mysql_connect('127.0.0.1', 'root', '') or exit('Não foi possivel conectar: '.mysql_error());
	
	if($conexao == TRUE)
	{
		mysql_select_db('loja');
	}

?>