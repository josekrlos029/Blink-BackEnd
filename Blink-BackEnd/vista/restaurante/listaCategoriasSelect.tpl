<option></option>
<?php foreach ($categorias as $r){ ?>
    <option value="<?php echo $r->getIdCategoria(); ?>" ><?php echo $r->getNombre(); ?></option>
<?php } ?>
