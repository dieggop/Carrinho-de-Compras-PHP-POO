<?php
/*
**  Página que exibe todos os produtos do banco de dados e se selecionado, os detalhes do mesmo
*/

require_once ("libs/classes/produtos.php");

$area = isset($_GET['area']) ? $_GET['area'] : NULL;
$acao = isset($_GET['acao']) ? $_GET['acao'] : NULL;
$produtos = new Produtos();

if ($area != "produtos")
{
	 header("location: index");
	}
	
	switch ($acao) {
		case "informacoes":
			$id = isset($_GET['id']) ? $_GET['id'] : NULL;
			
			$produtos->DetalhesProdutos($id);

			setcookie('ultcategoria',$produtos->getCategoria(), time()+172800);
			
			if ($produtos->getEstoque()== 0) {
			
				$linkadd = "Produto esgotado";
			
			} else {
				$linkadd = '<p class="botaoformulario">
                            	<a href="?area=carrinho&acao=adicionar&id='.$produtos->getID().'"><img alt="" src="./img/btn-comprar.png" border="0" /> </a>
                            </p>';
			}
			
			print '<div><h1>'.htmlentities($produtos->getNome()).'</h1></div>
					<p class="descricao">
                        	'.htmlentities($produtos->getDescricao()).'
						</p>
                         
                        			'.$linkadd.' 
							
	                        <p class="tituloformulario" style="margin-top:25px;">
	                        	Valor: R$ '.number_format ($produtos->getPreco(), 2, ",", "").'
	                        </p>
                        	<p class="tituloformulario" style="margin-top:25px;">
                        		Formas de Pagamento 
                        	</p>
							<p>
								<img alt="Continuar Comprando" src="./img/formas-pagamento.png" border="0" />
							</p>
							<p class="continuarcomprando_finalizarcompra">
								<a href="?area=produtos"><img alt="Continuar Comprando" src="./img/btncontinuarcomprando.png" border="0" /></a>
								
							</p>
						';
			
			
			

			echo "<h2>Produtos Relacionados</h2>";
			
			
			$my = new MySQLiConnection();
			$sql = $my->query ("Select * From produtos where categoria=".$produtos->getCategoria()." ORDER BY RAND() LIMIT 5");
				
			echo "<table width=\"600\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\">";
			while ($x = $sql->fetch_object())
			{
			
				print "
	<tr>
      <td width=\"400\" class=\"cel_prods\"><strong>".htmlentities($x->nome)."</strong></td>
      <td width=\"100\" class=\"cel_prods\">R$ <strong>".$x->preco."</strong></td>
      <td width=\"100\" class=\"cel_prods\"><a href=\"?area=produtos&acao=informacoes&id=".$x->id."\">Detalhes</a></td>
    </tr>
    <tr>
      <td colspan=\"3\" class=\"cel_prods\">".htmlentities($x->descricao)."</td>
    </tr>
    <tr>
	  <td colspan=\"3\">&nbsp;</td>
	</tr>
    ";
			}
			echo "</table>";
			
			
break;
		default:

			$produtos->ListarProdutos();
			
break;

	}
?>