<?php

class FeedController {

  public function __construct(){}

  /**
  * Función que obtiene todos los feeds de la base de datos con la fecha de hoy
  * y los muestra en una vista
  */
  public function listFeeds(){

  	$feeds = Feed::getAll(); //Recupera todos los feed de la base de datos con la fecha de hoy
    //Comprueba si se han obtenido feeds desde la base de datos
    if (!$feeds) {
  		$feeds = 'No hay feeds para mostrar';
  	}
    require_once('application/views/feed/feedlist.php');  //Carga la vista encargada de mostrar el listado de feeds
  }

  /**
  * Función que obtiene los datos enviados por formulario y los
  * almacena en un feed para luego guardarlo en la base de datos.
  * Al finalizar redirige al indice para cargar la lista de feeds
  */
  public function saveFeed(){

    //Recoge los parametros del feed. Si están vacios, los convierte en null
		$id = !empty($_POST['id']) ?  $_POST['id'] : null;
		$title = !empty($_POST['title']) ?  $_POST['title'] : null;
		$description = !empty($_POST['description']) ?  $_POST['description'] : null;
		$image = !empty($_POST['image']) ?  $_POST['image'] : null;
		$source = !empty($_POST['source']) ?  $_POST['source'] : null;
		$publisher = !empty($_POST['publisher']) ?  $_POST['publisher'] : null;
    /*
      Comprueba si ha obtenido un identificador. En caso afirmativo actualiza los
      datos del feed indicado en la base de datos. Si no ha obtenido un identificador
      guarda el feed nuevo en la base de datos
    */
		if ($id) {
			$feed = new Feed($id, $title, $description, $image, $source, $publisher); //Crea un feed con los datos obtenidos
			Feed::update($feed);  //Actualiza la información del feed creado en la base de datos
		} else {
			$feed = new Feed(NULL, $title, $description, $image, $source, $publisher); //Crea un feed con los datos obtenidos
			Feed::create($feed); //Almacena el feed creado en la base de datos
		}
		header('Location: ../'); //Redige al indice de la aplicación para cargar la lista de feeds

	}

  /**
  * Función que obtiene los datos de un feed para cargarlos en la
  * vista detalle del feed.
  * @param int $id identificador del feed que queremos obtener
  */
  public function updateFeed($id){

		$feed = Feed::getById($id); //Recupera el feed de la base de datos indicado por el identificador
		require_once('application/views/feed/viewfeed.php');

	}

  /**
  * Función que borra un feed de la base de datos
  * @param int $id identificador del feed que queremos eliminar
  * Al finalizar redirige al indice para cargar la lista de feeds
  */
	public function deleteFeed($id){

		$feed = Feed::delete($id); //Borra el feed de la base de datos indicado por el identificador
		header('Location: ../../'); //Redige al indice de la aplicación para cargar la lista de feeds

	}

}
?>
