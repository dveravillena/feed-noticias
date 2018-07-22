<?php

class Feed {

  public $id;
	public $title;
	public $body;
	public $image;
  public $source;
  public $publisher;

  public function __construct($id, $title, $body, $image, $source, $publisher) {

		$this->id = $id;
    $this->title = $title;
	  $this->body = $body;
	  $this->image = $image;
    $this->source = $source;
    $this->publisher = $publisher;

  }

  /**
  * Función que obtiene todos los feeds de la base de datos con la fecha de hoy.
  * Devuelve un array de Feeds.
  */
	public static function getAll() {

    //Intenta obtener los datos. Si ocurre un error deriva en la vista de error indicando el error.
		try {
			$feeds = [];
			$db = Database::getConnect(); //Conexión a la base de datos
			$sql = $db->query('SELECT * FROM feeds WHERE date(date) = CURDATE()'); //Obtiene los feeds almacenados en la base de datos con fecha de hoy
      //Recorre los resultados de la consulta y los almacena los datos creando un Feed y almacenandolo en el array
      foreach ($sql->fetchAll() as $feed) {
				$feeds[]= new Feed($feed['id'], $feed['title'], $feed['description'], $feed['image'], $feed['source'], $feed['publisher']);
			}
			$db = null; //Cerrar conexión de la base de datos
			return $feeds; //Devuelve el array con los Feeds obtenidos
		} catch (PDOException $e) {
			$message = $e->getMessage(); //Recoge el mensaje de error
			require_once('application/views/error.php'); //Carga la vista que muestra el mensaje de error
			die(); //Detiene el proceso de la app
		}

	}

  /**
  * Función que obtiene un feed de la base de datos indicado por su identificador.
  * @param int $id identificador del feed que queremos obtener
  * Devuelve el Feed indicado.
  */
	public static function getById($id) {

    //Intenta obtener los datos. Si ocurre un error deriva en la vista de error indicando el error.
    try {
  		$db = Database::getConnect(); //Conexión a la base de datos
  		$select = $db->prepare('SELECT * FROM feeds WHERE ID=:id'); //Obtiene el feed almacenado en la base de datos con el id indicado
  		$select->bindValue('id',$id); //Asigna el valor de la variable a la consulta
  		$select->execute(); //Ejecuta la consulta
  		$feedDb = $select->fetch(); //Obtiene el resultado de la consulta
  		$feed= new Feed($feedDb['id'], $feedDb['title'], $feedDb['description'], $feedDb['image'], $feedDb['source'], $feedDb['publisher']); //Crea un Feed con los datos obtenidos
  		$db = null; //Cerrar conexión de la base de datos
  		return $feed; //Devuelve el array con los Feeds obtenidos
    } catch (PDOException $e) {
      $message = $e->getMessage(); //Recoge el mensaje de error
			require_once('application/views/error.php'); //Carga la vista que muestra el mensaje de error
			die(); //Detiene el proceso de la app
    }

	}

  /**
  * Función que almacena un Feed en la base de datos
  * @param Feed $feed Feed que queremos almacenar en la base de datos
  */
	public static function create($feed) {

    //Intenta almacenar información en la base de datos. Si ocurre un error deriva en la vista de error indicando el error.
    try {
			$db = Database::getConnect(); //Conexión a la base de datos
			$insert = $db->prepare('INSERT INTO feeds VALUES(NULL,:title, :description, :image, :source, :publisher, NULL)'); //Inserta en la base de datos un nuevo feed
      //Asigna los valores de las variables a la consulta
      $insert->bindValue('title',$feed->title);
			$insert->bindValue('description',$feed->body);
			$insert->bindValue('image',$feed->image);
			$insert->bindValue('source',$feed->source);
			$insert->bindValue('publisher',$feed->publisher);
			$insert->execute(); //Ejecuta la consulta
			$db = null; //Cerrar conexión de la base de datos
    } catch (PDOException $e) {
      $message = $e->getMessage(); //Recoge el mensaje de error
			require_once('application/views/error.php'); //Carga la vista que muestra el mensaje de error
			die(); //Detiene el proceso de la app
    }

	}

  /**
  * Función que actualiza la información de un Feed en la base de datos
  * @param Feed $feed Feed que queremos actualizar en la base de datos
  */
	public static function update($feed){

    //Intenta actulizar información en la base de datos. Si ocurre un error deriva en la vista de error indicando el error.
    try {
  		$db = Database::getConnect(); //Conexión a la base de datos
  		$update = $db->prepare('UPDATE feeds SET title=:title, description=:description, image=:image, source=:source, publisher=:publisher WHERE id=:id'); //Actuliza los datos de un feed
      //Asigna los valores de las variables a la consulta
      $update->bindValue('title',$feed->title);
  		$update->bindValue('description',$feed->body);
  		$update->bindValue('image',$feed->image);
  		$update->bindValue('source',$feed->source);
  		$update->bindValue('publisher',$feed->publisher);
  		$update->bindValue('id',$feed->id);
  		$update->execute(); //Ejecuta la consulta
  		$db = null; //Cerrar conexión de la base de datos
    } catch (PDOException $e) {
      $message = $e->getMessage(); //Recoge el mensaje de error
			require_once('application/views/error.php'); //Carga la vista que muestra el mensaje de error
			die(); //Detiene el proceso de la app
    }

	}

  /**
  * Función elimina un feed almacenado en la base de datos indicado por su identificador
  * @param int $id identificador del feed que queremos eliminar
  */
	public static function delete($id){

    //Intenta actulizar información en la base de datos. Si ocurre un error deriva en la vista de error indicando el error.
    try {
  		$db = Database::getConnect(); //Conexión a la base de datos
  		$delete=$db->prepare('DELETE FROM feeds WHERE id=:id'); //Elimina el feed indicado por el id
  		$delete->bindValue('id',$id); //Asigna el valor de la variable a la consulta
  		$delete->execute(); //Ejecuta la consulta
  		$db = null; //Cerrar conexión de la base de datos
    } catch (PDOException $e) {
      $message = $e->getMessage(); //Recoge el mensaje de error
			require_once('application/views/error.php'); //Carga la vista que muestra el mensaje de error
			die(); //Detiene el proceso de la app
    }

	}

  /**
  * Función que elimina todos los feed almacenados en la base de datos
  */
	public static function deleteAll(){

    //Intenta actulizar información en la base de datos. Si ocurre un error deriva en la vista de error indicando el error.
    try {
  		$db = Database::getConnect(); //Conexión a la base de datos
  		$delete=$db->query('DELETE FROM feeds'); //Elimina todos los feeds de la base de datos
  		$db = null; //Cerrar conexión de la base de datos
    } catch (PDOException $e) {
      $message = $e->getMessage(); //Recoge el mensaje de error
			require_once('application/views/error.php'); //Carga la vista que muestra el mensaje de error
			die(); //Detiene el proceso de la app
    }

	}

}
?>
