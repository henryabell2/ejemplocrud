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
   	<!--  -->
	

    <div class="container">
    	<h1 align="center">Agenda</h1>
    	<a href="nuevoContacto.php" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Nuevo Contacto</a>
    </div>
   	<!--  -->
	<div class="container">
		<table class="table table-hover">
			 <thead>
			   <tr class="table-active">
				<!-- Agregado colspan="2" --> 
					<th scope="col">#</th>
					<th scope="col">Apellidos</th>
					<th scope="col">Nombres</th>
					<th scope="col">Dirección</th>
					<th scope="col">Teléfonos</th>
      				<th colspan="2">Opción</th>
			    </tr>
			</thead>
			  <tbody>
				<?php
					require("mysql.php");
					$pdo = new db();
					$contactos = $pdo->mysql->query("select * from contactos");
					foreach($contactos as $contacto)
					{
						$telefonos = $pdo->mysql->query("select telefono from telefonos where id_contacto = {$contacto['id_contacto']}");
								echo "<tr>

							    <td>{$contacto['id_contacto']}</td>
								<td>{$contacto['apellidos']}</td>
								<td>{$contacto['nombres']}</td>
								<td>{$contacto['direccion']}</td>";
							echo "<td>";
							foreach($telefonos as $telefono)
							{	
								echo "<li>{$telefono['telefono']}</li>";
							}
							echo "</td>";
							echo "<td><a href='modificarContacto.php?id_contacto={$contacto['id_contacto']}'>Modificar</a>
									</td>
							<td><a href='eliminarContacto.php?id_contacto={$contacto['id_contacto']}'>Eliminar</a></td>";
							echo "</tr>";
					}
				?>

			  </tbody>
		</table>	
	</div>	
</body>
</html>