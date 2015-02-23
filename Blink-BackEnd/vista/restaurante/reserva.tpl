<ul style="padding-left: 0;"data-role="listview" id="lista" class="ui-listview-outer" data-inset="false">
    <?php foreach($categorias as $categoria){ ?>
    <li data-role="collapsible" class="l1" data-iconpos="right" style="margin: 0" data-shadow="false" data-corners="false">
        <h2><?php echo $categoria["nombre"]; ?></h2>
        <ul class="l2" data-role="listview" data-inset="true">
        <?php $restaurante = new Restaurante();
              $items = $restaurante->consultarItemDeCategoria($categoria["idCategoria"]);
              foreach($items as $p){
              $id = $p["idItemReserva"];
              $nombre = $p["nombre"];
              $descripcion  = $p["descripcion"];
              $precio  = $p["precio"];
        ?>
        <li data-icon="shop" onclick="popReserva('<?php echo $id; ?>','<?php echo $nombre; ?>','<?php echo $descripcion; ?>','<?php echo $precio; ?>');">
                <a href="#popup" data-rel="popup" data-position-to="window" data-transition="flow">
                    <?php echo $nombre; ?> 
                    <p><?php echo $descripcion; ?></p>
                     <p class="ui-li-aside"><strong>$ <?php echo $precio; ?></strong></p>
                </a>
            </li>
        <?php } ?>
        </ul>
    </li>
    <?php } ?> 
</ul>