<?php require_once 'db_con.php';
session_start();
if (!isset($_SESSION['user_login'])) {
  header('Location: login.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/solid.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/fontawesome.min.js"></script>
    <script src="../js/script.js"></script>
    <title>Panel de Control</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-white grey bg-white grey">
  <div id="logo-container ">
    <img id="Logo" src="./images/logo1.png" alt="Logo de la empresa">
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse justify-content-end" id="navbarSupportedContent">
    <?php $showuser = $_SESSION['user_login']; $haha = mysqli_query($db_con,"SELECT * FROM `users` WHERE `username`='$showuser';"); $showrow=mysqli_fetch_array($haha); ?>
    <ul class="nav navbar-nav ">
      <li class="nav-item"><a class="nav-link" href="index.php?page=user-profile"><i class="fa fa-user"></i> Inicio</a></li>
      <li class="nav-item"><a class="nav-link" href="index.php?page=add-student"><i class="fa fa-user-plus"></i> Agregar Estudiante</a></li>
      <li class="nav-item"><a class="nav-link" href="index.php?page=user-profile"><i class="fa fa-user"></i> Perfil</a></li>
      <li class="nav-item1"><a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
    </ul>
  </div>
</nav>
<br>
    <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php?page=dashboard" class="list-group-item list-group-item-action active">
               <i class="fas fa-tachometer-alt"></i> Panel de Control
              </a>
              <a href="index.php?page=add-student" class="list-group-item list-group-item-action"><i class="fa fa-user-plus"></i> Agregar Estudiante</a>
              <a href="index.php?page=all-student" class="list-group-item list-group-item-action"><i class="fa fa-users"></i> Todos los Estudiantes</a>
              <a href="index.php?page=all-users" class="list-group-item list-group-item-action"><i class="fa fa-users"></i> Todos los Usuarios</a>
              <a href="index.php?page=user-profile" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> Perfil de Usuario</a>
            </div>
          </div>
          <div class="col-md-9">
             <div class="content">
                 <?php 
                   if (isset($_GET['page'])) {
                    $page = $_GET['page'].'.php';
                    }else{
                      $page = 'dashboard.php';
                    }

                    if (file_exists($page)) {
                      require_once $page;
                    }else{
                      require_once '404.php';
                    }
                  ?>
             </div>
        </div>
        </div>  
    </div>
    <br><br>
    <nav class="navbar navbar-expand-lg navbar-grey dark bg-grey dark">
    <div id="clearfix"></div>
    <br><br><br><br><br><br>
    <center><h2>Síguenos en nuestras Redes Sociales</h2></center>
    <ul>
    <div class="navbar-collapse collapse justify-content-end" id="navbarSupportedContent">
    <?php $showuser = $_SESSION['user_login']; $haha = mysqli_query($db_con,"SELECT * FROM `users` WHERE `username`='$showuser';"); $showrow=mysqli_fetch_array($haha); ?>
    <ul class="nav navbar-nav ">
    <li class="nav-item"><a class="nav-link" href="https://www.instagram.com/fundavidacr/"><i class="fa-brands fa-instagram"></i> Instagram</a></li>
    <li class="nav-item"><a class="nav-link" href="https://www.facebook.com/fundavida.org"><i class="fa-brands fa-facebook"></i> Facebook</a></li>
    <li class="nav-item"><a class="nav-link" href="https://www.youtube.com/@FundaVidaCR"><i class="fa-brands fa-youtube"></i> You Tube</a></li>
    <li class="nav-item"><a class="nav-link" href="https://api.whatsapp.com/send/?phone=%2B50688708991&text&type=phone_number&app_absent=0"><i class="fa-brands fa-square-whatsapp"></i> WhatsApp</a></li>
  </ul>
</div>
    </nav>

    <div class="clearfix"></div>
      <br><br><br><br><br><br>
      <center><h2>Para más información ingresar al sitio Oficial de la Fundación <a href="https://www.fundavida.org/pagina-principal/">FundaVida</a></h2></center>
      
    
    <script type="text/javascript">
      jQuery('.toast').toast('show');
    </script>
  </body>
</html>