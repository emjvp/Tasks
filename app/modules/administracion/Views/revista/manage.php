<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->revista_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->revista_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-6 form-group">
					<label for="revista_titulo"  class="control-label">Titulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->revista_titulo; ?>" name="revista_titulo" id="revista_titulo" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label for="revista_imagen" >Imagen</label>
					<input type="file" name="revista_imagen" id="revista_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  <?php if(!$this->content->revista_id){ echo 'required'; } ?>>
					<div class="help-block with-errors"></div>
					<?php if($this->content->revista_imagen) { ?>
						<div id="imagen_revista_imagen">
							<img src="/images/<?= $this->content->revista_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('revista_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-12 form-group">
					<label for="revista_introduccion" class="form-label" >Introduccion</label>
					<textarea name="revista_introduccion" id="revista_introduccion"   class="form-control tinyeditor" rows="10"   ><?= $this->content->revista_introduccion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label for="revista_descripcion" class="form-label" >Descripcion</label>
					<textarea name="revista_descripcion" id="revista_descripcion"   class="form-control tinyeditor" rows="10"   ><?= $this->content->revista_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group">
					<label for="revista_pdf" >Pdf</label>
					<input type="file" name="revista_pdf" id="revista_pdf" class="form-control  file-document" data-buttonName="btn-primary" onchange="validardocumento('revista_pdf');" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf" >
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