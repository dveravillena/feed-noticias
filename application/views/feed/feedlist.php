<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <h1 class="text-center">Daily Trends</h1>
      <br>
      <a class="btn btn-primary " href="refresh" role="button">Actualizar Feed</a> &nbsp;&nbsp;&nbsp;
      <a class="btn btn-success" href="feed/new" role="button">Añadir Feed</a>
      <br><br>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php
      if ($feeds) {
        for ($i=0; $i < count($feeds); $i++) {
          echo '<div class="row">';
          echo '<div class="col-md-2 col-md-offset-1">';
          if ($feeds[$i]->image) {
            echo '<img src="'.$feeds[$i]->image.'" class="img-thumbnail" >';
          } else {
            echo '<p>Imagen No Disponible<p>';
          }
          echo '</div>';
          echo '<div class="col-md-6">';
          echo '<a href="'.$feeds[$i]->source.'"><h3>'.$feeds[$i]->title.'</h3></a>';
          if ($feeds[$i]->body) {
            echo '<p>'.$feeds[$i]->body.'</p>';
          }
          if ($feeds[$i]->publisher) {
          echo '<br><p class="text-right">'.$feeds[$i]->publisher.'</p>';
          }
          echo '</div>';
          echo '<div class="col-md-2">';
          echo '<a class="btn btn-info " href="feed/'.$feeds[$i]->id.'" role="button">Editar Feed</a><br><br>';
          echo '<a class="btn btn-danger " href="feed/delete/'.$feeds[$i]->id.'" role="button">Borrar Feed</a>';
          echo '</div>';
          echo '</div>';
          echo "<hr>";
        }
      }

      ?>
    </div>
  </div>
</div>
