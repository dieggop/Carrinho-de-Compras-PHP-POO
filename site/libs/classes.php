<?php

/*
** Arquivo que inclui todas as classes do diretуrio "classes/"
*/

//este script й incluнdo na index, por isso deve-se adicionar "libs/" а definiзгo do diretуrio
$dir = "libs" . BARRA . "classes" . BARRA;

$open = opendir ($dir);
while (($file = readdir ($open)) !== false)
{
	if ($file == "." || $file == "..")
	    continue;
	require_once ($dir . $file);
}
closedir ($open);
?>