<?php

require_once ("libs/classes/cliente.php");
$cliente = new Cliente();

$area = isset($_GET['area']) ? $_GET['area'] : NULL;
$acao = isset($_GET['acao']) ? $_GET['acao'] : NULL;
$objCar = new Carrinho;

if ($area == "logar")
{
	
	
switch ($acao) {
	case "sair":
		unset($_SESSION['usuario_compra']);
		header("location: index.php");
		
		break;
		
	case "logar":
		
			$cliente->ValidaCliente($_POST['login'], $_POST['senha']);
			 
			
	break;
	
	case "salvar":
		
		
	echo $cliente->AdicionarCliente($_POST['nome'], $_POST['cpf'], $_POST['endereco'], $_POST['telefone'], $_POST['data_nascimento'], $_POST['email'], $_POST['senha']);
		
		
		
	break;
	case "cadastro":

		print '<p style="margin:15px 0 0 22px;">Para poder fazer compras voc&ecirc; tem que se cadastrar para tal preencha o formul&aacute;rio abaixo:</p>
                    
				<form name="" method="post" action="?area=logar&acao=salvar"> 
	                	<fieldset style="border:0px; margin:10px 0 0 32px;">
	                		<p>
	                			<label> Nome: </label> 
	                			<label style="margin-left: 175px;"> CPF: </label> 
	                			<br />
	                    		<input name="nome" type="text" class="caixa_texto" />
	                    		<input name="cpf" type="text" class="caixa_texto" />
	                    	</p>
					<p>
	                			<label> Data de Nascimento: </label> 
	                			 
	                			<br />
	                    		<input name="data_nascimento" type="text" class="data_nascimento" /> 
	                    	</p>
	                    	<p>
	                	    	<label>Endere&ccedil;o:</label>
	                	    	 
	                	    	<br />
	                    		<input name="endereco" type="text" class="caixa_texto" />
	                    		 
	                    	</p>
	                    	 
	                    	<p>
	                    		<label>Telefone:</label> 
	                    	 
	                    		<br />
	                    		<input name="telefone" type="text" class="caixa_texto" /> 
	                    	</p>
	                    	<p>
	                			<label> E-mail/Usuário: </label> 
	                			<label style="margin-left: 175px;"> Senha: </label> 
	                			<br />
	                    		<input name="email" type="text" class="caixa_texto" />
	                    		<input name="senha" type="password" class="caixa_texto" />
	                    	</p>
					   		<p style="margin-top: 20px;">
					   			<input type="submit" value="Cadastrar" />
					   			<input name="acao" type="hidden" value="salvar" />
							</p>
	                    </fieldset>
				
				<a href="?area=logar&acao=">Já sou cadastrado, quero fazer o login</a>
	                </form>';
		
	break;
	
	default:

		
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
	
	
}




	
	   
	
}
?>