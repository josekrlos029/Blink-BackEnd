<ul data-role="listview" id="domicilios" data-inset="true" data-divider-theme="a">
    <li data-role="list-divider">Pendientes</li>
    <?php foreach($pendientes as $p){
        $hora = $p["hora"];
        $fecha = $p["fecha"];
    ?>
        <li><?php echo $p["nombre"]; ?></li>
    <?php } ?>   
    <li data-role="list-divider">Aceptados</li>
    <?php foreach($aceptados as $a){ ?>
        <li><?php echo $a["nombre"]; ?></li>
    <?php } ?>     
    <li data-role="list-divider">Listos</li>
    <?php foreach($listos as $l){ ?>
        <li><?php echo $l["nombre"]; ?></li>
    <?php } ?>     
    <li data-role="list-divider">Entregados</li>
    <?php foreach($entregados as $e){ ?>
        <li><?php echo $e["nombre"]; ?></li>
    <?php } ?>     
</ul>