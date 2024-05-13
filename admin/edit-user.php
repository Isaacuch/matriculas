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
  if (isset($_POST['userupdate'])) {
  	$name = $_POST['name'];
  	$email = $_POST['email'];


  	$query = "UPDATE `users` SET `name`='$name', `email`='$email' WHERE `id`= $id";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">Usuario actualizado exitósamente</p>';
  		header('Location: index.php?page=user-profile&edit=success');
  	}else{
  		header('Location: index.php?page=user-profile&edit=error');
  	}
  }
/*
 Actualización de la información de un usuario en la base de datos 
*/
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Editar Información de Usuario<small class="text-warning"> Editar Usuario</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
     <li class="breadcrumb-item" aria-current="page"><a href="index.php?page=user-profile">Perfil de Usuario </a></li>
     <li class="breadcrumb-item active" aria-current="page">Editar Perfil de Usuario</li>
  </ol>
</nav>
/*
Menú de navegación de la pagina
*/
	<?php
		if (isset($id)) {

			$query = "SELECT  `name`, `email` FROM `users` WHERE `id`=$id;";
			$result = mysqli_query($db_con,$query);
			$row = mysqli_fetch_array($result);
		}
	 ?>
/*
Metodo de editar el usuario administrador por medio del post
*/
<div class="row">
<div class="col-sm-6">
	<form enctype="multipart/form-data" method="POST" action="">
		<div class="form-group">
		    <label for="name">Nombre Completo</label>
		    <input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" required="">
	  	</div>
	  	<div class="form-group">
		    <label for="email">Correo Electrónico</label>
		    <input name="email" type="email" class="form-control"  id="email" value="<?php echo $row['email']; ?>" required="">
	  	</div>
	  	
	  	<div class="form-group text-center">
		    <input name="userupdate" value="Actualizar Perfil" type="submit" class="btn btn-danger">
	  	</div>
	 </form>
/*
Se puede actualizar el Nombre y el correo pero la contraseña solo se podra restablecer 
por medio de la base de datos a nivel interno, esto con fin ofrecer mayor seguridad al sistema
*/
</div>
</div>