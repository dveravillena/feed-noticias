<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <h1 class="text-center">Crear Nuevo Feed</h1>
      <br><br>
    </div>
  </div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<form action='save' method='post'>
					<div class="form-group">
						<label>Título:</label>
						<input type="text" class="form-control" name='title' placeholder="Título" maxlength="300">
					</div>
					<div class="form-group">
				    <label>Descripción:</label>
				    <textarea class="form-control" name='description' rows="3"></textarea>
				  </div>
					<div class="form-group">
						<label>Imagen:</label>
						<input type="text" class="form-control" name='image' placeholder="Imagen" maxlength="300">
					</div>
					<div class="form-group">
						<label>Fuente:</label>
						<input type="text" class="form-control" name='source' placeholder="Fuente" maxlength="200">
					</div>
					<div class="form-group">
						<label>Publicado por:</label>
						<input type="text" class="form-control" name='publisher' placeholder="Publisher" maxlength="100">
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary">Guardar</button>
						<a class="btn btn-danger" href="../" role="button">Cancelar</a>
					</div>
			</form>
		</div>
	</div>
</div>
