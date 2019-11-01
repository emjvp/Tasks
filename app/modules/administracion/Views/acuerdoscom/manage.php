<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->contenidos_sec_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->contenidos_sec_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-12 form-group">
					<label for="contenidos_sec_titulo"  class="control-label">T&iacute;tulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->contenidos_sec_titulo; ?>" name="contenidos_sec_titulo" id="contenidos_sec_titulo" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="contenidos_sec_descripcion" class="form-label" >Descripci&oacute;n</label>
					<textarea name="contenidos_sec_descripcion" id="contenidos_sec_descripcion"   class="form-control tinyeditor" rows="10"   ><?= $this->content->contenidos_sec_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label class="control-label">Acuerdo Comercial</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="contenidos_sec_seccionid"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_contenidos_sec_seccionid AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"contenidos_sec_seccionid") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="contenidos_sec_imagen" >Imagen</label>
					<input type="file" name="contenidos_sec_imagen" id="contenidos_sec_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  >
					<div class="help-block with-errors"></div>
					<?php if($this->content->contenidos_sec_imagen) { ?>
						<div id="imagen_contenidos_sec_imagen">
							<img src="/images/<?= $this->content->contenidos_sec_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('contenidos_sec_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>