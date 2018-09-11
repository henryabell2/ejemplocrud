<?php

if ($_POST)
{
	require("mysql.php"); 
	include("validador.php");
	$pdo = new db();
	$nombres = $_POST["nombres"];
	$apellidos = $_POST["apellidos"];
	$direccion = $_POST["direccion"];
	$telefonos = str_replace(" ", "", $_POST["telefonos"]);
	$cadaTelefono = explode(",", $telefonos);
	$numerosInvalidos = verificarTelefonos($cadaTelefono);

	if(count($numerosInvalidos))
	{
		echo "Los siguientes números de teléfono son inválidos:";
		foreach($numerosInvalidos as $n)
		{
			echo "<li>$n</li>";
		}
		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
		exit();
	}

	try
	{
		$pdo->mysql->beginTransaction();
		$pst = $pdo->mysql->prepare("insert into contactos values (null, :nombres, :apellidos, :direccion)");
		$pst->bindParam(":nombres", $nombres, PDO::PARAM_STR);
		$pst->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
		$pst->bindParam(":direccion", $direccion, PDO::PARAM_STR);
		$pst->execute();

		$id_contacto = $pdo->mysql->lastInsertId();

		$pst = $pdo->mysql->prepare("insert into telefonos values (null, {$id_contacto}, :telefono)");
		$pst->bindParam(":telefono", $telefono, PDO::PARAM_STR);
		//$pst->bindValue(":telefono", $telefono, PDO::PARAM_STR);
		foreach($cadaTelefono as $t)
		{
			$telefono = $t;
			$pst->execute();
		}
		$pdo->mysql->commit();
		header("Location:index.php");
	}
	catch(PDOException $ex)
	{
		$pdo->mysql->rollback();
		echo "El contacto no pudo ser guardado.";
		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}

}