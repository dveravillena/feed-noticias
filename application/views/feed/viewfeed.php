<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <h1 class="text-center">Editar Feed</h1>
      <br><br>
    </div>
  </div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
      <a class="btn btn-danger pull-right" href="delete/<?php echo $feed->id; ?>" role="button">Borrar Feed</a><br>
			<form action='save' method='post'>
          <input type="hidden" name="id" value="<?php echo $feed->id; ?>">
					<div class="form-group">
						<label>Título:</label>
						<input type="text" class="form-control" name='title' placeholder="Título" maxlength="300" value='<?php echo str_replace("'","\"",$feed->title); ?>'>
					</div>
					<div class="form-group">
				    <label>Descripción:</label>
				    <textarea class="form-control" name='description' rows="3"><?php echo $feed->body; ?></textarea>
				  </div>
					<div class="form-group">
						<label>Imagen:</label>
						<input type="text" class="form-control" name='image' placeholder="Imagen" maxlength="300" value='<?php echo $feed->image; ?>'>
					</div>
					<div class="form-group">
						<label>Fuente:</label>
						<input type="text" class="form-control" name='source' placeholder="Fuente" maxlength="200" value='<?php echo $feed->source; ?>'>
					</div>
					<div class="form-group">
						<label>Publicado por:</label>
						<input type="text" class="form-control" name='publisher' placeholder="Publisher" maxlength="100" value='<?php echo $feed->publisher; ?>'>
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary">Guardar</button>
						<a class="btn btn-danger" href="../" role="button">Cancelar</a>
					</div>
			</form>
		</div>
	</div>
</div>
