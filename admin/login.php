<?php require_once 'db_con.php';
/* Archivo que contiene la configuración y conexión a base de datos */
session_start();
if (isset($_SESSION['user_login'])) {
	header('Location: index.php');
	/*Se reanuda o inicia sesión y se regirige al usuarios a Index.php */
}
/*Se valida si el usuario está autenticado */
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
/*
Se obtiene el nombre  y la contraseña ingresados en el formulario
*/
	$input_arr = array();

	if (empty($username)) {
		$input_arr['input_user_error'] = "Username Is Required!";
	}

	if (empty($password)) {
		$input_arr['input_pass_error'] = "Password Is Required!";
	}
	/* Validación de Credenciales */
	if (count($input_arr) == 0) {
		$query = "SELECT * FROM `users` WHERE `username` = '$username';";
		$result = mysqli_query($db_con, $query);
		if (mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['password'] == sha1(md5($password))) {
				if ($row['status'] == 'activo') {
					$_SESSION['user_login'] = $username;
					header('Location: index.php');
				} else {
					$status_inactive = "Su estado está inactivo, póngase en contacto con el administrador o el soporte";
				}
			} else {
				$worngpass = "Contraseña o Usurario Incorrectos!";
			}
		} else {
			$usernameerr = "Nombre de usuario no existe";
		}
	}
}
?>
<!doctype html>
<html1 lang="en">

<head>
	<!-- Se requiere archivos de metadatos-->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Hojas de estilo de bootstrap y css -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title>Acceso Administrativo</title>
</head>

<body>
	<!-- Ingreso al acceso administrativo  -->
	<div class="Acceso"><br>
		<h1 class="text-center">Acceso Administrativo</h1>
		<hr><br>
		<div class="d-flex justify-content-center">
			<!-- Se agregan mensajes de Error-->
			<?php if (isset($usernameerr)) { ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $usernameerr; ?></div><?php }; ?>
			<?php if (isset($worngpass)) { ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $worngpass; ?></div><?php }; ?>
			<?php if (isset($status_inactive)) { ?> <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade hide" data-delay="2000"><?php echo $status_inactive; ?></div><?php }; ?>
		</div>
		<!-- Formulario de Inicio de sesión-->
		<div class="row animate__animated animate__pulse">
			<div class="col-md-4 offset-md-4">
				<form method="POST" action="">
					<div class="form-group row">
						<div class="col-sm-12">
							<input type="text" class="form-control" name="username" value="<?= isset($username) ? $username : ''; ?>" placeholder="Usuario" id="inputEmail3"> <?php echo isset($input_arr['input_user_error']) ? '<label>' . $input_arr['input_user_error'] . '</label>' : ''; ?>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
							<input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Contraseña"><label><?php echo isset($input_arr['input_pass_error']) ? '<label>' . $input_arr['input_pass_error'] . '</label>' : ''; ?>
						</div>
					</div>
					<div class="text-center">
						<button type="submit" name="login" class="btn btn-warning">Ingresar</button>
					</div>
					<p>Si aún no tienes una cuenta de usuario, puedes <a href="register.php">Registrarte acá</a></p>
					<!--Se agrega está opción por si el usuario no tiene cuenta-->
			</div>
			</form>
		</div>


	<!--Archivos opcionales de Javascript -->
	<!-- Primero jQuery, luego Popper.js, y por ultimo Bootstrap JS -->
	<script src="../js/jquery-3.5.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('.toast').toast('show')
	</script>
	</div>
</body>
</html>