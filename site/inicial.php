<?php
echo "
<h1>P&Aacute;GINA INICIAL</h1>
";


if(!isset($_COOKIE['ultcategoria']))
{
	$produtos = new Produtos();
	setcookie('ultcategoria',$produtos->PegaCategoria(), time()+172800);
	//caso ele não tenha navegado ainda, vai ser criado o cookie que esta sendo retornado
}

$my = new MySQLiConnection();
$sql = $my->query ("Select * From produtos where categoria=". $_COOKIE['ultcategoria'] ." ORDER BY RAND() LIMIT 5");
echo "<h3>Produtos de seu interesse</h3><hr>";
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
      <td colspan=\"3\" class=\"cel_prods\">".utf8_decode($x->descricao)."</td>
    </tr>
    <tr>
	  <td colspan=\"3\">&nbsp;</td>
	</tr>
    ";
}
echo "</table>";
?>