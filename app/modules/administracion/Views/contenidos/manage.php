<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->contenidos_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->contenidos_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-3 form-group">
					<label for="contenidos_fecha"  class="control-label">Fecha</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul " ><i class="fas fa-calendar-alt"></i></span>
						</div>
					<input type="text" value="<?php if($this->content->contenidos_fecha){ echo $this->content->contenidos_fecha; } else { echo date('Y-m-d'); } ?>" name="contenidos_fecha" id="contenidos_fecha" class="form-control"   data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-language="es"  >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label class="control-label">Seccion</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="contenidos_seccion"  required >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_contenidos_seccion AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"contenidos_seccion") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-3 form-group">
					<label class="control-label">Estado</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="contenidos_estado"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_contenidos_estado AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"contenidos_estado") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-5 form-group">
					<label for="contenidos_titulo"  class="control-label">Titulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->contenidos_titulo; ?>" name="contenidos_titulo" id="contenidos_titulo" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-5 form-group">
					<label for="contenidos_subtitulo"  class="control-label">Subtitulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->contenidos_subtitulo; ?>" name="contenidos_subtitulo" id="contenidos_subtitulo" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-2 form-group">
					<label class="control-label">Color Fondo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="contenidos_color"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_contenidos_color AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"contenidos_color") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="contenidos_introduccion" class="form-label" >Introduccion</label>
					<textarea name="contenidos_introduccion" id="contenidos_introduccion"   class="form-control tinyeditor" rows="10"   ><?= $this->content->contenidos_introduccion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="contenidos_descripcion" class="form-label" >Descripcion</label>
					<textarea name="contenidos_descripcion" id="contenidos_descripcion"   class="form-control tinyeditor" rows="10"   ><?= $this->content->contenidos_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label for="contenidos_imagen" >Imagen</label>
					<input type="file" name="contenidos_imagen" id="contenidos_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  >
					<div class="help-block with-errors"></div>
					<?php if($this->content->contenidos_imagen) { ?>
						<div id="imagen_contenidos_imagen">
							<img src="/images/<?= $this->content->contenidos_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('contenidos_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-6 form-group">
					<label for="contenidos_fondo" >Imagen de Fondo</label>
					<input type="file" name="contenidos_fondo" id="contenidos_fondo" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  >
					<div class="help-block with-errors"></div>
					<?php if($this->content->contenidos_fondo) { ?>
						<div id="imagen_contenidos_fondo">
							<img src="/images/<?= $this->content->contenidos_fondo; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('contenidos_fondo','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-6 form-group">
					<label for="contenidos_archivo" >Archivo</label>
					<input type="file" name="contenidos_archivo" id="contenidos_archivo" class="form-control  file-document" data-buttonName="btn-primary" onchange="validardocumento('contenidos_archivo');" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf" >
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label for="enlace"  class="control-label">Enlace</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->enlace; ?>" name="enlace" id="enlace" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>