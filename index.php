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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Matrícula de Estudiantes</title>
  </head>
  <body>
    <div class="container"><br>
      <a class="btn btn-primary float-right" href="admin/login.php">Panel Administrativo</a>
          <h1 class="text-center">Sistema de Matrícula de Estudiantes</h1><br>

          <div class="row">
            <div class="col-md-4 offset-md-4">
              <form method="POST">
            <table class="text-center infotable">
              <tr>
                <th colspan="2">
                  <p class="text-center">Información del Estudiante</p>
                </th>
              </tr>
              <tr>
                <td>
                   <p>Selecciona el Curso</p>
                </td>
                <td>
                   <select class="form-control" name="choose">
                     <option value="">
                       Selecciona
                     </option>
                     <option value="Computación">
                       Computación
                     </option>
                     <option value="Robótica">
                       Robótica
                     </option>
                     <option value="Programación">
                       Programación
                     </option>
                     <option value="Excel Basico ">
                       Excel Basico 
                     </option>
                     <option value="Excel Avanzado">
                       Excel Avanzado
                     </option>
                   </select>
                </td>
              </tr>

              <tr>
                <td>
                  <p><label for="roll">Número Matricula</label></p>
                </td>
                <td>
                  <input class="form-control" type="text" pattern="[0-9]{6}" id="roll" placeholder="6 dígitos..." name="roll">
                </td>
              </tr>
              <tr>
                <td colspan="2" class="text-center">
                  <input class="btn btn-danger" type="submit" name="showinfo">
                </td>
              </tr>
            </table>
          </form>
            </div>
          </div>
          //Aquí iria el codigo del notepad
          <div class="container1">
             <h1 class="text-center">Lista de Cursos Disponibles</h1><br>

            <div class="Cursos">
              <h2>Programación</h2>
              <p>Descripción: Curso Introductorio sobre programación básica</p>
              <p>Horario: De lunes a Viernes, de 12md a 3pm</p>
              <p>Requisito: Estar matriculado en la Fundación</p>
              <img src="admin/images/progra1.jpg" alt="Imagen 1">
            </div>

            <div class="Cursos">
              <h2>Robótica</h2>
              <p>Descripción: Curso Introductorio sobre programación básica</p>
              <p>Horario: De lunes a Viernes, de 12md a 3pm</p>
              <p>Requisito: Estar matriculado en la Fundación</p>
              <img src="admin/images/robo2.jpg" alt="Imagen 1">
            </div>

            <div class="Cursos">
              <h2>Computación</h2>
              <p>Descripción: Curso Introductorio sobre programación básica</p>
              <p>Horario: De lunes a Viernes, de 12md a 3pm</p>
              <p>Requisito: Estar matriculado en la Fundación</p>
              <img src="admin/images/Computación.jpg" alt="Imagen 1">
              </div>

            <div class="Cursos">
              <h2>Excel Basico</h2>
              <p>Descripción: Curso Introductorio sobre programación básica</p>
              <p>Horario: De lunes a Viernes, de 12md a 3pm</p>
              <p>Requisito: Estar matriculado en la Fundación</p>
              //<img src="admin/images/Excel Basico1.jpg" alt="Imagen 1">
            </div>

            <div class="Cursos">
              <h2>Excel Avanzado</h2>
              <p>Descripción: Curso Introductorio sobre programación básica</p>
              <p>Horario: De lunes a Viernes, de 12md a 3pm</p>
              <p>Requisito: Estar matriculado en la Fundación</p>
              <img src="admin/images/Excel Avanzado1.jpg" alt="Imagen 1">
            </div>

        <br>
        <?php if (isset($_POST['showinfo'])) {
          $choose= $_POST['choose'];
          $roll = $_POST['roll'];
          if (!empty($choose && $roll)) {
            $query = mysqli_query($db_con,"SELECT * FROM `student_info` WHERE `roll`='$roll' AND `class`='$choose'");
            if (!empty($row=mysqli_fetch_array($query))) {
              if ($row['roll']==$roll && $choose==$row['class']) {
                $stroll= $row['roll'];
                $stname= $row['name'];
                $stclass= $row['class'];
                $city= $row['sede'];
                $photo= $row['photo'];
                $pcontact= $row['pcontact'];
              ?>
        <div class="row">
          <div class="col-sm-6 offset-sm-3">
            <table class="table table-bordered">
              <tr>
                <td rowspan="5"><h3>Información de Estudiante</h3><img class="img-thumbnail" src="admin/images/<?= isset($photo)?$photo:'';?>" width="250px"></td>
                <td>Nombre</td>
                <td><?= isset($stname)?$stname:'';?></td>
              </tr>
              <tr>
                <td>Número de Matrícula</td>
                <td><?= isset($stroll)?$stroll:'';?></td>
              </tr>
              <tr>
                <td>Matricula del curso</td>
                <td><?= isset($stclass)?$stclass:'';?></td>
              </tr>
              <tr>
                <td></td>Sede
                <td><?= isset($sede)?$sede:'';?></td>
              </tr>
              <tr>
                <td>Fecha de Ingreso</td>
                <td><?= isset($pcontact)?$pcontact:'';?></td>
              </tr>
            </table>
          </div>
        </div>  
      <?php 
          }else{
                echo '<p style="color:red;">Por favor ingrese un número válido de matricula y sede</p>';
              }
            }else{
              echo '<p style="color:red;">Tu información ingresada no coincide</p>';
            }
            }else{?>
              <script type="text/javascript">alert("Datos no encontrados");</script>
            <?php }
          }; ?>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>