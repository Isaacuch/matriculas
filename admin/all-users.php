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
?>
<h1 class="text-primary"><i class="fas fa-users"></i>  Todos los Usuario<small class="text-warning"> Lista de Usuarios</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
     <li class="breadcrumb-item active" aria-current="page">Todos los Usuarios</li>
  </ol>
</nav>
<!-- Realizamos la parte del menú de navegación -->

<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">SL</th>
      <th scope="col">Nombre</th>
      <th scope="col">Correo</th>
      <th scope="col">Usuario</th>
      <th scope="col">Fotografía</th>
      <th scope="col">Estado</th>
    </tr>
  </thead>
  <tbody>
    <!-- Se crea una tabla donde se mustra la información del estudiante  -->

    <?php 
      $query=mysqli_query($db_con,'SELECT * FROM `users`');
      $i=1;
      while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php 
        echo '<td>'.$i.'</td>
          <td>'.ucwords($result['name']).'</td>
          <td>'.$result['email'].'</td>
          <td>'.ucwords($result['username']).'</td>
          <td><img src="images/'.$result['photo'].'" height="50px"></td>
          <td>'.$result['status'].'</td>';?>
      </tr>  
     <?php $i++;} ?>
     <!-- Se mustran los datos de los usuarios administradores.  -->
    
  </tbody>
</table>
<script type="text/javascript">
  function confirmationDelete(anchor)
{
   var conf = confirm('¿Está seguro de que desea eliminar este registro?');
   if(conf)
      window.location=anchor.attr("href");
}
/*
Confirmación de la acción de eliminar
*/
</script>