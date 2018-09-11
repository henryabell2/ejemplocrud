 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PDO SASS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="dist/css/bootstrap.css.">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" href="">

</head>
<body>
	<div class="container-fluid bg-primary py-5">
      <div class="container text-white" align="center">
        <h1 class="display-1"><b>PDO</b></h1>
        <p class="lead">SASS utilizando BOOTSTRAP 4</p>
      </div>
    </div>
    	<hr>

    <div class="container">
    	<h1>Modificar Contacto</h1>
    	<!-- Inicio Formulario --> 
		<form method="post" action="actualizarContacto.php">
<?php
require("mysql.php");
$pdo = new db();
try
{
	$id_contacto = $_GET["id_contacto"];
	$datosContacto = $pdo->mysql->prepare("select * from contactos where id_contacto = :id_contacto");
	$datosContacto->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
	$datosContacto->execute();
	$contacto = $datosContacto->fetch();

	$telefonos = $pdo->mysql->prepare("select telefono from telefonos where id_contacto = :id_contacto");
	$telefonos->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
	$telefonos->execute();
	$telefonos = $telefonos->fetchAll();
}
catch(PDOException $e)
{
	print_r($e->getMessage());
}
?>
		  <div class="form-group col-md-6">
		     	<label>ID</label>
		      	<!-- Agregado class="form-control --> 
				<input type="text" class="form-control" name="id_contacto" value="<?php echo $id_contacto; ?>" readonly=true>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		     	<label>Nombres</label>
		      	<!-- Agregado class="form-control --> 
				<input type="text" class="form-control" name="nombres" required="true" maxlength="50" minlength="3" placeholder="Nombres" value="<?php echo $contacto['nombres']; ?>">
	
		    </div>

		    <div class="form-group col-md-6">
		     	<label>Apellidos</label>
		      	<!-- class="form-control --> 
				<input type="text" class="form-control" name="apellidos" required="true" maxlength="50" minlength="3" placeholder="Apellidos" value="<?php echo $contacto['apellidos']; ?>">
		    </div>
		  </div>

		  <div class="form-group">
		    <label>Direccion</label>
		    <input type="text" class="form-control" name="direccion" required="true" maxlength="50" minlength="5" placeholder="Dirección"value="<?php echo $contacto['direccion']; ?>">
		  </div>
		  <div class="form-group">
		    <label>Teléfonos (separados por comas)</label>
<!--
			<input type="text" class="form-control" name="telefonos" required="true" maxlength="256" minlength="9" placeholder="9########">
-->
		  	<textarea name="telefonos" cols="40" placeholder="9########" maxlength="50"><?php 
		$total = count($telefonos);
		$i = 0;
		foreach($telefonos as $telefono)
		{
			echo $telefono['telefono'];
			$i++;
			if ($i != $total)
			{
				echo ", ";
			}
		} 
		?></textarea>
    	<!-- Fin Formulario --> 
    </div>
		  <button type="submit" class="btn btn-success" value="Guardar">Actualizar</button>
			<a href="index.php" class="btn btn-warning" tabindex="-1" role="button" aria-disabled="true">Volver</a>
		<hr>
</body>
</html>