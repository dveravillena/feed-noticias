<?php

//Recoge la variable que indica a la app que tiene que realizar
$action = "";
if (isset($_GET['action'])) {
  $action = $_GET['action'];
} else {
  $action= 'list';
}

switch ($action) {
  case 'test': //Se encarga de realizar test externos en la aplicación

    //comprueba si esta definida la variable que indica la acción a realizar. Si no muestra un mensaje de error
    if (isset($_GET['test'])) {
      $test_action = $_GET['test']; //Recoge la variable que indica la acción a testear
      require_once('application/controllers/test_controller.php'); //Controlador encargado de realizar los test
      require_once('application/models/feed.php'); //Modelo Feed
      require_once('application/database/connect.php'); //Conexión a la base de datos
      $tester = new TestController(); //Crea un nuevo tester
      $tester->initTest($test_action); //Inicia el test indicado en la variable
    } else {
      $message = 'No se encuentra la acción a testear';
      require_once('application/views/error.php'); //Carga la vista encargada de mostrar el error
    }

    break;
  case 'list': //Muestra una lista de los feed

    require_once('application/controllers/feed_controller.php'); //Controlador encargado de gestionar el modelo Feed
    require_once('application/models/feed.php'); //Modelo Feed
    require_once('application/database/connect.php'); //Conexión a la base de datos
    $controller = new FeedController(); //Crea un nuevo controlador
    $controller->listFeeds(); //Función encargada de gestionar el listado de los feed

    break;
  case 'create':

    require_once('application/views/feed/newfeed.php'); //Carga la vista con el formulario para crear un feed

    break;
  case 'save': //Guarda los datos de un feed

    require_once('application/controllers/feed_controller.php'); //Controlador encargado de gestionar el modelo Feed
    require_once('application/models/feed.php'); //Modelo Feed
    require_once('application/database/connect.php'); //Conexión a la base de datos
    $controller = new FeedController(); //Crea un nuevo controlador
    $controller->saveFeed(); //Función encargada de gestionar el guardado del feed

    break;
  case 'view': //Muestra un feed individual para editar

    //comprueba si esta definida la variable que indica el feed a mostrar. Si no muestra un mensaje de error
    if (isset($_GET['id'])) {
      $id = $_GET['id']; //Recoge la variable que indica el identificador del feed
      require_once('application/controllers/feed_controller.php'); //Controlador encargado de gestionar el modelo Feed
      require_once('application/models/feed.php'); //Modelo Feed
      require_once('application/database/connect.php'); //Conexión a la base de datos
      $controller = new FeedController(); //Crea un nuevo controlador
      $controller->updateFeed($id); //Función encargada de gestionar la carga del feed
    } else {
      $message = 'No se encuentra el id del producto a editar.';
      require_once('application/views/error.php'); //Carga la vista encargada de mostrar el error
    }

    break;
  case 'delete': //Borra un feed

    //comprueba si esta definida la variable que indica el feed a borrar. Si no muestra un mensaje de error
    if (isset($_GET['id'])) {
      $id = $_GET['id']; //Recoge la variable que indica el identificador del feed
      require_once('application/controllers/feed_controller.php'); //Controlador encargado de gestionar el modelo Feed
      require_once('application/models/feed.php'); //Modelo Feed
      require_once('application/database/connect.php'); //Conexión a la base de datos
      $controller = new FeedController(); //Crea un nuevo controlador
      $controller->deleteFeed($id); //Función encargada de gestionar el borrado del feed
    } else {
      $message = 'No se encuentra el id del producto a borrar';
      require_once('application/views/error.php'); //Carga la vista encargada de mostrar el error
    }

    break;
  default:
    $message = 'Acción no encontrada';
    require_once('application/views/error.php'); //Carga la vista encargada de mostrar el error
    break;
}

?>
