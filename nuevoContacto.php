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
    	<h1>Nuevo Contacto</h1>
    	<!-- Inicio Formulario --> 
		<form method="post" action="guardarContacto.php">
		  <div class="form-row">
		    <div class="form-group col-md-6">
		     	<label>Nombres</label>
		      	<!-- Agregado class="form-control --> 
				<input type="text" class="form-control" name="nombres" required="true" maxlength="50" minlength="3" placeholder="Nombres">
		    </div>

		    <div class="form-group col-md-6">
		     	<label>Apellidos</label>
		      	<!-- class="form-control --> 
				<input type="text" class="form-control" name="apellidos" required="true" maxlength="50" minlength="3" placeholder="Apellidos">
		    </div>
		  </div>

		  <div class="form-group">
		    <label>Direccion</label>
		    <input type="text" class="form-control" name="direccion" required="true" maxlength="50" minlength="5" placeholder="Dirección">
		  </div>
		  <div class="form-group">
		    <label>Teléfonos (separados por comas)</label>
			<input type="text" class="form-control" name="telefonos" required="true" maxlength="256" minlength="9" placeholder="9########">
		  </div>

		  <button type="submit" class="btn btn-primary" value="Guardar">Guardar</button>
		  <button type="reset" class="btn btn-danger" value="Cancelar">Limpiar</button>
		</form> 
    	<!-- Fin Formulario --> 
    </div>

		<hr>
</body>
</html>