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
				$nome = $_POST['nome'];
				$cpf= $_POST['cpf'];
				$endereco = $_POST['endereco'];
				$telefone = $_POST['telefone'];
				$email = $_POST['email'];
				$senha = $_POST['senha'];
				$data_nascimento = $_POST['data_nascimento'];
				$resultado = mysql_query("INSERT INTO cliente (nome, cpf, endereco, telefone, data_nascimento, login, senha) VALUES ('$nome', '$cpf', '$endereco',  '$telefone', '$data_nascimento', '$email', '$senha')");
				
				if($resultado)
				{
					echo 'Cadastro realizado com sucesso.';
				}
				else
				{
					echo 'Seu cadastro não pode ser realizado.';
				}
				
				break;
			case 'localizar':
				$id = $_POST['id'];
				
				$resultado = mysql_query("SELECT * FROM cliente WHERE id_cliente = '$id' ORDER BY nome");
				$dados_clientes = mysql_fetch_array($resultado);
				
				break;
			case 'atualizar':
				$id = $_POST['id'];
				$nome = $_POST['nome'];
				$cpf= $_POST['cpf'];
				$endereco = $_POST['endereco'];
				$telefone = $_POST['telefone'];
				$email = $_POST['email'];
				$senha = $_POST['senha'];
				$data_nascimento = $_POST['data_nascimento'];
				
				$resultado = mysql_query("UPDATE cliente SET nome = '$nome', cpf= '$cpf', endereco = '$endereco', telefone = '$telefone', data_nascimento = '$data_nascimento', login = '$email', senha = '$senha' WHERE id_cliente = '$id'");
				
				if($resultado)
				{
					echo 'Cadastro alterado com sucesso.';
				}
				else
				{
					echo 'Seu cadastro não pode ser alterado.';
				}
				
				break;
			case 'excluir':
				$id = $_POST['id'];
				
				$resultado = mysql_query("DELETE FROM cliente WHERE id_cliente = '$id'");
				
				if($resultado)
				{
					echo 'Cadastro excluido com sucesso.';
				}
				else
				{
					echo 'Seu cadastro não pode ser excluido.';
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
                            <li><a href="#">Produtos
                                <img alt="Seta Sub-menu" border="0" style="margin-left:120px;" src="../../img/seta-menu.jpg" /></a>
                                <ul>
                                    <li><a href="../categoria/index.php">Categorias</a></li>
                                    <li><a href="../produto/index.php">Produtos</a></li>
                                </ul>
                            </li>
                            <li><a href="../pedido/index.php">Pedido de Produtos</a></li>
                            <li><a href="../clientes/index.php"><b>Cadastro de Clientes</b></a></li>
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
                        Cadastro de Clientes</p>
                    <p class="linhadivisoriacentro">
                        <img alt="Linha DivissÃ£o" src="../../img/linha-divisoria-centro.png" /></p>
                    <p class="descricao">
                        Para inserir um produto informe os dados abaixo:</p>
                    <br />
                    <br />
                    <form action="index.php" method="post" name="clientes" enctype="multipart/form-data">
                        <p class="legendacaixasdetexto">
                            Nome do cliente: <b style="font-weight:normal;margin-left:125px;"> CPF </b>
                        </p>
                        <p>
                        	<input name="nome" type="text" class="caixadetexto" maxlength="100" value="<?php if(isset($dados_clientes['nome'])){echo $dados_clientes['nome'];}?>" />
                        	<b style="font-weight:normal;margin-left:30px;">
                        		<input name="cpf" type="text" class="caixadetexto" maxlength="100" value="<?php if(isset($dados_clientes['cpf'])){echo $dados_clientes['cpf'];}?>" />
                        	</b>
                        </p>
                        
                        <p class="legendacaixasdetexto">
                            Endere&ccedil;o: 
                        </p>
                        <p>
                        	<input name="endereco" value="<?php if(isset($dados_clientes['endereco'])){echo $dados_clientes['endereco'];}?>" type="text" class="caixadetexto" maxlength="100" />
                        	 
                        </p>
                        
                         
                        <p class="legendacaixasdetexto">
                            Data Nascimento: </b>
                        </p>
                        <p>
                        	<input name="data_nascimento" value="<?php if(isset($dados_clientes['data_nascimento'])){echo $dados_clientes['data_nascimento'];}?>" type="text" class="caixadetexto" maxlength="100" />
                        	 
                        </p>
                        <p class="legendacaixasdetexto">
                            Email: <b style="font-weight:normal;margin-left:170px;"> Senha</b>
                        </p>
                        <p>
                        	<input name="email" type="text" value="<?php if(isset($dados_clientes['login'])){echo $dados_clientes['login'];}?>" class="caixadetexto" maxlength="100" />
                        	<b style="font-weight:normal;margin-left:30px;">
                        		<input name="senha" type="text" value="<?php if(isset($dados_clientes['senha'])){echo $dados_clientes['senha'];}?>" class="caixadetexto" maxlength="100" />
                        	</b>
                        </p>
						<p class='botaoinseirealterar'>
						<input type='image' src='../../img/btn_inserir.jpg' /> </p>
                        <input type='hidden' name='inserir' value='inserir' />
                        
                         <?php 
                        if(isset($dados_clientes['nome']) == '')
                        {
                        ?> 
                        <input name="acao" type="hidden" value="salvar" /> 
                        <?php 
                        }
                        else
                        {
                        ?> 
                        <input name="acao" type="hidden" value="atualizar" />
                        <input name="id" type="hidden" value="<?php echo $dados_clientes['id_cliente']?>" />
                        <?php
                        } 
                        ?>
                    </form>
                    <p class="linhadivisoriacentro">
                        <img alt="Linha DivissÃ£o" src="../../img/linha-divisoria-centro.png" /></p>
                        
                        
                        
                        
                    <p class="descricao">
                        Lista de Produtos cadastrados:</p>
                        
<?php 
	include_once('../../inc/conexao.php');
	
// Inicio Configuração da Paginação
	if(isset($_GET['pagina']))
	{
		$pagina = $_GET['pagina'];
	}
	else
	{
		$pagina = 1;
	}
	
	$numero_resultados = 15; // resultados por página
	$inicio = ($pagina*$numero_resultados)-$numero_resultados;
// fim Configuração da Paginação

	$resultado = mysql_query("SELECT * FROM cliente ORDER BY nome LIMIT $inicio, $numero_resultados");
	
	while($dados = mysql_fetch_array($resultado))
	{
?>
                    <!--  Inicio repetição -->
                    <div class="adm_cadastrados">
                        <p class="adm_cadastrados"> 
                        	<?php echo $dados['nome']?>
	                       </p>
                            
                        <div class="botao_Edt_Exc">
                        	<form action="index.php" method="post" name="excluir">
	                            <input type="image" src="../../img/btn_excluir.jpg" />
                                <input type='hidden' name='id' value='<?php echo $dados['id_cliente']?>' />
                                <input type='hidden' name='excluir' value='excluir' />
                                <input name="acao" type="hidden" value="excluir" />
							</form>
                        </div>
                        
                        <div class="botao_Edt_Exc">
                        	<form action="index.php" method="post" name="editar" >
	                            <input type="image" src="../../img/btn_editar.jpg" />
                                <input type='hidden' name='id' value='<?php echo $dados['id_cliente']?>' />
                                <input type='hidden' name='editar' value='editar' />
                                <input name="acao" type="hidden" value="localizar" />
							</form>
                        </div>
                        <!--  fim repetição -->
                           
                        <div class="linha">
                            <img alt="Linha DivissÃ£o" src="../../img/linha-divisoria-centro.png" />
                        </div>
                    </div>
<?php 
	}
?>
	                    
                    <div class="paginacao">
<?php 
	$resultado = mysql_query("SELECT * FROM cliente ORDER BY nome");
	$num_total_registros = mysql_affected_rows();
	$quant_paginas = ceil($num_total_registros/$numero_resultados);
	$links = 5; // Quantidade de Links na Paginação
	
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
            <br></br>
            </div>
        </div>
    </div>
</body>
</html>