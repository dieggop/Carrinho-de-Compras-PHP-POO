<?php 
	session_start();
	
	if($_SESSION['autenticacao'] != TRUE)
	{
		header('Location: ../home/index.php');
	}
	
	if(isset($_POST['acao']))
	{
		include_once('../../inc/conexao.php'); 
		
		switch($_POST['acao'])
		{
			case 'salvar':
				$nomeproduto = $_POST['nome_produto'];
				$valor = str_replace(',', '.', $_POST['valor']);
				$descricao = $_POST['descricao']; 
				$estoque = $_POST['estoque'];
				$categoria = $_POST['categoria']; 
				
				$resultado = mysql_query("INSERT INTO produtos (nome,preco,descricao,categoria,estoque) 
										VALUES
										 ('$nomeproduto','$valor','$descricao',
										 '$categoria','$estoque')");
				
				if($resultado)
				{
					echo 'Cadastro realizado com sucesso.';
				}
				else
				{
					echo 'Seu cadastro n„o pode ser realizado.';
				}
				
				break;
			case 'localizar':
				$id = $_POST['id'];
				
				$resultado = mysql_query("SELECT * FROM produtos WHERE id = '$id' ORDER BY nome");
				$dados_produto = mysql_fetch_array($resultado);
				
				break;
			case 'atualizar':
				$id = $_POST['id'];
				$nomeproduto = $_POST['nome_produto'];
				$valor = str_replace(',', '.', $_POST['valor']);
				$descricao = $_POST['descricao'];
				 
				$estoque = $_POST['estoque'];
				$categoria = $_POST['categoria'];
			  
				$resultado = mysql_query("UPDATE produtos SET nome = '$nomeproduto', preco = '$valor' , descricao = '$descricao', categoria = '$categoria',
													estoque = '$estoque' 
													WHERE id= '$id'");
				
				if($resultado)
				{
					echo 'Cadastro alterado com sucesso.';
				}
				else
				{
					echo 'Seu cadastro n„o pode ser alterado.';
				}
				
				break;
			case 'excluir':
				$id = $_POST['id'];
				
				$resultado = mysql_query("DELETE FROM produtos WHERE id = '$id'");
				
				if($resultado)
				{
					echo 'Cadastro excluido com sucesso.';
				}
				else
				{
					echo 'Seu cadastro n„o pode ser excluido.';
				}
				
				break;
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Painel de Controle</title>
    <link href="../../css/admin.css" rel="stylesheet" type="text/css" />
    <link href="../../css/menu.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
        var menuids=["sidebarmenu1"]
        function initsidebarmenu()
        {
            for (var i=0; i<menuids.length; i++)
            {
                var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
                for (var t=0; t<ultags.length; t++)
                {
                    ultags[t].parentNode.getElementsByTagName("a")[0].className+=" subfolderstyle"
                    if (ultags[t].parentNode.parentNode.id==menuids[i])
                        ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px"
                    else
                        ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" 
                        ultags[t].parentNode.onmouseover=function(){
                        this.getElementsByTagName("ul")[0].style.display="block"
                }
            ultags[t].parentNode.onmouseout=function(){
            this.getElementsByTagName("ul")[0].style.display="none"
            }
        }
        for (var t=ultags.length-1; t>-1; t--){
        ultags[t].style.visibility="visible"
        ultags[t].style.display="none"
        }
        }
        }
        if (window.addEventListener)
        window.addEventListener("load", initsidebarmenu, false)
        else if (window.attachEvent)
        window.attachEvent("onload", initsidebarmenu)
    </script>
</head>

<body>
    <div class="CabecalhoFaixa">
    </div>
    <div id="Total">
        <div id="SubTotal">
            <div class="FundoLogo">
                <div class="Logo"> 
                </div>
            </div>
            <div id="Menus">
                <div id="SubMenus">
                    <!-- Aqui coloca-se o menu -->
                    <div class="sidebarmenu" style="margin: 0 0 0 10px;">
                        <ul id="sidebarmenu1">
                            <li><a href="../home/index2.php">Pagina Inicial</a></li>
                            <li><a href="#"><b>Produtos</b>
                                <img alt="Seta Sub-menu" border="0" style="margin-left:115px;" src="../../img/seta-menu.jpg" /></a>
                                <ul>
                                    <li><a href="../categoria/index.php">Categorias</a></li>
                                    <li><a href="../produto/index.php"><b>Produtos</b></a></li>
                                </ul>
                            </li>
                            <li><a href="../pedido/index.php">Pedido de Produtos</a></li>
                            <li><a href="../clientes/index.php">Cadastro de Clientes</a></li>
                            <li> <a href="#"> &nbsp; </a> </li>
                            
                            <li><a href="../usuario/index.php"> Cadastro de Usu&aacute;rio </a></li>
                            <li><a href="../../inc/sair_sistema.php">[Sair]</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="Conteudo">
                <div id="SubConteudo">
                    <!-- Aqui coloca-se o conteudo -->
                    <p class="titulo">
                        Produtos</p>
                    <p class="linhadivisoriacentro">
                        <img alt="Linha Diviss√£o" src="../../img/linha-divisoria-centro.png" /></p>
                    <p class="descricao">
                        Para inserir um produto informe os dados abaixo:</p>
                    <br />
                    <br />
                    <form action="index.php" method="post" name="produtos" enctype="multipart/form-data">
                        <p class="legendacaixasdetexto">
                            Nome do Produto: <b style="font-weight:normal;margin-left:116px;"> Valor do Produto: (Ex: 25,00) </b>
                        </p>
                        <p>
                            <input name="nome_produto" value="<?php if(isset($dados_produto['nome'])){echo $dados_produto['nome'];}?>" type="text" class="caixadetexto" maxlength="100" />
                                    
                            <b style="font-weight:normal;margin-left:30px;">  
                                <input name="valor" value="<?php if(isset($dados_produto['preco'])){echo $dados_produto['preco'];}?>" type="text" class="caixadetexto" maxlength="100" /> </b>
                        </p>

                        
                        <p class="legendacaixasdetexto">
                            Descri√ß√£o:
                        </p>
                        <p>
                            <textarea name="descricao" class="caixadetexto" cols="40" rows="5" style="width:660px;"><?php if(isset($dados_produto['descricao'])){echo $dados_produto['descricao'];}?></textarea>
                        </p>
                        
                        
                        <p class="legendacaixasdetexto">
                            Quantidade em Estoque:
                        </p>
                        <p>
                            <input name="estoque" type="text" value="<?php if(isset($dados_produto['estoque'])){echo $dados_produto['estoque'];}?>" class="caixadetexto" maxlength="5" value="" />
                        </p>
                        
						<p class="legendacaixasdetexto">
                            Categoria do Produto: 
                        </p>
                        <p>                                    
                        	<select name="categoria">
                        	  <option value="">Selecione a Categoria</option>
<?php 
	include_once('../../inc/conexao.php');
	
	$resultado = mysql_query('SELECT * FROM categorias ORDER BY categoria');
	
	while($dados = mysql_fetch_array($resultado))
	{
?>
							<option value="<?php echo $dados['idcategoria']?>" <?php if(isset($dados_produto['categoria']) && $dados_produto['categoria'] == $dados['idcategoria']){echo 'selected="selected"';}?>><?php echo $dados['categoria']?></option>
<?php 
	}
?>
                            </select>
                        </p>
                          
                        
								<p class='botaoinseirealterar'>
								<input type='image' src='../../img/btn_inserir.jpg' /> </p>
                                <input type='hidden' name='inserir' value='inserir' />
                        <?php 
                        if(isset($dados_produto['nome']) == '')
                        {
                        ?> 
                        <input name="acao" type="hidden" value="salvar" /> 
                        <?php 
                        }
                        else
                        {
                        ?>
                        <input name="acao" type="hidden" value="atualizar" />
                        <input name="id" type="hidden" value="<?php echo $dados_produto['id']?>" />
                        <?php
                        } 
                        ?>

                    </form>
                    <p class="linhadivisoriacentro">
                        <img alt="Linha Diviss√£o" src="../../img/linha-divisoria-centro.png" /></p>
                        
                        
                        
                        
                    <p class="descricao">
                        Lista de Produtos cadastrados:</p>
                        
<?php 
	include_once('../../inc/conexao.php');
	
// Inicio ConfiguraÁ„o da PaginaÁ„o
	if(isset($_GET['pagina']))
	{
		$pagina = $_GET['pagina'];
	}
	else
	{
		$pagina = 1;
	}
	
	$numero_resultados = 15; // resultados por p·gina
	$inicio = ($pagina*$numero_resultados)-$numero_resultados;
// fim ConfiguraÁ„o da PaginaÁ„o

	$resultado = mysql_query("SELECT * FROM produtos ORDER BY nome LIMIT $inicio, $numero_resultados");
	
	while($dados = mysql_fetch_array($resultado))
	{
?>
                    <!--  Inicio repetiÁ„o -->
                    <div class="adm_cadastrados">
                        <p class="adm_cadastrados"> 
                        	<?php echo $dados['nome']?>
	                       </p>
                            
                        <div class="botao_Edt_Exc">
                        	<form action="index.php" method="post" name="excluir">
	                            <input type="image" src="../../img/btn_excluir.jpg" />
                                <input type='hidden' name='id' value='<?php echo $dados['id']?>' />
                                <input type='hidden' name='excluir' value='excluir' />
                                <input name="acao" type="hidden" value="excluir" />
							</form>
                        </div>
                        <div class="botao_Edt_Exc">
                        	<form action="index.php" method="post" name="editar" >
	                            <input type="image" src="../../img/btn_editar.jpg" />
                                <input type='hidden' name='id' value='<?php echo $dados['id']?>' />
                                <input type='hidden' name='editar' value='editar' />
                                <input name="acao" type="hidden" value="localizar" />
							</form>
                        </div>
                        <!--  fim repetiÁ„o -->
                                                
                        <div class="linha">
                            <img alt="Linha Diviss√£o" src="../../img/linha-divisoria-centro.png" />
                        </div>
                    </div>
<?php 
	}
?>
                    <div class="paginacao">
<?php 
	$resultado = mysql_query("SELECT * FROM produtos ORDER BY produto");
	$num_total_registros = mysql_affected_rows();
	$quant_paginas = ceil($num_total_registros/$numero_resultados);
	$links = 5; // Quantidade de Links na PaginaÁ„o
	
	for($i = $pagina-$links; $i <= $pagina-1; $i++)
	{
		if($i > 0)
		{
?>
			<a href="index.php?pagina=<?php echo $i?>"><?php echo $i?></a> | 						
<?php
		} 
	}
	
	echo $pagina.' | ';
	
	for($i = $pagina+1; $i <= $pagina+$links; $i++)
	{
		if($i <= $quant_paginas)
		{
?>
		<a href="index.php?pagina=<?php echo $i?>"><?php echo $i?></a> |
<?php 
		}
	}
?>
					</div>
                    
                </div>
            </div>
            <div id="Rodape"> 
            </div>
        </div>
    </div>
</body>
</html>