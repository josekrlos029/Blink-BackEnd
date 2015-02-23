<ul style="padding-left: 0;"data-role="listview" id="lista" class="ui-listview-outer" data-inset="false">
    <?php foreach($categorias as $categoria){ ?>
    <li data-role="collapsible" class="l1" data-iconpos="right" style="margin: 0" data-shadow="false" data-corners="false">
        <h2><?php echo $categoria->getNombre(); ?></h2>
        <ul class="l2" data-role="listview" data-inset="true">
        <?php $producto = new ProductoRestaurante();
              $productos = $producto->leerProductoPorCategoria($categoria->getIdCategoria());
              foreach($productos as $p){
        ?>
        <li data-icon="shop" onclick="pop('<?php echo $p->getIdProducto(); ?>','<?php echo $p->getNombre(); ?>','<?php echo $p->getDescripcion(); ?>','<?php echo $p->getPrecio(); ?>','<?php echo $p->getEstado(); ?>');">
                <a href="#popup" data-rel="popup" data-position-to="window" data-transition="flow">
                    <?php echo $p->getNombre(); ?> 
                    <p><?php echo $p->getDescripcion(); ?></p>
                     <p class="ui-li-aside"><strong>$ <?php echo $p->getPrecio(); ?></strong></p>
                </a>
            </li>
        <?php } ?>
        </ul>
    </li>
    <?php } ?> 
</ul>