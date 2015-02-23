<script type="text/javascript">

    function subir(carpeta){
        var id= "categoria";
        
        var complemento = $("#idTipo").val() + "-" + carpeta;
        
        $("#"+id).upload('/administrador/actualizarFoto/'+complemento,
            {
               nombre_archivo: "archivo"
            },
            function(respuesta) {
               //Subida finalizada.
               
               if (respuesta == "1") {
                  alert('El archivo ha sido subido correctamente.');
               } else {
                  alert('El archivo NO se ha podido subir.');
               }
               
            }, function(progreso, valor) {
                  //Barra de progreso.
                  
        });
    }
    
 $('#filter').keyup(function(){
    var table = $('#table');
    var value = this.value;
    table.find('.recorrer').each(function(index, row) {
        var allCells = $(row).find('td');
        if(allCells.length > 0) {
            var found = false;
            allCells.each(function(index, td) {
                var regExp = new RegExp(value, 'i');
                if(regExp.test($(td).text())) {
                    found = true;
                    return false;
                }
            });
            if (found == true) $(row).show();
            else $(row).hide();
        }
    });
});

    function consultaPersona(idTipo) {
        
        var x = $("#mensaje");
        cargando();
        x.html ("<p>Cargando...</p>");
        x.show("speed");
    
        var data = { idTipo: idTipo };

        $.ajax({
            type: "POST",
            url: "/administrador/consultarTipoRestaurante",
            data: data
        }).done(function(msg) {

            var json = eval("(" + msg + ")");
            
            $("#idTipo").val(json.id);
            $("#nombreT").val(json.nombre);
            $("#descripcionT").val(json.descripcion);
            $("#moduloT").val(json.modulo);
            
            ocultar();
            document.getElementById('light').style.display = 'block';
            document.getElementById('fade').style.display = 'block';
            
        });
    }  
    
    function modificarPersona(){
   
        var x = $("#mensaje");
        var y = $("#overlay");
        cargando();
        x.html ("<p>Cargando...</p>");
        x.show("speed");
        y.show("speed");
      
        var idTipo = $("#idTipo").val();
        var nombre = $("#nombreT").val();
        var descripcion = $("#descripcionT").val();
        var modulo = $("#moduloT").val();
        
        document.getElementById('light').style.display = 'none';
        document.getElementById('fade').style.display = 'none';
        var persona ={ idRestaurante:idTipo,
                    nombre: nombre,
                    descripcion:descripcion,
                    modulo:modulo
        };
        
        $.ajax({
                      type: "POST",
                      url: "/administrador/modificarTipo",
                      data: persona
                  })
                  .done(function(msg) {
                      
                      var json = eval("(" + msg + ")");
              
                      if (json == "exito") {
                      
                         document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'
                         
                            
                            x.html ( "<p>Categoría Modificada Correctamente</p>");
                            y.html();
                            exito();
                            ocultar();
                            $("#contenido").load("/administrador/gestionarCategorias");
                      } else if(json == 23000) {

                            limpiarCajas();
                            x.html ( "<p>Error al Modificar Categoría</p>");
                            y.html();
                            error();
                            ocultar();
                            document.getElementById('light').style.display = 'block';
                            document.getElementById('fade').style.display = 'block';
                      }
                  });
    }

    $("#form").submit(function() {

        var x = $("#mensaje");
        var y = $("#overlay");
        cargando();
        x.html("<p>Cargando...</p>");
        x.show("slow");
        y.show("speed");
        
        
        var descripcion = $("#descripcion").val();
        var nombre = $("#nombre").val();
        var modulo = $("#modulo").val();
        
        
        var persona ={ nombre:nombre,
                    descripcion:descripcion,
                    modulo:modulo
        };

        $.ajax({
            type: "POST",
            url: "/administrador/registrarTipoRestaurante",
            data: persona
        })
                .done(function(msg) {

                    var json = eval("(" + msg + ")");

                    if (json == "exito") {

                        limpiarCajas();
                        x.html("<p>Categoría Registrada Correctamente</p>");
                        y.html();
                        exito();
                        ocultar();
                        $("#contenido").load("/administrador/gestionarCategorias");

                    } else if (json == 23000) {

                        limpiarCajas();
                        x.html("<p>Error al registrar Categoría</p>");
                        y.html();
                        error();
                        ocultar();

                    }
                });
        
    });
    
    function validarNro(e) {
           var key;
            if(window.event) // IE
	         {
	             key = e.keyCode;
	         }
             else if(e.which) // Netscape/Firefox/Opera
	         {
	            key = e.which;
	         }

                if (key < 48 || key > 57)
                {
                  if(key == 46 || key == 8) // Detectar . (punto) y backspace (retroceso)
                { return true; }
             else 
               { return false; }
               }
              return true;
             }

    function validar_texto(e) {
           tecla = (document.all) ? e.keyCode : e.which;

            //Tecla de retroceso para borrar, siempre la permite
             if (tecla==8) return true; 

             // Patron de entrada, en este caso solo acepta letras
                 patron =/[A-Za-z\s]/; 

                   tecla_final = String.fromCharCode(tecla);
                  return patron.test(tecla_final); 
        } 
   
</script>
<div  id="overlay"></div>
<div  id="mensaje">
    <div style="float:right">
        <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display = 'none';
                document.getElementById('fade').style.display = 'none'"><img src="../utiles/image/close.png"/></a>
    </div>

</div>
<div id="cont-form">   
    <form id="form" action="javascript: return false;">
        <table border="0" align="left" width="100%" style="margin-bottom: 10px" >
            <tr><td style="text-align: left;"><h2>Registro de Categoría</h2></td></tr>
            <tr><td style="text-align: left;"><input type="text" name="nombre" id="nombre" required placeholder="Nombre"  class="box-text"></td></tr>
            <tr><td style="text-align: left;"><textarea id="descripcion" placeholder="Descripción..." class="box-text" cols="30" rows="3"></textarea></td></tr>
            <tr><td style="text-align: left;">
                    Módulo:<select class="box-text" id="modulo">
                        <option value="PEDIDOS">PEDIDOS</option>
                        <option value="RESERVAS">RESERVAS</option>
                        <option value="SERVICIOS">SERVICIOS</option>
                    </select>
                </td>
            </tr>
            <tr><td style="text-align:right;"><button type="submit" class="button orange large"  >Guardar</button></td></tr>
            
        </table>
    </form>
    
    
</div>

<div id="cont-consulta">

    <table border="0" align="right" width="70%">
        <tr><td style="text-align: center;"><h2>Consulta de Categorías</h2></td>
            <td style="text-align: right;"><input type="text" name="idPersona" required placeholder="Buscar" class="box-text" id="filter"></td>
    </table>

    <div style="margin-top:10%; overflow: scroll; height: 500px">
        <table border="0" align="center" width="100%" id="mitabla" >
            <thead>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Módulo</th>
            <th width="5%"></th>
            </thead>
            <tbody id="table">
                <?php 
                foreach($tipos as $tipo){ 
                ?>
                <tr class="recorrer" align="left">
                    <td><?php echo $tipo->getNombre(); ?></td>
                    <td><?php echo $tipo->getDescripcion(); ?></td>
                    <td><?php echo $tipo->getSeccion(); ?></td>
                    <td width="5%" style="text-align:right;"><buttom type="submit" class="button small red"  onclick="consultaPersona('<?php echo $tipo->getIdTipoRestaurante(); ?>');">...</buttom></td> 
            </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>

</div>
<div id="fade" class="overlay"></div>
<div id="light" class="modal">
              <div style="float:right">
                  <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><img src="../utiles/image/close.png"/></a>
             </div>
                
       <div style=" margin-top: 5%;margin-left: 5%; float:left; width:45%;">
        <h2>Datos de La Categoría</h2>
        </br>
        <table width="100%">
            <tr>
                <td>
                    Codigo del Sitio:
                </td>
                <td>
                    <input class="box-text-disable" value="" id="idTipo" type="text" disabled >
                </td>                          
            </tr>
            <tr>
                <td>
                    Nombres:
                </td>
                <td>
                    <input class="box-text" value="" id="nombreT" type="text" >
                </td>                          
            </tr>
            <tr>
                <td>
                    Descripción:
                </td>
                <td>
                    <textarea class="box-text" value="" id="descripcionT" rows="3" type="text" ></textarea>
                </td>                          
            </tr>
            <tr>
                <td>
                    Módulo:
                </td>
                <td>
                    <select class="box-text" id="moduloT">
                        <option value="PEDIDOS">PEDIDOS</option>
                        <option value="RESERVAS">RESERVAS</option>
                        <option value="SERVICIOS">SERVICIOS</option>
                    </select>
                </td>                          
            </tr>
           <tr><td align="right"><button type="submit" class="button red small" onclick="modificarPersona()">Modificar</button></td></tr>
        </table>
        </div>
    <div style=" margin-top: 5%; margin-left:5%;float:right; width: 40%" >
        <br>
        <h2>Subir Imagen</h2>
        <input type="file" name="categoria" id="categoria" />
        <button onclick="subir('categorias');">Subir</button>
    </div>
    </div>  