<?php

class TestController {

  public function __construct(){}

    /**
    * Función que comprueba las funciones del feed
    * @param string $test_action acción que debe realizar el tester
    * Muestra en una vista el resultado del test
    */
  	public static function initTest($test_action) {

      switch ($test_action) {
        case 'fcreate': //Almacena un feed en la base de datos
          $feed = new Feed(NULL, 'titulo', 'descripcion', 'imagen', 'fuente', 'publicado'); //Crea un feed generico
          Feed::create($feed); //Almacena el feed creado en la base de datos
          $message = 'Feed Creado';
          require_once('application/views/test.php'); //Carga la vista que muestra el mensaje
          break;
        case 'fget': //Recupera un feed de la base de datos
          $id = 1; //Identificador del feed a recuperar
          $feed = Feed::getById($id); //Recupera el feed de la base de datos indicado por el identificador
          $message = var_dump($feed); //Feed recuperado
          require_once('application/views/test.php'); //Carga la vista que muestra el mensaje
          break;
        case 'fedit': //Edita un feed de la base de datos
          $feed = new Feed(1, 'titulo2', 'descripcion2', 'image2', 'fuente2', 'publicado2'); //Crea un feed generico
          Feed::update($feed); //Actualiza la información del feed creado en la base de datos
          $message = 'Feed Editado';
          require_once('application/views/test.php');  //Carga la vista que muestra el mensaje
          break;
        case 'fdelete': //Borra un feed de la base de datos
          $id = 1; //Identificador del feed a recuperar
          $feed = Feed::delete($id); //Borra el feed de la base de datos indicado por el identificador
          $message = 'Feed Eliminado';
          require_once('application/views/test.php'); //Carga la vista que muestra el mensaje
          break;
        case 'fgetall': //Recupera todos los feed de la base de datos
          $feeds = Feed::getAll(); //Recupera todos los feed de la base de datos con la fecha de hoy
          $message = var_dump($feeds); //Lista de Feeds recuperados
          require_once('application/views/test.php'); //Carga la vista que muestra el mensaje
          break;
        case 'fstest':
          require_once('application/services/feed_service.php');
          $service = new FeedServices(); //Crea un nuevo servicio
          $service->searchFeeds(); //Busca los ultimos feeds de los periodicos y los guarda en una lista
          $feeds = $service->feedlist; //Lista de Feeds recogidos en la busqueda del servicio
          $message = var_dump($feeds);
          require_once('application/views/test.php'); //Carga la vista que muestra el mensaje
          break;
        default:
          $message = 'No se encuentra la acción a testear';
          require_once('application/views/error.php');
          break;
      }

  	}

}
?>
