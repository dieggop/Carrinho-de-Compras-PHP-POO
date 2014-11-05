<?php
 
class Produtos
{
	
	/*
	   Função AdicionarProduto($id)
	   Adiciona ao carrinho o produto cujo id na tabela produtos seja $id, passado como parâmetro da função.
	   Se o id for inválido (NULL ou ''), axibe um alerta e retorna FALSE.
	   Se o produto já estiver no carrinho, exibe um alerta e retorna FALSE.
	*/
	PRIVATE $id;
	PRIVATE $nome;
	PRIVATE $descricao;
	PRIVATE $preco;
	PRIVATE $estoque;
	PRIVATE $categoria;
		
	public function CadastraCompraProduto($id, $nome, $qtd, $preco, $total, $clienteid, $status)
	{
	
		$my = new MySQLiConnection();
		$stmt = $my->prepare("INSERT INTO compra(produtoid, nome, valor, qtd,  total, clienteid, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param('isdidis', $id ,
				$nome,
				$preco,
				$qtd,
				$total,
				$clienteid,
				$status);
		$stmt->execute();
		
		
		$aCar = ArrayCarrinho();
		$k = array_search ($id, $aCar);
		
		unset ($_SESSION['carrinho'][$k]);
		
	}
	public function PegaCategoria()
	{
/*
 * Aqui poderia criar um select de uma tabela de categorias e fazer um rnd, isso caso seja a primeira vez que o usuário
 * entra no site, como não tem essa tabela, então fica um rnd de 1 a 3
 */
		return rand(1,3);
	
	}
	public function DetalhesProdutos($id)
	{
	
		
		
		
		if ($id == NULL || $id == '' || $id == 0)
		{
			echo "
		    <script type=\"text/javascript\">
		    alert ('O id do produto deve ser inteiro e maior que zero');
		    </script>";
			return false;
		}
		
		
		$my = new MySQLiConnection();
		$sql = $my->query ("Select * From produtos Where id = ".$id);
		
		if ($sql->num_rows == 0)
		{
			echo "
			<script type=\"text/javascript\">
			alert ('Não foi encontrado um produto com esse id.');
			</script>";
			return false;
		}
		
		$f = $sql->fetch_object();
		$this->id = $f->id;
		$this->nome = $f->nome;
		$this->preco = $f->preco;
		$this->descricao = $f->descricao;
		$this->estoque = $f->estoque;
		$this->categoria = $f->categoria;
	
	}
	
	
	
	/**
	 * @return the $nome
	 */
	public function getNome() {
		return $this->nome;
	}

	/**
	 * @return the $descricao
	 */
	public function getDescricao() {
		return $this->descricao;
	}

	/**
	 * @return the $preco
	 */
	public function getPreco() {
		return $this->preco;
	}

	/**
	 * @return the $estoque
	 */
	public function getEstoque() {
		return $this->estoque;
	}
	public function getID() {
		return $this->id;
	}
	public function getCategoria() {
		return $this->categoria;
	}
	public function ListarProdutos()
	{
	
		$my = new MySQLiConnection();
		$sql = $my->query ("Select * From produtos Order By nome");
		echo "<p>Total de produtos: <strong>".$sql->num_rows."</strong></p><br />";
		
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
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
}