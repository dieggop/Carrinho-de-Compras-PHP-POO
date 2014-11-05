<?php
require "init.php";
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache" />

<link rel="stylesheet" href="css/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/carrinho.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/produtos.css" type="text/css" media="screen" />

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/carrinho.js"></script>

<title>Carrinho de Compras - Por Dieggo Carrilho</title>
</head>
<body>
<div id="topo">
<h1 style="text-align: center;">Sistema de Carrinho de Compras</h1>
</div>

<div id="menu">
<ul>
  <li>&middot; <a href="?">P&aacute;gina Inicial</a></li>
  <li>&middot; <a href="?area=produtos">Produtos</a></li>
  <li>&middot; <a href="?area=carrinho">Ver meu Carrinho de Compras</a></li>
 <li>
 						<?php 
							if(isset($_SESSION['usuario_compra']))
							{
						 print '
								Voc&ecirc; esta logado como: '.$_SESSION['usuario_compra']['email'].'  -  <a href="?area=logar&acao=sair">Sair</a>
						 ';
							}
							else
							{
						print '
							<form name="" method="post" action="?area=logar&acao=logar" style="margin: 0px ; padding: 0px; float:right;"> 	Quero comprar:
								<input name="login" type="text" size="10" class="caixa_texto_logar" placeholder="usu&aacute;rio" />
								<input name="senha" type="password" size="10" class="caixa_texto_logar" placeholder="Senha" />
		            			<button type="submit" >Logar</button>
		            			</form>
	            				<a href="?area=logar&acao=cadastro"> <u>Ainda não sou cadastrado</u> </a>
	            		 ';
							}
	            		?>
	            		</li>
	            		
</ul>
</div>

<div id="conteudo">
<?php
if (isset ($_GET['area']))
{
	switch ($_GET['area'])
	{
		case "carrinho":
		  include "carrinho.php";
		  break;
		case "produtos":
		  include "produtos.php";
		  break;
		case "finalizar":
		  include "finalizar.php";
		  break;
		  case "logar":
		  	include "logar.php";
		  	break;
		default:
		  include "inicial.php";
		  break;
	}
}
else
{
	include "inicial.php";
}
?>
</div>
</body>
</html>