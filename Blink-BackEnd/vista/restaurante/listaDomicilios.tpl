<div id="one">
    <ul style="padding-left: 0;"data-role="listview" id="lista1" class="ui-listview-outer" data-inset="false">
        <?php foreach($pendientes as $p){ 
        $suma =0;
        $latR = $p['latRestaurante'];
        $lngR = $p['lngRestaurante'];
        $latU = $p['latUsuario'];
        $lngU = $p['lngUsuario'];
        $direccion = $p['direccion'];
        $referencia = $p['referencia'];
        $telefono = $p['telefono'];
        $billete = $p['billete'];
        if($p['idMensajero'] == NULL || $p['idMensajero'] == ""){
            $nombreMensajero = "Ninguno";
        }else{
            $mensajero = new Mensajero();
            $m = $mensajero->leerPorId($p['idMensajero']);
            $nombreMensajero = $m->getNombres()." ".$m->getApellido();
        }
        ?>
        <li data-role="collapsible" class="l1" data-iconpos="right" style="margin: 0" data-shadow="false" data-corners="false">
            <h2><?php echo $p['nombreRestaurante']." (".$p['idDomicilio'].")"; ?></h2>
        
        
        <div class="ui-grid-a">
            <div class="ui-block-a"><center><a href="#popupAceptar" onclick="popAceptar(<?php echo $p['idDomicilio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #84aa1f; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-check ui-btn-icon-right boton">Aceptar</a></center></div>
            <div class="ui-block-b"><center><a href="#popupRechazar" onclick="popRechazar(<?php echo $p['idDomicilio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #be1522; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-right boton">Rechazar</a></center></div>
        </div>
        
        <p><b>Codigo: </b><?php echo $p['idDomicilio']; ?></p>
        <p><b>HORA:</b><?php echo $p['hora'];  ?></p>
        <p><b>FECHA:</b><?php echo $p['fecha']; ?></p>
        <p><b>Mensajero: </b><a href="#popupAsignarMensajero" onclick="popAsignarDomicilio(<?php echo $p['idDomicilio']; ?>, 'domicilio')" data-rel="popup" class="ui-btn ui-shadow ui-corner-all boton"><?php echo $nombreMensajero; ?></a>
        </p>
        <p><b>Restaurante: </b><?php echo $p['nombreRestaurante']; ?></p>
        <p><b>Tel: </b><?php echo $p['telefonoRestaurante']; ?></p>
        <p><b>Direccion: </b><?php echo $p['direccionRestaurante']; ?></p>
        <p><b>Usuario: </b><?php echo $p['nombreUsuario']." ".$p['apellidoUsuario']; ?></p>
        <p><b>Direccion: </b><?php echo $direccion; ?></p>
        <p><b>Referencia: </b><?php echo $referencia; ?></p>
        <p><b>Telefono: </b><?php echo $telefono; ?></p>
        <p><b>Forma Pago: </b><?php echo $billete; ?></p>
        <p><b>PEDIDO</b></p>
        <ul class="l2" data-role="listview" data-inset="true">
            <?php $detalle = new DetalleDomicilio();
            $detalles = $detalle->leerDetallesPorDomicilio($p["idDomicilio"]);
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
        <p><b>Total:</b> <?php echo $suma; ?></p>
        </li>
        <?php } 
        foreach($sPendientes as $pp){ 
        $suma =0;
        $latU = $pp['lat'];
        $lngU = $pp['lng'];
        $direccion = $pp['direccion'];
        $referencia = $pp['referencia'];
        $telefono = $pp['telefono'];
        $tipo= $pp['tipo'];
        if($pp['idMensajero'] == NULL || $pp['idMensajero'] == ""){
            $nombreMensajero = "Ninguno";
        }else{
            $mensajero = new Mensajero();
            $m = $mensajero->leerPorId($pp['idMensajero']);
            $nombreMensajero = $m->getNombres()." ".$m->getApellido();
        }
        ?>
        <?php 
             if($pp['tipo'] == 'p'){
        ?>

        <li data-role="collapsible" class="l1" data-iconpos="right" style="margin: 0; background-color: #84aa1f;" data-shadow="false" data-corners="false">

        <?php 
             }else{
        ?>

        <li data-role="collapsible" class="l1" data-iconpos="right" style="margin: 0" data-shadow="false" data-corners="false">

        <?php 
             }
        ?>
            <h2><?php echo $pp['servicio']." (".$pp['idServicio'].")"; ?></h2>
        
        
        <div class="ui-grid-a">
            <div class="ui-block-a"><center><a href="#popupAceptar2" onclick="popAceptar2(<?php echo $pp['idServicio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #84aa1f; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-check ui-btn-icon-right boton">Aceptar</a></center></div>
            <div class="ui-block-b"><center><a href="#popupRechazar2" onclick="popRechazar2(<?php echo $pp['idServicio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #be1522; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-right boton">Rechazar</a></center></div>
        </div>
        <p><b>Codigo: </b><?php echo $pp['idServicio']; ?></p>
        <p><b>HORA:</b><?php echo $pp['hora'];  ?></p>
        <p><b>FECHA:</b><?php echo $pp['fecha']; ?></p>
        <p><b>DESCRIPCION:</b><?php echo $pp['descripcion']; ?></p>
        <p><b>Mensajero: </b><a href="#popupAsignarMensajero" onclick="popAsignarDomicilio(<?php echo $pp['idServicio']; ?>, 'servicio')" data-rel="popup" class="ui-btn ui-shadow ui-corner-all boton"><?php echo $nombreMensajero; ?></a>
        </p>
        <p><b>Usuario: </b><?php echo $pp['nombres']." ".$pp['apellidos']; ?></p>
        <p><b>Origen: </b><?php echo $direccion; ?></p>
        <p><b>Destino: </b><?php echo $pp['destino']; ?></p>
        <p><b>Referencia: </b><?php echo $referencia; ?></p>
        <p><b>Telefono: </b><?php echo $telefono; ?></p>
        </li>
        <?php } ?>        
    </ul>
</div>
<div id="two">
    <ul style="padding-left: 0;"data-role="listview" id="lista2" class="ui-listview-outer" data-inset="false">
        <?php foreach($aceptados as $a){ 
        $suma =0;
        $latR = $a['latRestaurante'];
        $lngR = $a['lngRestaurante'];
        $latU = $a['latUsuario'];
        $lngU = $a['lngUsuario'];
        $direccion = $a['direccion'];
        $referencia = $a['referencia'];
        $telefono = $a['telefono'];
        $billete = $a['billete'];
        if($a['idMensajero'] == NULL || $a['idMensajero'] == ""){
            $nombreMensajero = "Ninguno";
        }else{
            $mensajero = new Mensajero();
            $m = $mensajero->leerPorId($a['idMensajero']);
            $nombreMensajero = $m->getNombres()." ".$m->getApellido();
        }
        ?>
        <li data-role="collapsible" class="l1" data-iconpos="right" style="margin: 0" data-shadow="false" data-corners="false">
            <h2><?php echo $a['nombreRestaurante']." (".$a['idDomicilio'].")"; ?></h2>
        
        
        <div class="ui-grid-a">
            <div class="ui-block-a"><center><a href="#popupListo" onclick="popListo(<?php echo $a['idDomicilio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #84aa1f; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-check ui-btn-icon-right boton">Listo</a></center></div>
            <div class="ui-block-b"><center><a href="#popupCancelar" onclick="popCancelar(<?php echo $a['idDomicilio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #be1522; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-right boton">Cancelar</a></center></div>
        </div>
        
        <p><b>Codigo: </b><?php echo $a['idDomicilio']; ?></p>
        <p><b>HORA:</b><?php echo $a['hora'];  ?></p>
        <p><b>FECHA:</b><?php echo $a['fecha']; ?></p>
        <p><b>Mensajero: </b><a href="#popupAsignarMensajero" onclick="popAsignarDomicilio(<?php echo $a['idDomicilio']; ?>, 'domicilio')" class="ui-btn ui-shadow ui-corner-all boton"><?php echo $nombreMensajero; ?></a>
        </p>
        <p><b>Restaurante: </b><?php echo $a['nombreRestaurante']; ?></p>
        <p><b>Tel: </b><?php echo $a['telefonoRestaurante']; ?></p>
        <p><b>Direccion: </b><?php echo $a['direccionRestaurante']; ?></p>
        <p><b>Usuario: </b><?php echo $a['nombreUsuario']." ".$a['apellidoUsuario']; ?></p>
        <p><b>Direccion: </b><?php echo $direccion; ?></p>
        <p><b>Referencia: </b><?php echo $referencia; ?></p>
        <p><b>Telefono: </b><?php echo $telefono; ?></p>
        <p><b>Forma Pago: </b><?php echo $billete; ?></p>
        <p><b>PEDIDO</b>
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
                    <p class="ui-li-aside">Cantidad: <strong><?php echo $d["cantidad"]; ?></strong></p>
                </a>
            </li>
            <?php } ?>
        </ul>
        <p><b>Total:</b> <?php echo $suma; ?></p>
        </li>
        <?php } 
        foreach($sAceptados as $aa){ 
        $suma =0;
        $latU = $aa['lat'];
        $lngU = $aa['lng'];
        $direccion = $aa['direccion'];
        $referencia = $aa['referencia'];
        $telefono = $aa['telefono'];
        $tipo= $aa['tipo'];
        if($aa['idMensajero'] == NULL || $aa['idMensajero'] == ""){
            $nombreMensajero = "Ninguno";
        }else{
            $mensajero = new Mensajero();
            $m = $mensajero->leerPorId($aa['idMensajero']);
            $nombreMensajero = $m->getNombres()." ".$m->getApellido();
        }
        ?>
        <li data-role="collapsible" class="l1" data-iconpos="right" style="margin: 0" data-shadow="false" data-corners="false">
            <h2><?php echo $aa['servicio']." (".$aa['idServicio'].")"; ?></h2>
       
        
        <div class="ui-grid-a">
            <div class="ui-block-a"><center><a href="#popupListo2" onclick="popListo2(<?php echo $aa['idServicio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #84aa1f; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-check ui-btn-icon-right boton">Listo</a></center></div>
            <div class="ui-block-b"><center><a href="#popupCancelar2" onclick="popCancelar2(<?php echo $aa['idServicio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #be1522; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-delete ui-btn-icon-right boton">Rechazar</a></center></div>
        </div>
        
        <p><b>Codigo: </b><?php echo $aa['idServicio']; ?></p>
        <p><b>HORA:</b><?php echo $aa['hora']; ?></p>
        <p><b>FECHA:</b><?php echo $aa['fecha']; ?></p>
        <p><b>DESCRIPCION:</b><?php echo $aa['descripcion']; ?></p>
        <p><b>Mensajero: </b><a href="#popupAsignarMensajero" onclick="popAsignarDomicilio(<?php echo $aa['idServicio']; ?>, 'servicio')" data-rel="popup" class="ui-btn ui-shadow ui-corner-all boton"><?php echo $nombreMensajero; ?></a>
        </p>
        <p><b>Usuario: </b><?php echo $aa['nombres']." ".$aa['apellidos']; ?></p>
        <p><b>Origen: </b><?php echo $direccion; ?></p>
        <p><b>Destino: </b><?php echo $aa['destino']; ?></p>
        <p><b>Referencia: </b><?php echo $referencia; ?></p>
        <p><b>Telefono: </b><?php echo $telefono; ?></p>
        </li>
        <?php } ?> 
 
    </ul>
</div>
<div id="three">
    <ul style="padding-left: 0;"data-role="listview" id="lista3" class="ui-listview-outer" data-inset="false">
        <?php foreach($listos as $l){ 
        $suma =0;
        $latR = $l['latRestaurante'];
        $lngR = $l['lngRestaurante'];
        $latU = $l['latUsuario'];
        $lngU = $l['lngUsuario'];
        $direccion = $l['direccion'];
        $referencia = $l['referencia'];
        $telefono = $l['telefono'];
        $billete = $l['billete'];
        ?>
        <li data-role="collapsible" class="l1" data-iconpos="right" style="margin: 0" data-shadow="false" data-corners="false">
            <h2><?php echo $l['nombreRestaurante']." (".$l['idDomicilio'].")"; ?></h2>
        <center><a href="#popupUbicacion" onclick="verEnMapa('<?php echo $latR; ?>', '<?php echo $lngR; ?>', '<?php echo $latU; ?>', '<?php echo $lngU; ?>')" class="ui-btn ui-shadow ui-corner-all ui-icon-location ui-btn-icon-right boton">Ubicaciar en Mapa</a></center>
        <center><a href="#popupEntregado" onclick="popEntregado(<?php echo $l['idDomicilio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #84aa1f; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-check ui-btn-icon-right boton">Entregado</a></center> 
        <p><b>Codigo: </b><?php echo $l['idDomicilio']; ?></p>
        <p><b>Restaurante: </b><?php echo $l['nombreRestaurante']; ?></p>
        <p><b>Direccion: </b><?php echo $l['direccionRestaurante']; ?></p>
        <p><b>Usuario: </b><?php echo $l['nombreUsuario']." ".$l['apellidoUsuario']; ?></p>
        <p><b>Direccion: </b><?php echo $direccion; ?></p>
        <p><b>Referencia: </b><?php echo $referencia; ?></p>
        <p><b>Telefono: </b><?php echo $telefono; ?></p>
        <p><b>Forma Pago: </b><?php echo $billete; ?></p>
        <?php $detalle = new DetalleDomicilio();
        $detalles = $detalle->leerDetallesPorDomicilio($l["idDomicilio"]);
        foreach($detalles as $d){
        $suma += $d["cantidad"] * $d["valor"];
        $cantidad += $d["cantidad"];
        } ?>

        <p><b>Total:</b> <?php echo $suma; ?></p>
        </li>
        <?php } 
        foreach($sListos as $ll){ 
        $suma =0;
        $latU = $ll['lat'];
        $lngU = $ll['lng'];
        $direccion = $ll['direccion'];
        $referencia = $ll['referencia'];
        $telefono = $ll['telefono'];
        ?>
        <li data-role="collapsible" class="l1" data-iconpos="right" style="margin: 0" data-shadow="false" data-corners="false">
            <h2><?php echo $ll['servicio']." (".$ll['idServicio'].")"; ?></h2>
          
        <center><a href="#popupEntregado2" onclick="popEntregado2(<?php echo $ll['idServicio']; ?>)" data-rel="popup" data-position-to="window" data-transition="flow" style="background-color: #84aa1f; color: white; text-decoration: none;text-shadow: none" class="ui-btn ui-shadow ui-corner-all ui-icon-check ui-btn-icon-right boton">Aceptar</a></center>
        
        <p><b>Codigo: </b><?php echo $ll['idServicio']; ?></p>
        <p><b>Usuario: </b><?php echo $ll['nombres']." ".$ll['apellidos']; ?></p>
        <p><b>Origen: </b><?php echo $direccion; ?></p>
        <p><b>Destino: </b><?php echo $ll['destino']; ?></p>
        <p><b>Referencia: </b><?php echo $referencia; ?></p>
        <p><b>Telefono: </b><?php echo $telefono; ?></p>
        </li>
        <?php } ?> 
    </ul>
</div>