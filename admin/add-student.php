<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
     }
    }
/*
Verificamos la página actual que esta siendo accedida por el usuario
sí la página no es el index, redirige al usuario a index.php 
*/	

  if (isset($_POST['addstudent'])) {
  	$name = $_POST['name'];
  	$roll = $_POST['roll'];
  	$sede = $_POST['sede'];
  	$pcontact = $_POST['pcontact'];
	  $class = $_POST['class'];

  	$photo = explode('.', $_FILES['photo']['name']);
  	$photo = end($photo); 
  	$photo = $roll.date('Y-m-d-m-s').'$photo';

  	$query = "INSERT INTO `student_info`(`name`, `roll`, `class`, `sede`, `pcontact`, `photo`) VALUES ('$name', '$roll', '$class', '$sede', '$pcontact','$photo');";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">Estudiante Ingresado Exitosamente</p>';
		move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo);
	}else{
  		$datainsert['inserterror']= '<p style="color: red;">Estudiante no ingresado, revise la información diligenciada.</p>';

  	}
  }
/*
Verifica si se ha enviado el formulario mediante el post
si se envio, recupere los valores.
*/

/*
Realizamos la parte del menú de navegación
*/
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Agregar Estudiante<small class="text-warning"> Nuevo Estudiante</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
     <li class="breadcrumb-item active" aria-current="page">Agregar Estudiante</li>
  </ol>
</nav>

<div class="row">
	
<div class="col-sm-6">
		<?php if (isset($datainsert)) {?>
	<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
	  <div class="toast-header">
	    <strong class="mr-auto">Student Insert Alert</strong>
	    <small><?php echo date('d-M-Y'); ?></small>
	    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <div class="toast-body">
	    <?php 
	    	if (isset($datainsert['insertsucess'])) {
	    		echo $datainsert['insertsucess'];
	    	}
	    	if (isset($datainsert['inserterror'])) {
	    		echo $datainsert['inserterror'];
	    	}
/*
Realizamos un insert alert para notificar al usuario de éxito o error en la operación
*/
	    ?> 
	  </div>
	</div>

		<?php } ?>
		<!--Realizamos el llenado de los campos por parte del estudiante o encargado
			una verificando que se cumplan los datos se almacenan en la Base de Datos. -->

	<form enctype="multipart/form-data" method="POST" action="">
		<div class="form-group">
		    <label for="name">Nombre de Estudiante</label>
		    <input name="name" type="text" class="form-control" id="name" value="<?= isset($name)? $name: '' ; ?>" required="">
	  	</div>
	  	<div class="form-group">
		    <label for="roll">Número de Cédula</label>
		    <input name="roll" type="text" value="<?= isset($roll)? $roll: '' ; ?>" class="form-control" pattern="[0-9]{9}" id="roll" required=""oninvalid="this.setCustomValidity('Formato no establecido, vuelva a intentarlo')" oninput="this.setCustomValidity('')">
	  	</div>
		
	  	
		<div class="form-group">
		    <label for="sede">Sede del Estudiante</label>
		    <select name="sede" class="form-control" id="sede" required="">
		    	<option>Selecciona</option>
		    	<option value="Alajuelita, Concepción">Alajuelita, Concepción</option>
		    	<option value="Hatillo, 25 de Julio">Hatillo, 25 de Julio</option>
		    	<option value="Desamparados, Linda Vista">Desamparados, Linda Vista</option>
		    </select>
	  	</div>

	  	<div class="form-group">
		    <label for="pcontact">Teléfono de Contacto</label>
		    <input name="pcontact" type="text" class="form-control" id="pcontact" pattern="[0-9]{8}" value="<?= isset($pcontact)? $pcontact: '' ; ?>" placeholder="+506........" required="" oninvalid="this.setCustomValidity('Formato no establecido, vuelva a intentarlo')" oninput="this.setCustomValidity('')">
	  	</div>
	  	<div class="form-group">
		    <label for="class">Centros interactivos para matricular</label>
		    <select name="class" class="form-control" id="class" required="">
		    	<option>Selecciona</option>
		    	<option value="Computación">Computación</option>
		    	<option value="Robótica">Robótica</option>
		    	<option value="Programación">Programación</option>
		    	<option value="Excel Basico ">Excel Basico </option>
		    	<option value="Excel Avanzado">Excel Avanzado</option>
		    </select>
	  	</div>
	  	<div class="form-group">
		    <label for="photo">Fotografía de Estudiante</label>
		    <input name="photo" type="file" class="form-control" id="photo" required="">
	  	</div>
	  	<div class="form-group text-center">
		    <input name="addstudent" value="Agregar Estudiante" type="submit" class="btn btn-danger">
	  	</div>
	 </form>
</div>
</div>