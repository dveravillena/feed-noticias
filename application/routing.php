<?php

//Recoge la variable que indica a la app que tiene que realizar
$action = "";
if (isset($_GET['action'])) {
  $action = $_GET['action'];
}

switch ($action) {
  case 'value':
    // code...
    break;
  default:
    $message = 'Acción no encontrada';
    require_once('application/views/error.php'); //Carga la vista encargada de mostrar el error
    break;
}

?>
