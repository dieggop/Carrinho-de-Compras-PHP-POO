<?php
 
class Carrinho
{
	
	/*
	   Função AdicionarProduto($id)
	   Adiciona ao carrinho o produto cujo id na tabela produtos seja $id, passado como parâmetro da função.
	   Se o id for inválido (NULL ou ''), axibe um alerta e retorna FALSE.
	   Se o produto já estiver no carrinho, exibe um alerta e retorna FALSE.
	*/
	
	public function AdicionarProduto($id)
	{
		if ($id == NULL || $id == '' || $id == 0)
		{
			echo "
			<script type=\"text/javascript\">
			alert ('O id do produto deve ser inteiro e maior que zero');
			</script>";
			return false;
		}
		
		/*
		   A função ArrayCarrinho() retorna um array com os id's dos produtos e suas respectivas chaves no array $_SESSION['carrinho'].
		*/
		$aCar = ArrayCarrinho();
		if (in_array ($id, $aCar))
		{
			//echo "
			//<script type=\"text/javascript\">
			//alert ('O produto que você selecionou já está em seu carrinho de compras.\\n Para adicionar outra unidade, altere a quantidade do produro.');
			//</script>
			//";
			
		//Se o produto ja existir no carrinho, ele acrescenta +1 na quantidade.
			$k = array_search ($id, $aCar);
				
			$_SESSION['carrinho'][$k]['qtde'] = $_SESSION['carrinho'][$k]['qtde']+1;
			$_SESSION['total'] = $this->Total();
			
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
		$cod = $f->id;
        $nome = $f->nome;
        $preco = $f->preco;
        $desc = $f->descricao;
        
		//próxima chave de $_SESSION['carrinho']:
        $k = isset ($_SESSION['carrinho']) ? count ($_SESSION['carrinho']) : 0;
		
		$_SESSION['carrinho'][$k]['id'] = $cod;
		$_SESSION['carrinho'][$k]['nome'] = $nome;
        $_SESSION['carrinho'][$k]['preco'] = $preco;
        $_SESSION['carrinho'][$k]['qtde'] = 1;
        $_SESSION['carrinho'][$k]['descricao'] = $desc;
        $_SESSION['total'] = $this->Total();
        
        //ordena $_SESSION['carrinho'] por nome de produto:
		//sort ($_SESSION['carrinho'], SORT_STRING);
        	
    }
    
    
    /*
       Função RemoverProduto($id)
       Remove de $_SESSION['carrinho'] o produto cujo id na tabela produtos é $id, passado como parâmetro da função.
       Se o id for inválido (NULL ou ''), exibe um alerta e retorna FALSE.
    */
    
    public function RemoverProduto($id)
	{
	    if ($id == NULL || $id == '' || $id == 0)
	    {
	        echo "
		    <script type=\"text/javascript\">
		    alert ('O id do produto deve ser inteiro e maior que zero');
		    </script>";
		    return false;
	    }
		
		// encontra a chave cujo id é o passado na função e o coloca na variável $k
		$aCar = ArrayCarrinho();
		$k = array_search ($id, $aCar);
		
		unset ($_SESSION['carrinho'][$k]);
		if (count ($_SESSION['carrinho']))//se ainda houver produtos no carrinho
		{
			//organiza as chaves do array desde zero até (count ($_SESSION['carrinho']) - 1)
			$car_keys = range (0, (count ($_SESSION['carrinho']) - 1));
			$_SESSION['carrinho'] = array_combine ($car_keys, $_SESSION['carrinho']);
		}
		$_SESSION['total'] = $this->Total();

	}
	
	
	/*
	   Função AlterarQuantidade($id, $n_qtde)
	   Altera a quantidade de unidades do produto cujo id é $id para $n_qtde.
	   Se o id for inválido (NULL ou ''), exibe um alerta e retorna FALSE.
	   Se $n_qtde for maior que zero, altera a quantidade do produto; se for igual ou menor que zero, remove-o do carrinho.
	*/
	
	
	public function AlterarQuantidade($id, $n_qtde)
	{
		if ($id == NULL || $id == '' || $id == 0)
	    {
	        echo "
		    <script type=\"text/javascript\">
		    alert ('O id do produto deve ser inteiro e maior que zero');
		    </script>";
		    return false;
	    }
	    
	    if ($n_qtde > 0)
		{
		    // encontra a chave cujo id é o passado na função e o coloca na variável $k
		    $aCar = ArrayCarrinho();
		    $k = array_search ($id, $aCar);
			
		    $my = new MySQLiConnection();
		    $sql = $my->query ("Select * From produtos Where id = ".$id);
		    $f = $sql->fetch_object();
		    $estoque = $f->estoque;
			
		    if ($n_qtde > $estoque) {
		    	echo "
		    <script type=\"text/javascript\">
		    alert ('A quantidade escolhida é maior do que dispomos em estoque. Desculpe-nos o transtorno');
		    </script>";
		    	return false;
		    	
		   		 } else {
		    	$_SESSION['carrinho'][$k]['qtde'] = $n_qtde;
		    	$_SESSION['total'] = $this->Total();
		    	
		    	}
			}
		else
		    $this->RemoverProduto($id);
	
	}
	
	
	
	
	public function Total()
	{
		$carro = isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : array();
		
		// inicia a variável $total:
		$total = 0;
		
		for ($t = 0; $t < count ($carro); $t++)
		{
			// multiplica o preço do produto por sua respectiva quantidade
			$total += $carro[$t]['preco'] * $carro[$t]['qtde'];
		}
		
		// retorna o total já formatado na forma brasileira
		return number_format ($total, 2, ",", "");
	}
	
}