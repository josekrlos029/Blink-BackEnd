<div id="one">
    <ul style="padding-left: 0;"data-role="listview" id="lista1" class="ui-listview-outer" data-inset="false">
        <?php foreach($pendientes as $p){ 
        $suma =0;
        $lat = $p['lat'];
        $lng = $p['lng'];
        $direccion = $p['direccion'];
        $referencia = $p['referencia'];
        ?>
        <li data-role="collapsible" class="l1" data-iconpos="right" style="margin: 0" data-shadow="false" data-corners="false">
            <h2><?php echo $p["nombres"]." ".$p["apellidos"]; ?></h2>
                <div class="ui-grid-a">
                <div class="ui-block-a"><center><a href="#popupAceptar" onclick="popAceptar(<?php echo $p['idDomicilio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #84aa1f; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-check ui-btn-icon-right boton">Aceptar</a></center></div>
                <div class="ui-block-b"><center><a href="#popupRechazar" onclick="popRechazar(<?php echo $p['idDomicilio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #be1522; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-right boton">Rechazar</a></center></div>
            </div>
            <ul class="l2" data-role="listview" data-inset="true">
                <?php $detalle = new DetalleDomicilio();
                $detalles = $detalle->leerDetallesPorDomicilio($p["idDomicilio"]);
                foreach($detalles as $d){
                $suma += $d["cantidad"] * $d["valor"];
                $cantidad += $d["cantidad"];
                ?>
                <li>
                    <a href="#">
                        <?php echo $d["nombre"]; ?>
                        <p>Cat: <b><?php echo $d["nombreCategoria"]; ?></b></p>
                        <p>Ind: <b><?php echo $d["indicaciones"]; ?></b></p>
                        <p class="ui-li-aside">Cantidad: <strong><?php echo $d["cantidad"];?></strong></p>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <p>Total: <?php echo $suma; ?></p>
        </li>
        <?php } ?> 
    </ul>
</div>
<div id="two">
    <ul style="padding-left: 0;"data-role="listview" id="lista2" class="ui-listview-outer" data-inset="false">
        <?php foreach($aceptados as $a){ 
        $suma =0;
        $lat = $a['lat'];
        $lng = $a['lng'];
        $direccion = $a['direccion'];
        $referencia = $a['referencia'];
        ?>
        <li data-role="collapsible" class="l1" data-iconpos="right" style="margin: 0" data-shadow="false" data-corners="false">
            <h2><?php echo $a["nombres"]." ".$a["apellidos"]; ?></h2>
            <center><a href="#popupUbicacion" onclick="popUbicacion( '<?php echo $lat; ?>', '<?php echo $lng; ?>', '<?php echo $direccion; ?>', '<?php echo $referencia; ?>' )" data-rel="popup" data-position-to="window" data-transition="flow" class="ui-btn ui-shadow ui-corner-all ui-icon-location ui-btn-icon-right boton">Ubicación</a></center>
            <div class="ui-grid-a">
                <div class="ui-block-a"><center><a href="#popupListo" onclick="popListo(<?php echo $a['idDomicilio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #84aa1f; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-check ui-btn-icon-right boton">Aceptar</a></center></div>
                <div class="ui-block-b"><center><a href="#popupCancelar" onclick="popCancelar(<?php echo $a['idDomicilio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #be1522; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-right boton">Cancelar</a></center></div>
            </div>
            <ul class="l2" data-role="listview" data-inset="true">
                <?php $detalle = new DetalleDomicilio();
                $detalles = $detalle->leerDetallesPorDomicilio($a["idDomicilio"]);
                foreach($detalles as $d){
                $suma += $d["cantidad"] * $d["valor"];
                ?>
                <li>
                    <a href="#">
                        <?php echo $d["nombre"]; ?>
                        <p>Cat: <b><?php echo $d["nombreCategoria"]; ?></b></p>
                        <p>Ind: <b><?php echo $d["indicaciones"]; ?></b></p>
                        <p class="ui-li-aside">Cantidad: <strong><?php echo $d["cantidad"];?></strong></p>
                    </a>
                </li>
                <?php } ?>

            </ul>
            <p>Total: <?php echo $suma; ?></p>
        </li>
        <?php } ?> 
    </ul>
</div>
<div id="three">
    <ul style="padding-left: 0;"data-role="listview" id="lista3" class="ui-listview-outer" data-inset="false">
        <?php foreach($listos as $e){ 
        $suma =0;
        $lat = $e['lat'];
        $lng = $e['lng'];
        $direccion = $e['direccion'];
        $referencia = $e['referencia'];
        ?>
        <li data-role="collapsible" class="l1" data-iconpos="right" style="margin: 0" data-shadow="false" data-corners="false">
            <h2><?php echo $e["nombres"]." ".$e["apellidos"]; ?></h2>
            <center><a href="#popupUbicacion" onclick="popUbicacion( '<?php echo $lat; ?>', '<?php echo $lng; ?>', '<?php echo $direccion; ?>', '<?php echo $referencia; ?>' )" data-rel="popup" data-position-to="window" data-transition="flow" class="ui-btn ui-shadow ui-corner-all ui-icon-location ui-btn-icon-right boton">Ubicación</a></center>
            <ul class="l2" data-role="listview" data-inset="true">
                <?php $detalle = new DetalleDomicilio();
                $detalles = $detalle->leerDetallesPorDomicilio($e["idDomicilio"]);
                foreach($detalles as $d){
                $suma += $d["cantidad"] * $d["valor"];
                ?>
                <li>
                    <a href="#">
                        <?php echo $d["nombre"]; ?>
                        <p>Cat: <b><?php echo $d["nombreCategoria"]; ?></b></p>
                        <p>Ind: <b><?php echo $d["indicaciones"]; ?></b></p>
                        <p class="ui-li-aside">Cantidad: <strong><?php echo $d["cantidad"]; ?></strong></p>
                    </a>
                </li>
                <?php } ?>

            </ul>
            <p>Total: <?php echo $suma; ?></p>
        </li>
        <?php } ?> 
    </ul>
</div>