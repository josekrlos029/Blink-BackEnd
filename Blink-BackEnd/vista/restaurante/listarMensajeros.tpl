<?php 
    foreach($mensajeros as $m){
?>
<option value="<?php echo $m->getIdMensajero(); ?>"><?php echo $m->getNombres(). " ".$m->getApellido(); ?></option>
<?php 
    }
?>