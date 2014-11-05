<?php

class MySQLiConnection extends mysqli
{
	
	/*
	   Funчуo __construct()
	 */
	
	public function __construct()
	{
		try
		{
			//Executa @mysqli_connect (DB_SERVIDOR, DB_USUARIO, DB_SENHA, DB_NOME);
			@parent::__construct (DB_SERVIDOR, DB_USUARIO, DB_SENHA, DB_NOME);
			
			if (mysqli_connect_errno() != 0)//se a conexуo falhar
			    throw new Exception (mysqli_connect_errno() . " - " . mysqli_connect_error());
		}
		catch (Exception $db_error)
		{
			$mensagem = $db_error->getMessage();
			$arquivo = $db_error->getFile();
			$data = date ("Y-m-d H:i:s");
			$ip_visitante = $_SERVER['REMOTE_ADDR'];
			
			if (!file_exists (LOGS_PATH))
			    mkdir (LOGS_PATH);
			
			// mensagem que serс salva no arquivo de logs do banco de dados
			$log = $data . " | " . $mensagem . " | " . $arquivo . " | " . $ip_visitante . "\r\n\r\n";
			error_log ($log, 3, LOGS_PATH . "db_errors.log");
			
			$error_code = mysqli_connect_errno();
			if (function_exists ("Erro".$error_code))
			{
				switch ($error_code)
				{
					case 1045:
					  Erro1045 (DB_USUARIO);
					  break;
					case 1049:
					  Erro1049 (DB_SERVIDOR);
					  break;
					case 2003:
					  Erro2003 (DB_SERVIDOR);
					  break;
					case 2005:
					  Erro2005 (DB_SERVIDOR);
					  break;
					default:
					  call_user_func ("Erro".$error_code);
					  break;
				}
			}
			else
			{
				echo "Erro ao conectar ao banco de dados MySQL. O erro foi reportado e o administrador do sistema tomarс as devidas providъncias.";
			}
			exit;
			
		}
	}
	
	/*
	   Funчуo __destruct()
	 */
	public function __destruct()
	{
		if (mysqli_connect_errno() == 0)// se a conexуo nуo falhou
			$this->close();
	}
	
}

?>