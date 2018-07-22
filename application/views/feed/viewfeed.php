Editar Feed
<form action='save' method='post'>
	<input type='hidden' name='id' value="<?php echo $feed->id; ?>">
  <label>Título:</label><br><input type='text' name='title' value='<?php echo $feed->title; ?>'><br>
  <label>Descripción:</label><br><input type='text' name='description' value='<?php echo $feed->body; ?>'><br>
  <label>Imagen:</label><br><input type='text' name='image' value='<?php echo $feed->image; ?>'><br>
  <label>Fuente:</label><br><input type='text' name='source' value='<?php echo $feed->source; ?>'><br>
  <label>Publicado por:</label><br><input type='text' name='publisher' value='<?php echo $feed->publisher; ?>'><br>
	<br><input type='submit' value='Guardar'>
</form>
<br><br>
<a href="delete/<?php echo $feed->id; ?>">Borrar Feed</a>
