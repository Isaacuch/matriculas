<?php 
/*Se inicia o reunada la sesión
 se destruye todos los datos asociados con la sesión actual. Después de llamar a esta función, la sesión ya no existe y todos los datos de la sesión se eliminan.
 se redirige a la página de sesión*/
session_start();
session_destroy();
header('Location: login.php');
/*Esto se utiliza para cerrar la sesión de un usuario*/

