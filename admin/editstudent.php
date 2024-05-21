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
    
    $id = base64_decode($_GET['id']);
    $oldPhoto = base64_decode($_GET['photo']);
/*Se obtienen o se extraen los parámetros de la URL id y photo */

  if (isset($_POST['updatestudent'])) {
/*
se verifica si se ha enviado el formulario con el botón "updatestudent"
si existe la solicitud, significa que ha sido enviado
*/
  	$name = $_POST['name'];
  	$roll = $_POST['roll'];
  	$sede = $_POST['sede'];
  	$pcontact = $_POST['pcontact'];
  	$class = $_POST['class'];
/* Se recuperan los datos del formulario enviados por el post */
  	
  	if (!empty($_FILES['roll']['name'])) {
  		 $roll = $_FILES['roll']['name'];
	  	 $roll = explode('.', $roll);
		 $roll = end($roll); 
		 $roll = $roll.date('Y-m-d-m-s').'.'.$roll;
  	}else{
  		$photo = $oldPhoto;
  	}
/* Manejo de la foto del estudiante */

  	$query = "UPDATE `student_info` SET `name`='$name',`roll`='$roll',`class`='$class',`sede`='$sede',`pcontact`='$pcontact',`photo`='$photo' WHERE `id`= $id";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">Student Updated!</p>';
		if (!empty($_FILES['photo']['name'])) {
			move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo);
			unlink('images/'.$oldPhoto);
		}	
  		header('Location: index.php?page=all-student&edit=success');
  	}else{
  		header('Location: index.php?page=all-student&edit=error');
  	}
  }
/* Primero de construye la consulta a SQL para acualizar los datos del estudiante
Luego se ejecuta la consulta SQl, si fue exitosa se siguen los pasos, de lo contrario se maneja el error
Sí la actualización fue exitosa se establece un mensaje de éxito */
?>

<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Editar Información de Estudiante<small class="text-warning"> Editar</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
     <li class="breadcrumb-item" aria-current="page"><a href="index.php?page=all-student">Todos los Estudiantes </a></li>
     <li class="breadcrumb-item active" aria-current="page">Agregar Estudiante</li>
  </ol>
</nav>
<!-- Se realiza un menú para la navegación del sistema -->

	<?php
		if (isset($id)) {
			$query = "SELECT `id`, `name`, `roll`, `class`, `sede`, `pcontact`, `photo`, `datetime` FROM `student_info` WHERE `id`=$id";
			$result = mysqli_query($db_con,$query);
			$row = mysqli_fetch_array($result);
		}
	 ?>
<div class="row">
<div class="col-sm-6">
	<form enctype="multipart/form-data" method="POST" action="">
		<div class="form-group">
			<!-- campo para editar al estudiante en sus respectivos campos -->

		    <label for="name">Nombre de Estudiante</label>
		    <input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" required="">
	  	</div>
	  	<div class="form-group">
		    <label for="roll">Número de Cédula</label>
		    <input name="roll" type="text" class="form-control" pattern="[0-9]{9}" id="roll" value="<?php echo $row['roll']; ?>" required="" oninvalid="this.setCustomValidity('Formato no establecido, vuelva a intentarlo')" oninput="this.setCustomValidity('')">
	  	</div>

		  <div class="form-group">
		    <label for="sede">Sede del Estudiante</label>
		    <select name="sede" class="form-control" id="sede" required="" value="">
		    	<option>Select</option>
		    	<option value="Alajuelita, Concepción" <?= $row['sede']=='Alajuelita, Concepción'? 'selected':'' ?>>Alajuelita, Concepción</option>
		    	<option value="Hatillo, 25 de Julio" <?= $row['sede']=='Hatillo, 25 de Julio'? 'selected':'' ?>>Hatillo, 25 de Julio</option>
		    	<option value="Desamparados, Linda Vista" <?= $row['sede']=='Desamparados, Linda Vista'? 'selected':'' ?>>Desamparados, Linda Vista</option>
		    </select>
	  	</div>
	  	
	  	<div class="form-group">
		    <label for="pcontact">Número de Contacto</label>
		    <input name="pcontact" type="text" class="form-control" id="pcontact" value="<?php echo $row['pcontact']; ?>" pattern="[0-9]{8}" placeholder="+506..." required="" oninvalid="this.setCustomValidity('Formato no establecido, vuelva a intentarlo')" oninput="this.setCustomValidity('')">
	  	</div>
	  	<div class="form-group">
		    <label for="class">Matricula del Curso interactivo</label>
		    <select name="class" class="form-control" id="class" required="" value="">
		    	<option>Select</option>
		    	<option value="Computación" <?= $row['class']=='Computación'? 'selected':'' ?>>Computación</option>
		    	<option value="Robótica" <?= $row['class']=='Robótica'? 'selected':'' ?>>Robótica</option>
		    	<option value="Programación" <?= $row['class']=='Programación'? 'selected':'' ?>>Programación</option>
		    	<option value="Excel Basico" <?= $row['class']=='Excel Basico'? 'selected':'' ?>>Excel Basico</option>
		    	<option value="Excel Avanzado" <?= $row['class']=='Excel Avanzado'? 'selected':'' ?>>Excel Avanzado</option>
		    </select>
	  	</div>
	  	<div class="form-group">
		    <label for="photo">Fotografía</label>
		    <input name="photo" type="file" class="form-control" id="photo">
	  	</div>
	  	<div class="form-group text-center">
		    <input name="updatestudent" value="Editar Estudiante" type="submit" class="btn btn-danger">
	  	</div>
		<!-- La funciones permiten editar los datos de los estudiantes en sus respectivos campos -->
	 </form>
</div>
</div>
