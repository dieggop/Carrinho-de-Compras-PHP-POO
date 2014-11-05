<?php
$area = isset($_GET['area']) ? $_GET['area'] : NULL;
$acao = isset($_GET['acao']) ? $_GET['acao'] : NULL;
$objCar = new Carrinho;

if ($area == "carrinho")
{
	
	if ($acao == "adicionar")
	{
		$id = isset ($_GET['id']) ? (int)$_GET['id'] : NULL;
		$objCar->AdicionarProduto ($id);
		
	}
	
	if ($acao == "remover")
	{
		$id = isset ($_GET['id']) ? (int)$_GET['id'] : NULL;
		$objCar->RemoverProduto ($id);
	}
	
	if ($acao == "alt_qtde")
	{
		$id = isset ($_GET['id']) ? (int)$_GET['id'] : NULL;
		$n_qtde = isset ($_POST['qtde_'.$id]) ? (int)$_POST['qtde_'.$id] : 1;
		$objCar->AlterarQuantidade($id, $n_qtde);
	}
	
	

	echo "
	<h2>Carrinho de Compras</h2>
	<table width=\"700\" cellpadding=\"2\" cellspacing=\"0\">
	  <tr>
 	   <td width=\"300\" style=\"text-align:center\">Nome</td>
 	   <td width=\"120\" style=\"text-align:center\">Pre&ccedil;o<br />Unit&aacute;rio</td>
    	<td width=\"100\" style=\"text-align:center\">Qunatidade</td>
		<td width=\"120\" style=\"text-align:center\">Subtotal deste<br />Produto</td>
		<td width=\"60\" style=\"text-align:center;\">Excluir<br />Produto</td>
  	</tr>
	";
	

	$carrinho = isset ($_SESSION['carrinho']) ? $_SESSION['carrinho'] : array();


	if (count ($carrinho) == 0)
	{
		echo "
		<tr>
		  <td colspan=\"5\" style=\"text-align:center\"><strong><em>
	 	   N&atilde;o h&aacute; produtos em seu carrinho de compas.</em></strong>
	 	</td>
		</tr>
		</table>
		<p><a href=\"?area=produtos\">Ver lista de produtos</a></p>
		";
	}
	else
	{
   		for ($a = 0; $a < count($carrinho); $a++)
		{
    		$id = $carrinho[$a]['id'];
    		$nome = htmlentities ($carrinho[$a]['nome']);
    		$preco = number_format ($carrinho[$a]['preco'], 2, ",", "");
    		$desc = htmlentities ($carrinho[$a]['descricao']);
			$qtde = $carrinho[$a]['qtde'];
			$subtotal = number_format(($carrinho[$a]['preco'] * $qtde), 2, ',', '');
			
			
			echo "
    		<tr>
	     	 <td style=\"border-left: dashed 1px black;\" class=\"celulas\">".$nome."</td>
	     	 <td class=\"celulas\">R$ ".$preco."</td>
	      	<td class=\"celulas\">
	     	 <form action=\"?area=carrinho&amp;acao=alt_qtde&amp;id=".$carrinho[$a]['id']."\"method=\"post\">
	      	<input type=\"text\" name=\"qtde_".$id."\" value=\"".$qtde."\" style=\"width: 30px;height: 15px;font-size:13px;text-align:center;border:inset 1px black;\" maxlength=\"2\" /><br />
	      	<input type=\"submit\" value=\"Alterar\" style=\"width: 80px;height: 20px;font-size:13px;margin:0;padding:0;cursor:pointer;background:#ccc;border: inset 1px black\" />
	     	 </form>
	      	</td>
	      	<td class=\"celulas\">R$ ". $subtotal . "</td>
	      	<td class=\"celulas\"><a href=\"?area=carrinho&amp;acao=remover&amp;id=" .$id. "\" onclick=\"return ConfirmarExclusaoProduto()\">Excluir</a></td>
	    	</tr>
	    	";
    	}// fecha for
    
   		echo "
    	<tr>
      	<td style=\"text-align:right\"><strong style=\"font-size:18px\">Total:</strong><br />Sem o valor do frete</td>
     	 <td style=\"text-align:center\"><strong style=\"font-size:18px\">".$_SESSION['total']."</strong></td>
     	 <td colspan=\"2\">&nbsp;</td>
    	</tr>
    	</table>
    	<p><a href=\"?area=produtos\">Continuar Comprando</a> | <a href=\"?area=finalizar&acao=finalizar\">Finalizar Pedido</a></p>
   	 ";
	}// fecha else
}
?>