<ul style="background: white" data-role="listview" data-inset="false" id="lista2">
    <?php foreach ($restaurantes as $r){ ?>
    <li>
        <a style="border-color: #CEC6C6" href="#" onclick="mostrarRestaurante(<?php echo $r->getIdRestaurante(); ?>)">
            <img src="http://admin.blinkmanager.com/utiles/imagenes/restaurantes/<?php echo $r->getIdRestaurante(); ?>.png">
            <h2 style="color: black"><?php echo $r->getNombre(); ?></h2>
            <p style="color: black"><?php echo $r->getDescripcion(); ?></p>
        </a>
    </li>
    <?php } ?>
</ul>