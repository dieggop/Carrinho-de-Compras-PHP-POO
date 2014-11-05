<?php

function ArrayCarrinho()
{
	if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho']) || (count ($_SESSION['carrinho']) == 0))
	    return array();
	    
	$cods = array();
	$carro = isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : array();
	foreach ($carro as $k => $v)
    {
	    $cods[$k] = $v['id'];
    }
    return $cods;
}
?>