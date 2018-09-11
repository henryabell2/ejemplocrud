<?php

function validarTelefono(string $telefono): int
{
	return preg_match("/^[9][0-9]{8}$/", $telefono);
	/* "/^[9|6|7][0-9]{8}$/" */
}

function verificarTelefonos(array $telefonos):array
{
	$numeroInvalido = [];
	$i = 0;
	foreach($telefonos as $telefono)
	{
		if(!validarTelefono($telefono))
		{
			$numeroInvalido[$i] = $telefono;
			$i++;
		}
	}
	return $numeroInvalido;
	
}