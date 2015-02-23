<ul style="background: white" data-role="listview" data-inset="false" id="lista2">
    <?php foreach ($productos as $p){ ?>
    <li>
        <a href="#popup" onclick="pop(<?php echo $p->getIdProducto() ?>)" data-rel="popup" data-position-to="window" data-transition="flow">
            <?php echo $p->getNombre(); ?> 
            <p><?php echo $p->getDescripcion(); ?></p>
            <p class="ui-li-aside"><strong>$ <?php echo $p->getPrecio(); ?></strong></p>
            <p><button onclick="eliminarProducto('<?php echo $p->getIdProducto() ?>');">Eliminar</button></p>
        </a>
    </li>
    <?php } ?>
</ul>