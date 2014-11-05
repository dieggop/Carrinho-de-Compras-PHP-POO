<?php

function Erro1005 ($tb_name = NULL)
{
	if ($tb_name != NULL)
	    echo "Não foi possível criar a tabela <strong>" . $tb_name ."</strong>";
	else
	    echo "Erro ao criar a tabela";
}

function Erro1006 ($db_name = NULL)
{
	if ($db_name != NULL)
	    echo "Não foi possível criar o banco de dados <strong>" . $db_name ."</strong>";
	else
	    echo "Erro ao criar o banco de dados";
}

function Erro1007 ($db_name = NULL)
{
	if ($db_name != NULL)
	    echo "O banco de dados <strong>" . $db_name ."</strong> já existe.";
	else
	    echo "Esse banco de dados já existe.";
}

function Erro1040 ()
{
	echo "Número máximo de conexões excedido.";
}

function Erro1045 ($username = NULL)
{
	if ($username != NULL)
	    echo "Acesso negado para o usuário <strong>" . $username . "</strong>";
	else
	    echo "Acesso ao banco de dados negado.";
}

function Erro1046 ()
{
	echo "Nenhum banco de dados selecionado.";
}

function Erro1048 ($column_name = NULL)
{
	if ($column_name != NULL)
	    echo "A coluna <strong>" . $column_name . "</strong> não pode ser nula (null)";
	else
	    echo "A coluna não pode ser nula (null).";
}

function Erro1049 ($db_name = NULL)
{
	if ($db_name != NULL)
	    echo "O banco de dados <strong>" . $db_name . "</strong> não foi encontrado";
	else
	    echo "Banco de dados não encontrado.";
}

function Erro1050 ($tb_name = NULL)
{
	if ($tb_name != NULL)
	    echo "A tabela <strong>" . $tb_name . "</strong> já existe";
	else
	    echo "Tabela já existente.";
}

function Erro1051 ($tb_name = NULL)
{
	if ($tb_name != NULL)
	    echo "A tabela <strong>" . $tb_name . "</strong> não foi encontrada";
	else
	    echo "Tabela não encontrada.";
}

function Erro1062 ($field_name = NULL)
{
	if ($field_name != NULL)
	    echo "Entrada duplicada para o campo  <strong>" . $field_name . "</strong>";
	else
	    echo "Entrada duplicada em chave única";
}

function Erro1065 ()
{
	echo "Consulta (query) vazia.";
}

function Erro1146 ($tb_name = NULL)
{
	if ($tb_name != NULL)
	    echo "A tabela <strong>" . $tb_name . "</strong> não foi encontrada";
	else
	    echo "Tabela não encontrada.";
}

function Erro2000 ()
{
	echo "Erro desconhecido do MySQL.";
}

function Erro2003 ($host = NULL)
{
	if ($host != NULL)
	    echo "Impossível conectar ao servidor MySQL em <strong>" . $host . "</strong>";
	else
	    echo "Impossível conectar ao servidor MySQL.";
}

function Erro2005 ($host = NULL)
{
	if ($host != NULL)
	    echo "O servidor <strong>" . $host . "</strong> não foi encontrado";
	else
	    echo "Servidor não encontrado";
}

function Erro2013 ()
{
	echo "A conexão com o MySQL foi perdida durante a consulta SQL.";
}


?>