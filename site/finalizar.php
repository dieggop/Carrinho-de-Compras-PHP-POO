<?php

require_once ("libs/classes/produtos.php");
$produtos = new Produtos();
$cliente = new Cliente();

$area = isset($_GET['area']) ? $_GET['area'] : NULL;
$acao = isset($_GET['acao']) ? $_GET['acao'] : NULL;


if ($area == "finalizar")
{
	if ($acao != "logando") {
	if(!isset($_SESSION['usuario_compra']))
	{
		$acao = "logar";
	
	}
	}
switch ($acao) {
	case "finalizar":
		 

		$carrinho = isset ($_SESSION['carrinho']) ? $_SESSION['carrinho'] : array();
		
		
		
		if (count ($carrinho) == 0)
		{
			echo "
		<p>Para poder finalizar sua compra, você deve ter produtos em seu carrinho de compras!</P>
		<p><a href=\"?area=produtos\">Ver lista de produtos</a></p>
		";
		}
		else
		{
		
			for ($a = 0; $a < count($carrinho); $a++)
			{
			$id = $carrinho[$a]['id'];
			$nome = $carrinho[$a]['nome'];
			$preco = $carrinho[$a]['preco'];
			$qtde = $carrinho[$a]['qtde'];
			$subtotal = ($carrinho[$a]['preco'] * $qtde);
			
			$produtos->CadastraCompraProduto($id, $nome, $qtde, $preco, $subtotal, $_SESSION['usuario_compra']['id'], 'P');
			
			}
			
		
				echo "Sua compra foi finalizada!";
			
			
		}
		break;
		
	case "logar":
		print "<p>Para finalizar sua compra você deve efetuar o login.</P>
				<form name=\"\" method=\"post\" action=\"?area=finalizar&acao=logando\"> <table>
				<div>
				<span>Email:</span>
				<input type=\"text\" name=\"login\">
				</div>
				<div>
				<span>Senha:</span>
				<input type=\"password\" name=\"senha\">
				</div>
				</table>
				<p style=\"margin-top: 20px;\">
					   			<button type=\"submit\">Logar</button>
					   			<input name=\"acao\" type=\"hidden\" value=\"logar\" />
							</p>
		
				<a href=\"?area=logar&acao=cadastro\">Ainda não sou cadastrado</a>
				</form>";
			
	break;
	
	case "logando":
		
		$cliente->ValidaCliente($_POST['login'], $_POST['senha']);
		
		
	break;
	
	case "logar":

		
		print "<form name=\"\" method=\"post\" action=\"?area=logar&acao=logar\"> <table>
				<div>
				<span>Email:</span>
				<input type=\"text\" name=\"login\">
				</div>
				<div>
				<span>Senha:</span>
				<input type=\"password\" name=\"senha\">
				</div>
				</table>
				<p style=\"margin-top: 20px;\">
					   			<button type=\"submit\">Logar</button>
					   			<input name=\"acao\" type=\"hidden\" value=\"logar\" />
							</p>
				
				<a href=\"?area=logar&acao=cadastro\">Ainda não sou cadastrado</a>
				</form>";
	
	break;
}




	
	   
	
}
?>