<?php

/*
** Arquivo que inclui todas as funчѕes do diretѓrio "funcoes/"
*/

//este script щ incluэdo na index, por isso deve-se adicionar "libs/" р definiчуo do diretѓrio
$dir = "libs" . BARRA . "funcoes" . BARRA;

$open = opendir ($dir);
while (($file = readdir ($open)) !== false)
{
	if ($file == "." || $file == "..")
	    continue;
	require_once $dir . $file;
}
closedir ($open);
?>