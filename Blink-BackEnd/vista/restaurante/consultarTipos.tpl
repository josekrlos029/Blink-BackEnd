<?php foreach ($tipos as $t){ ?>
<li><a href="#" onclick="mostrarRestaurantes('<?php echo $t->getIdTipoRestaurante(); ?>')">
        <img src="http://admin.blinkmanager.com/utiles/imagenes/categorias/<?php echo $t->getIdTipoRestaurante(); ?>.png">
        <h2><?php echo $t->getNombre(); ?></h2>
        <p><?php echo $t->getDescripcion(); ?></p>
    </a>
</li>
<?php } ?>