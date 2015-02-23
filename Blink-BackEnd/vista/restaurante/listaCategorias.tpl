<ul style="background: white" data-role="listview" data-inset="false" style="margin-top:10px;" id="lista">
    <?php foreach ($categorias as $r){ ?>
    <li>
        <a style="border-color: #CEC6C6" href="#" onclick="mostrarProductos(<?php echo $r->getIdCategoria(); ?>, '<?php echo $r->getNombre(); ?>')">
            <?php echo $r->getNombre(); ?>
            <p><button onclick="eliminarProducto('<?php echo $r->getIdCategoria(); ?>');">Eliminar</button></p>
        </a>
        
    </li>
    <?php } ?>
</ul>