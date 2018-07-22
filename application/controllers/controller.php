<?php

class Controller {

  public function __construct(){}

  /**
  * Función que utiliza el servicio de lectura de FeedServices
  * para obtener los últimos feeds de los periódicos.
  * Una vez obtenidos los guarda en la base de datos y los
  * muestra en la lista de feeds
  */
  public function loadFeeds(){

    $feed_service = new FeedServices(); //Crea un nuevo servicio
    $feed_service->searchFeeds(); //Busca los ultimos feeds de los periodicos y los guarda en una lista
    $feeds = $feed_service->feedlist; //Lista de Feeds recogidos en la busqueda del servicio
    if ($feeds) {//Comprueba que se han obtenido feeds en la lectura
        $this->saveFeeds($feeds); //Guarda en la base de datos los Feeds obtenidos
    }

  }

  /**
  * Función que guarda en la base de datos la lista de feeds
  * que se le indica
  * @param Array $feeds lista de feeds que queremos guardar
  * Una vez guardados los obtiene y carga la vista con todos SplObjectStorage
  * feeds
  */
  public function saveFeeds($feeds){

    //Recorre la lista de feeds
    for ($i=0; $i < count($feeds); $i++) {
      $feed = new Feed(NULL, $feeds[$i]['title'], $feeds[$i]['description'], $feeds[$i]['image'], $feeds[$i]['source'], $feeds[$i]['publisher']); //Crea un nuevo Feed a partir de la lista
      Feed::create($feed); //Almacena el Feed en la base de datos
    }

    $feeds = Feed::getAll(); //Obtiene todos los Feeds de la base de datos con la fecha de hoy
    if ($feeds) { //Comprueba si ha obtenido los Feeds
      require_once('application/views/feed/feedlist.php'); //Carga la vista en la que se muestran todos los Feeds
    }

  }

}
?>
