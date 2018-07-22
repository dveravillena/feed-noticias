<?php

class FeedServices {

  public $feedlist;

  public function __construct() {
		$this->feedlist = array();
	}

  /**
  * Función que recorre las fuentes indicadas en busca de las
  * últimas noticias
  */
  public function searchFeeds() {
    $cantidad_noticias = 5;
		$this->search_el_mundo($cantidad_noticias);
		$this->search_el_pais($cantidad_noticias);
	}

  /**
  * Función que realiza web scraping en la web de El Mundo
  * en busca de sus últimas noticias
  * @param int $noticias número de noticias a recoger
  * Almacena las noticas recogidas en la lista global de noticias
  */
  public function search_el_mundo($noticias) {

		$html = file_get_contents('http://www.elmundo.es/'); //Obtiene el contenido de la web
		$dom = new DOMDocument('1.0', 'utf-8'); //Crea un nuevo documento dom
		@$dom->loadHTML($html); //Carga el contenido de la web en el documento dom

    //Recoge todas las etiquetas 'article' que corresponden a las noticias
		$articulos = $dom->getElementsByTagName("article");

    //Recorre todos los articulos en busca de los atributos necesarios del numero de noticias indicadas
		for ($i=0; $i < $noticias; $i++) {

  		$articulo = $articulos->item($i);

  		$title = $this->getNodeByClass($articulo, 'header', 'mod-header'); //Función que obtiene el nodo indicado mediante la etiqueta y la clase
  		if ($title) { //Comprueba que se ha obtenido el nodo
  		    $title = $title->nodeValue; //Obtiene el valor del nodo donde se encuentra el título
  		} else { //Intenta recoger el título en otro tipo de articulos que hay en el periodico
      		$title = $this->getNodeByClass($articulo, 'a', 'flex-article__heading-link'); //Función que obtiene el nodo indicado mediante la etiqueta y la clase
      		if ($title) { //Comprueba que se ha obtenido nodo si no crea el título como nulo
      		    $title = $title->nodeValue; //Obtiene el valor del nodo donde se encuentra el título
      		} else {
        	    $title = null;
      		}
  		}

  		$description = $this->getNodeByClass($articulo, 'p', 'entradilla'); //Función que obtiene el nodo indicado mediante la etiqueta y la clase
  		if ($description) { //Comprueba que se ha obtenido el nodo si no crea la descripción como nula
    	    $description = $description->nodeValue; //Obtiene el valor del nodo donde se encuentra la descripción
  		} else {
          $description = null;
  		}

  		$source = $this->getNodeByClass($articulo, 'header', 'mod-header'); //Función que obtiene el nodo indicado mediante la etiqueta y la clase
  		if ($source && $source->getElementsByTagName('a')->item(0)) { //Comprueba que se ha obtenido nodo
    	    $source = $source->getElementsByTagName('a')->item(0)->getAttribute('href');
  		} else { //Intenta recoger la fuente en otro tipo de articulos que hay en el periodico
    		  $source = $this->getNodeByClass($articulo, 'a', 'flex-article__heading-link'); //Función que obtiene el nodo indicado mediante la etiqueta y la clase
    		  if ($source) { //Comprueba que se ha obtenido el nodo si no crea la fuente como nula
    		      $source = $source->getAttribute('href'); //Obtiene el atributo del nodo para obtener la fuente
    		  } else {
    		      $source = null;
    		  }
  		}

  		$img = $this->getNodeByClass($articulo, 'a', 'image-item'); //Función que obtiene el nodo indicado mediante la etiqueta y la clase
  		if ($img && $img->getElementsByTagName('img')->item(0)) { //Comprueba que se ha obtenido el nodo si no crea la imagen como nula
  		    $img = $img->getElementsByTagName('img')->item(0)->getAttribute('src'); //Obtiene el atributo de la etiqueta recogida del nodo para obtener la imagen
  		} else {
  		    $img = null;
  		}

  		$publisher = $this->getNodeByClass($articulo, 'ul', 'mod-author'); //Función que obtiene el nodo indicado mediante la etiqueta y la clase
  		if ($publisher && $publisher->getElementsByTagName("li")->item(0)) { //Comprueba que se ha obtenido el nodo si no crea el publisher como nulo
          //Obtiene el valor de la etiqueta recogida del nodo para obtener el publisher y le añade el periódico
          $publisher = $publisher->getElementsByTagName("li")->item(0)->nodeValue." | El Mundo";
  		} else {
  		    $publisher = null;
  		}
      //Almacena los datos recogidos en un array y los añade a la lista global
  		$this->feedlist[] = array('title' => $title, 'description' => $description, 'source' => $source, 'image' => $img, 'publisher' => $publisher);

		}

	}

  /**
  * Función que realiza web scraping en la web de El País
  * en busca de sus últimas noticias
  * @param int $noticias número de noticias a recoger
  * Almacena las noticas recogidas en la lista global de noticias
  */
  public function search_el_pais($noticias) {

		$html = file_get_contents('https://elpais.com/'); //Obtiene el contenido de la web
		$dom = new DOMDocument('1.0', 'utf-8'); //Crea un nuevo documento dom
		@$dom->loadHTML($html); //Carga el contenido de la web en el documento dom

    //Recoge todas las etiquetas 'article' que corresponden a las noticias
		$articulos = $dom->getElementsByTagName("article");

    //Recorre todos los articulos en busca de los atributos necesarios del numero de noticias indicadas
		for ($i=0; $i < $noticias; $i++) {

  		$articulo = $articulos->item($i);

  		$title = $this->getNodeByClass($articulo, 'h2', 'articulo-titulo'); //Función que obtiene el nodo indicado mediante la etiqueta y la clase
  		if ($title) { //Comprueba que se ha obtenido el nodo si no crea el título como nulo
  		    $title = $title->nodeValue; //Obtiene el valor del nodo donde se encuentra el título
  		} else {
  		    $title = null;
  		}

  		$description = $this->getNodeByClass($articulo, 'p', 'articulo-entradilla'); //Función que obtiene el nodo indicado mediante la etiqueta y la clase
  		if ($description) { //Comprueba que se ha obtenido el nodo si no crea la descripción como nula
  		    $description = $description->nodeValue; //Obtiene el valor del nodo donde se encuentra la descripción
  		} else {
  		    $description = null;
  		}

  		$source = $this->getNodeByClass($articulo, 'h2', 'articulo-titulo'); //Función que obtiene el nodo indicado mediante la etiqueta y la clase
  		if ($source && $source->getElementsByTagName('a')->item(0)) { //Comprueba que se ha obtenido el nodo si no crea la fuente como nula
  		    $source = 'https://elpais.com/'.$source->getElementsByTagName('a')->item(0)->getAttribute('href'); //Obtiene el atributo de la etiqueta recogida del nodo para obtener la fuente
  		} else {
  		    $source = null;
  		}

  		$img = $this->getNodeByAttributte($articulo, 'meta', 'itemprop', 'url'); //Función que obtiene el nodo indicado mediante la etiqueta, el atributo y su valor
  		if ($img) { //Comprueba que se ha obtenido el nodo si no crea la imagen como nula
  		    $img = $img->getAttribute('content'); //Obtiene el atributo del nodo donde se encuentra la imagen
  		} else {
  		    $img = null;
  		}

  		$publisher = $this->getNodeByClass($articulo, 'span', 'autor-nombre'); //Función que obtiene el nodo indicado mediante la etiqueta y la clase
  		if ($publisher) { //Comprueba que se ha obtenido el nodo si no crea el publisher como nulo
  		    $publisher = $publisher->nodeValue." | El Pais";  //Obtiene el valor del nodo donde se encuentra el publisher y le añade el periódico
  		} else {
  		    $publisher = null;
  		}

      //Almacena los datos recogidos en un array y los añade a la lista global
  		$this->feedlist[] = array('title' => $title, 'description' => $description, 'source' => $source, 'image' => $img, 'publisher' => $publisher);
	  }

	}

  /**
  * Función que recorre los nodos de un elemento dom
  * en busca del nodo con la etiqueta y la clase indicados
  * @param DOMElement $articulo elemento a recorrer
  * @param string $tag etiqueta que busca
  * @param string $class clase de la etiqueta que busca
  * Devuelve el nodo si lo ha encontrado
  */
  function getNodeByClass($articulo, $tag, $class)
	{
  	$tags = $articulo->getElementsByTagName($tag); //Recoge todos los elementos con la etiqueta indicada
    /*
      Recorre todas las etiquetas obtenidas y comprueba si la clase es la
      indicada. Si encuentra el nodo correcto lo devuelve.
    */
  	for ($x = 0; $x < $tags->length; $x++) {
    	$node = $tags->item($x);
    	if (stripos($node->getAttribute('class'), $class) !== false) {
    	    return $node;
    	}
  	}
	}

  /**
  * Función que recorre los nodos de un elemento dom
  * en busca del nodo con la etiqueta, el atributo y valor indicados
  * @param DOMElement $articulo elemento a recorrer
  * @param string $tag etiqueta que busca
  * @param string $attributte atributo que busca
  * @param string $attr_value valor del atributo que busca
  * Devuelve el nodo si lo ha encontrado
  */
	function getNodeByAttributte($articulo, $tag, $attributte, $attr_value)
	{
  	$tags = $articulo->getElementsByTagName($tag); //Recoge todos los elementos con la etiqueta indicada
    /*
      Recorre todas las etiquetas obtenidas y comprueba si el atributo indicado
      tiene el valor indicado. Si encuentra el nodo correcto lo devuelve.
    */
  	for ($x = 0; $x < $tags->length; $x++) {
    	$node = $tags->item($x);
    	if (stripos($node->getAttribute($attributte), $attr_value) !== false) {
    	    return $node;
    	}
  	}
	}



}
?>
