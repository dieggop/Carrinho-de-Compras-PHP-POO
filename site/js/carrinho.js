function ConfirmarExclusaoProduto()
{
	var mensagem = "Tem certeza de que deseja excluir esse item do seu carrinho de compras?";
	
	if (confirm (mensagem))
	    return true;
	else
	{
	    alert ("OK. Nenhum produto excluído");
	    return false;
	}
}