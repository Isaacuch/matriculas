<?php require_once 'admin/db_con.php'; ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="style.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Matrícula de Estudiantes</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <div class="Container3">
    <?php
    $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage !== 'index.php') {
      if ($corepage == $corepage) {
        $corepage = explode('.', $corepage);
        header('Location: index.php?page=' . $corepage[0]);
      }
    } 
    
/* Ingreso de Datos  */
    if (isset($_POST['addstudent'])) {
      $name = $_POST['name'];
      $roll = $_POST['roll'];
      $sede = $_POST['sede'];
      $pcontact = $_POST['pcontact'];
      $class = $_POST['class'];

      $photo = explode('.', $_FILES['photo']['name']);
      $photo = end($photo);
      $photo = $roll . date('Y-m-d-m-s') . '.' . $photo;

      $query = "INSERT INTO `student_info`(`name`, `roll`, `class`, `sede` , `pcontact`, `photo`) VALUES ('$name', '$roll', '$class', '$sede', '$pcontact','$photo');";
      if (mysqli_query($db_con, $query)) {
        $datainsert['insertsucess'] = '<p style="color: green;">Estudiante Ingresado Exitosamente</p>';
        move_uploaded_file($_FILES['photo']['tmp_name'], 'admin/images/' . $photo);
      } else {
        $datainsert['inserterror'] = '<p style="color: red;">Estudiante no ingresado, revise la información diligenciada.</p>';
      }
    }
    
/*Menú de navegación del sistema o del sitio*/
    ?>
        <a class="btn btn-primary float-right" href="admin/login.php">Panel Administrativo</a>
        <h1 class="text-center"> Matriculas de Estudiante</h1><br>
        <h3 class="text-warning"> Agregar Estudiantes</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <ul>
        </nav>

/* Se llama a la funcion student insert Into para verificar si el estudiante se agrega correctamente */
      <div class="row1">
        <div class="col-sm-6">
          <?php if (isset($datainsert)) { ?>
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
                ?>
              </div>
            </div>

/* 
Formulario de estudiantes para matricularse 
con su correpondiente validación de cada campo solicitado
*/
          <?php } ?>
          <form enctype="multipart/form-data" method="POST" action="">
            <div class="form-group">
              <label for="name">Nombre de Estudiante</label>
              <input name="name" type="text" class="form-control" id="name" value="<?= isset($name) ? $name : ''; ?>" required="">
            </div>
            <div class="form-group">
              <label for="roll">Número de Cédula</label>
              <input name="roll" type="text" value="<?= isset($roll) ? $roll : ''; ?>" class="form-control" pattern="[0-9]{9}" id="roll" required="">
            </div>

            <div class="form-group">
              <label for="sede">Sede del Estudiante</label>
              <select name="sede" class="form-control" id="sede" required="">
                <option>Selecciona</option>
                /*
                Opciones disponibles de las sedes
                Es importante ya que aquí es donde se cambian
                 */
                <option value="Alajuelita, Concepción">Alajuelita, Concepción</option>
                <option value="Hatillo, 25 de Julio">Hatillo, 25 de Julio</option>
                <option value="Desamparados, Linda Vista">Desamparados, Linda Vista</option>
              </select>
            </div>
           
            <div class="form-group">
              <label for="pcontact">Teléfono de Contacto</label>
              <input name="pcontact" type="text" class="form-control" id="pcontact" pattern="[0-9]{8}" value="<?= isset($pcontact) ? $pcontact : ''; ?>" placeholder="+506........" required="">
            </div>
            <div class="form-group">
              <label for="class">Centros interactivos para matricular</label>
              <select name="class" class="form-control" id="class" required="">
                <option>Selecciona</option>
                /*
                Opciones del los cursos disponibles
                Aquí y en los archivos que se necesiten se pueden cambiar
                si se necesitara algún cambio*/
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
            <h3 class="text-warning"> Atención, verifique la información.
               Ingrese solo una vez al estudiante! </h3>
          </form>
        </div>
      </div>
  </div>
  /*Listado de los cursos disponibles es aquí donde se pueden editar el mostrado de los cursos */
  <div class="container1">
    <h1 class="text-center">Lista de Cursos Disponibles 2024</h1><br>
    <ul>
      <div class="Cursos">
        <h2>Programación</h2>
        <p>Descripción: Curso Introductorio sobre programación básica</p>
        <p>Horario: De lunes a Viernes, de 12md a 3pm</p>
        <p>Requisito: Estar matriculado en la Fundación</p>
        <img src="admin/images/progra1.jpg" alt="Imagen 1">
        /*
        Es importante que se debe seguir este código, por si se quiere cambiar la imagen
        ejemplo: se obtiene la imagen se agrega en la sección de imagenes en admin para despues 
        coger el mismo codigo solo se le cambia el nombre de la imagen por la nueva
        tener en cuenta la ruta en donde agrego la imagen 
         */
      </div>
      <ul>

        <div class="Cursos">
          <h2>Robótica</h2>
          <p>Descripción: Curso Introductorio sobre programación básica</p>
          <p>Horario: De lunes a Viernes, de 12md a 3pm</p>
          <p>Requisito: Estar matriculado en la Fundación</p>
          <img src="admin/images/R0.png" alt="Imagen 2">
        </div>
        <ul>

          <div class="Cursos">
            <h2>Computación</h2>
            <p>Descripción: Curso Introductorio sobre programación básica</p>
            <p>Horario: De lunes a Viernes, de 12md a 3pm</p>
            <p>Requisito: Estar matriculado en la Fundación</p>
            <img src="admin/images/Computación.jpg" alt="Imagen 3">
          </div>
          <ul>

            <div class="Cursos">
              <h2>Excel Basico</h2>
              <p>Descripción: Curso Introductorio sobre programación básica</p>
              <p>Horario: De lunes a Viernes, de 12md a 3pm</p>
              <p>Requisito: Estar matriculado en la Fundación</p>
              <img src="admin/images/Excel Basico1.jpg" alt="Imagen 4">
            </div>
            <ul>

              <div class="Cursos">
                <h2>Excel Avanzado</h2>
                <p>Descripción: Curso Introductorio sobre programación básica</p>
                <p>Horario: De lunes a Viernes, de 12md a 3pm</p>
                <p>Requisito: Estar matriculado en la Fundación</p>
                <img src="admin/images/EA1.jpg" alt="Imagen 5">
              </div>
              <ul>

              /*Definición del formulario para observar la información del estudiante */
                <?php if (isset($_POST['showinfo'])) {
                  $choose = $_POST['choose'];
                  $roll = $_POST['roll'];
                  if (!empty($choose && $roll)) {
                    $query = mysqli_query($db_con, "SELECT * FROM `student_info` WHERE `roll`='$roll' AND `class`='$choose'");
                    if (!empty($row = mysqli_fetch_array($query))) {
                      if ($row['roll'] == $roll && $choose == $row['class']) {
                        $stroll = $row['roll'];
                        $stname = $row['name'];
                        $stclass = $row['class'];
                        $city = $row['sede'];
                        $photo = $row['photo'];
                        $pcontact = $row['pcontact'];
                ?>
                        <div class="row">
                          <div class="col-sm-6 offset-sm-3">
                            <table class="table table-bordered">
                              <tr>
                                <td rowspan="5">
                                  <h3>Información de Estudiante</h3><img class="img-thumbnail" src="admin/images/<?= isset($photo) ? $photo : ''; ?>" width="250px">
                                </td>
                                <td>Nombre</td>
                                <td><?= isset($stname) ? $stname : ''; ?></td>
                              </tr>
                              <tr>
                                <td>Número de Matrícula</td>
                                <td><?= isset($stroll) ? $stroll : ''; ?></td>
                              </tr>
                              <tr>
                                <td>Matricula del curso</td>
                                <td><?= isset($stclass) ? $stclass : ''; ?></td>
                              </tr>
                              <tr>
                                <td></td>Sede
                                <td><?= isset($sede) ? $sede : ''; ?></td>
                              </tr>
                              <tr>
                                <td>Fecha de Ingreso</td>
                                <td><?= isset($pcontact) ? $pcontact : ''; ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                    <?php
                      } else {
                        echo '<p style="color:red;">Por favor ingrese un número válido de matricula y sede</p>';
                      }
                    } else {
                      echo '<p style="color:red;">Tu información ingresada no coincide</p>';
                    }
                  } else { ?>
                    <script type="text/javascript">
                      alert("Datos no encontrados");
                    </script>
                <?php }
                }; ?>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <div class="container1">
    <h1 class="text-center">Síguenos en nuestras Redes Sociales</h1><br>
    <ul>
    <li><a href="https://www.instagram.com/fundavidacr/" target="_blank"> Instagram</a></li>
    <li><a href="https://www.facebook.com/fundavida.org" target="_blank"> Facebook</a></li>
    <li><a href="https://www.youtube.com/@FundaVidaCR" target="_blank"> YouTube</a></li>
    <li><a href="https://api.whatsapp.com/send/?phone=%2B50688708991&text&type=phone_number&app_absent=0" target="_blank">Comuníquese con nosotros!, whatsapp</a></li>
  </ul>
</div>
    

</body>

</html>