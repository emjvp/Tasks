<div class="seccion">
    <div class="imagen">
        <img src="/images/<?php echo $this->acuerdos_comerciales->contenidos_imagen?>" alt="">
    </div>
</div>
<div class="container">
    <div class="acuerdos-comerciales">
        <h2 class="titulo">ACUERDOS COMERCIALES</h2>
        <div class="row">
            <?php foreach ($this->acuerdos as $key => $acuerdo) {?>
                    <div class="col-lg-5">
                    <div class="introduccion-acuerdo">
                            <h3 class="titulo"><?php echo $acuerdo['detalle']->seccion_titulo;?></h3>
                            <?php echo $acuerdo['detalle']->seccion_descripcion;?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12"> 
                        <div class="row">
                            <?php foreach ($acuerdo['contenido_seccion'] as $key => $contenidoseccion) {?>                                
                                <div class="col-md-6 col-lg-6">
                            <div class="descripcion <?php if($key == 0){?> linea<?php }?>">
                                        <?php echo $contenidoseccion->contenidos_sec_descripcion; ?>
                                    </div>
                                </div>                            
                            <?php } ?> 
                        </div>
                    </div>
            <?php } ?>
        </div>
    </div>
</div>