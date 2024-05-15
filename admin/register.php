/* 
Se incluye el archivo de base de datos
Se inicia la sesión php
Se procesa los datos del formulario registro
*/
<?php require_once 'db_con.php';
session_start();
if (isset($_POST['register'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$c_password = $_POST['c_password'];

/*
Aquí empieza la sentencia del envio del correo con la contraseña predeterminada
*/
// Verificar campos obligatorios y validar
/*$input_error = array();
// ... Código de validación existente ...

// Función para generar una contraseña aleatoria
function generarContraseñaAleatoria($longitud = 8) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $contraseña = '';
    for ($i = 0; $i < $longitud; $i++) {
        $contraseña .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $contraseña;
}

// Generar una contraseña predeterminada aleatoria
$contraseñaPredeterminada = generarContraseñaAleatoria();

// Envía correo electrónico con la contraseña predeterminada
$subject = "Contraseña Predeterminada";
$message = "Estimado $name,\n\nTu contraseña predeterminada es: $contraseñaPredeterminada\n\nPor favor, cámbiala después de iniciar sesión.";
$headers = "From: tuemail@tudominio.com";

if (mail($email, $subject, $message, $headers)) {
	// Correo electrónico enviado con éxito, continuar con la inserción de datos en la base de datos

	// Insertar datos en la base de datos
	$password = sha1(md5($password));
	$query = "INSERT INTO `users`(`name`, `email`, `username`, `password`, `photo`, `status`) VALUES ('$name', '$email', '$username', '$password','$photo_name','inactivo');";
	$result = mysqli_query($db_con, $query);
	if ($result) {
		move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo_name);
		header('Location: register.php?insert=sucess');
	} else {
		header('Location: register.php?insert=error');
	}
} else {
	// Error al enviar correo electrónico
	echo "Error al enviar el correo electrónico.";
}

*/
/*
Aquí termina la sentencia del envio del correo con la contraseña predeterminada
*/

/* se obtiene la extención por la fotografía*/
	$photo = explode('.', $_FILES['photo']['name']);
	$photo = end($photo);
	$photo_name = $username . '.' . $photo;

	/*Validación de los campos del formulario*/
	$input_error = array();
	if (empty($name)) {
		$input_error['name'] = "Es necesario llenar el campo de Nombre";
	}
	if (empty($email)) {
		$input_error['email'] = "Es necesario llenar el campo de Correo";
	}
	if (empty($username)) {
		$input_error['username'] = "Debes llenar el campo de usuario";
	}
	if (empty($password)) {
		$input_error['password'] = "Debes llenar el campo de contraseña";
	}
	if (empty($photo)) {
		$input_error['photo'] = "La fotografía es un campo requerido";
	}
/*Validación de coincidencia de contraseña*/
	if (!empty($password)) {
		if ($c_password !== $password) {
			$input_error['notmatch'] = "Has ingresado mal la contraseña!";
		}
	}
	/*Verificación de disponibilidad del correo y el nombre de usuario */
	if (count($input_error) == 0) {
		$check_email = mysqli_query($db_con, "SELECT * FROM `users` WHERE `email`='$email';");

		if (mysqli_num_rows($check_email) == 0) {
			$check_username = mysqli_query($db_con, "SELECT * FROM `users` WHERE `username`='$username';");
			if (mysqli_num_rows($check_username) == 0){

				/*Validación de longitud del nombre y la contraseña del usuario*/

				if (strlen($username) > 7) {
					if (strlen($password) > 7) {
						/*Cifrado de la contraseña*/
						$password = sha1(md5($password));
						/*Inserción de datos a la Base de Datos de cada uno de los campos*/
						$query = "INSERT INTO `users`(`name`, `email`, `username`, `password`, `photo`, `status`) VALUES ('$name', '$email', '$username', '$password','$photo_name','inactivo');";
						$result = mysqli_query($db_con, $query);
						if ($result) {
							move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo_name);
							header('Location: register.php?insert=sucess');
						} else {
							header('Location: register.php?insert=error');
						}
					} else {
						$passlan = "Esta contraseña debe contener al menos 8 caracteres";
					}
				} else {
					$usernamelan = 'Este nombre de usuario debe contener al menos 8 caracteres';
				}
			} else {
				$username_error = "Este usuario ya fue utilizado, intenta con uno diferente";
			}
		} else {
			$email_error = "El correo existe actualmente";
		}
	}
}

?>
<!doctype html>
<html lang="en">

<head>
	<!-- Se requiere archivos de metadatos-->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Hojas de estilo de bootstrap y css -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title>Registro de Usuarios</title>
</head>

<body>
	<!-- Ingreso al Registro de Usuarios -->
	<div class="container"><br>
		<h1 class="text-center">Registro de Usuarios</h1>
		<hr><br>
		<div class="d-flex justify-content-center">
			<?php
			/*Mensaje de confirmación de registro Exitoso*/
			if (isset($_GET['insert'])) {
				if ($_GET['insert'] == 'sucess') {
					echo '<div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-success fade hide" data-delay="2000">Tus datos han sido ingresados exitósamente</div>';
				}
			}; ?>
		</div>
		/*Formulario de Registro y procesamiento del mismo*/
		<div class="row animate__animated animate__pulse">
			<div class="col-md-8 offset-md-2">
				<form method="POST" enctype="multipart/form-data">
					<div class="form-group row">
						<div class="col-sm-6">
							<input type="text" class="form-control" value="<?= isset($name) ? $name : '' ?>" name="name" placeholder="Nombre" id="inputEmail3"><?= isset($input_error['name']) ? '<label for="inputEmail3" class="error">' . $input_error['name'] . '</label>' : '';  ?>
						</div>
						<div class="col-sm-6">
							<input type="email" class="form-control" value="<?= isset($email) ? $email : '' ?>" name="email" placeholder="Correo" id="inputEmail3"><?= isset($input_error['email']) ? '<label class="error">' . $input_error['email'] . '</label>' : '';  ?>
							<?= isset($email_error) ? '<label class="error">' . $email_error . '</label>' : '';  ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-4">
							<input type="text" name="username" value="<?= isset($username) ? $username : '' ?>" class="form-control" id="inputPassword3" placeholder="Usuario"><?= isset($input_error['usrname']) ? '<label class="error">' . $input_error['username'] . '</label>' : '';  ?><?= isset($username_error) ? '<label class="error">' . $username_error . '</label>' : '';  ?><?= isset($usernamelan) ? '<label class="error">' . $usernamelan . '</label>' : '';  ?>
						</div>
						<div class="col-sm-4">
							<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Contraseña"><?= isset($input_error['password']) ? '<label class="error">' . $input_error['password'] . '</label>' : '';  ?> <?= isset($passlan) ? '<label class="error">' . $passlan . '</label>' : '';  ?>
						</div>
						<div class="col-sm-4">
							<input type="password" name="c_password" class="form-control" id="inputPassword3" placeholder="Confirmar Contraseña"><?= isset($input_error['notmatch']) ? '<label class="error">' . $input_error['notmatch'] . '</label>' : '';  ?> <?= isset($passlan) ? '<label class="error">' . $passlan . '</label>' : '';  ?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3"><label for="photo">Escoge tu fotografía</label></div>
						<div class="col-sm-9">
							<input type="file" id="photo" name="photo" class="form-control" id="inputPassword3">
							<br>
						</div>
					</div>
					<div class="text-center">
						<button type="submit" name="register" class="btn btn-danger">Registro</button>
					</div>
			</div>
			</form>
		</div>
	</div>
	<p>Si tienes una cuenta de acceso administrativo, puedes <a href="login.php">Ingresar Aquí</a></p>
	</div>
	<!-- Archivos opcionales de Javascript -->
	<!-- Primero jQuery , luego Popper.js, y por ultimo Bootstrap JS -->
	<script src="../js/jquery-3.5.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('.toast').toast('show')
	</script>
</body>

</html>