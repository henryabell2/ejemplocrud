 <?php

 if ($_GET)
 {
 	try
 	{
 		require("mysql.php");
 		$pdo = new db();
 		$pdo->mysql->beginTransaction();
 		$id_contacto = $_GET["id_contacto"];
 		$pst = $pdo->mysql->prepare("delete from telefonos where id_contacto = :id_contacto");
		$pst->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
		$pst->execute();

		$pst = $pdo->mysql->prepare("delete from contactos where id_contacto = :id_contacto");
		$pst->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
		$pst->execute();
		$pdo->mysql->commit();
		header("Location:index.php");
 	}
 	catch(PDOException $ex)
 	{
 		echo "El contacto no pudo ser eliminado.";
 		$pdo->mysql->rollback();
 	}
 }