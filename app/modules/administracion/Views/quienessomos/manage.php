<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->quienes_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->quienes_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-12 form-group">
					<label for="quienes_titulo"  class="control-label">Titulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->quienes_titulo; ?>" name="quienes_titulo" id="quienes_titulo" class="form-control" >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="quienes_descripcion" class="form-label" >Descripcion</label>
					<textarea name="quienes_descripcion" id="quienes_descripcion"   class="form-control tinyeditor" rows="10"  required ><?= $this->content->quienes_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="quienes_aliado"  value="<?php if($this->content->quienes_aliado){ echo $this->content->quienes_aliado; } else { echo $this->contenido; } ?>">
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?contenido=<?php if($this->content->quienes_aliado){ echo $this->content->quienes_aliado; } else { echo $this->contenido; } ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>