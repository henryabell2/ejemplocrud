<?php

if ($_POST)
{
	require("mysql.php"); 
	include("validador.php");
	$pdo = new db();
	$id_contacto = $_POST["id_contacto"];
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
		$pst = $pdo->mysql->prepare("update contactos set nombres = :nombres, apellidos = :apellidos, direccion = :direccion where id_contacto = :id_contacto");
		$pst->bindParam(":nombres", $nombres, PDO::PARAM_STR);
		$pst->bindParam(":apellidos", $apellidos, PDO::PARAM_STR);
		$pst->bindParam(":direccion", $direccion, PDO::PARAM_STR);
		$pst->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
		$pst->execute();

		$pst = $pdo->mysql->prepare("delete from telefonos where id_contacto = :id_contacto");
		//$pst->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
		$pst->execute(array("id_contacto" => $id_contacto));

		$pst = $pdo->mysql->prepare("insert into telefonos values (null, :id_contacto, :telefono)");
		$pst->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
		$pst->bindParam(":telefono", $telefono, PDO::PARAM_STR);
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
		echo "El contacto no pudo ser actualizado.<br>".$ex->getMessage();
		echo "<a href='#' onclick=javascript:window.history.back()>Regresar</a>"; 
	}
}