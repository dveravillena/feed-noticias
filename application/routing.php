<?php

//Recoge la variable que indica a la app que tiene que realizar
$action = "";
if (isset($_GET['action'])) {
  $action = $_GET['action'];
}

switch ($action) {
  case 'test': //Se encarga de realizar test externos en la aplicación
    //comprueba si esta definida la variable que indica la acción a realizar. Si no, muestra un mensaje de error
    if (isset($_GET['test'])) {
      $test_action = $_GET['test']; //Recoge la variable que indica la acción a testear
      require_once('application/controllers/test_controller.php'); //Controlador encargado de realizar los test
      require_once('application/models/feed.php'); //Modelo Feed
      require_once('application/database/connect.php'); //Conexión a la base de datos
      $tester = new TestController(); //Crea un nuevo tester
      $tester->initTest($test_action); //Inicia el test indicado en la variable
    } else {
      $message = 'No se encuentra la acción a testear';
      require_once('application/views/error.php');
    }
    break;
  default:
    $message = 'Acción no encontrada';
    require_once('application/views/error.php'); //Carga la vista encargada de mostrar el error
    break;
}

?>
