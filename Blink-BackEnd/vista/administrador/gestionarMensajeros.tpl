<script type="text/javascript">
    
    function subir(carpeta){
        var id="mensajero";
        
        var complemento = $("#identificacions").val() + "-" + carpeta;
        
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
    
    
    function consultaPersona(idMensajero) {
        
        var x = $("#mensaje");
        cargando();
        x.html ("<p>Cargando...</p>");
        x.show("speed");
    
        var data = { idMensajero: idMensajero };

        $.ajax({
            type: "POST",
            url: "/administrador/consultarMensajero",
            data: data
        }).done(function(msg) {

            var json = eval("(" + msg + ")");
            $("#identificacions").val(json.identificacion);
            $("#nombre").val(json.nombre);
            $("#apellido").val(json.apellidos);
            $("#telefonos").val(json.telefono);
            $("#direccions").val(json.direccion);
            $("#correos").val(json.correo);
            $("#placas").val(json.placa);
            $("#marcas").val(json.marca);
            $("#colors").val(json.color);
            $("#ciudads").val(json.ciudad);
            
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
      
 
        var cedula = $("#identificacions").val();
        var nombres = $("#nombre").val();
        var apellidos = $("#apellido").val();
        var telefono = $("#telefonos").val();
        var direccion = $("#direccions").val();
        var correo = $("#correos").val();
        var placa = $("#placas").val();
        var marca = $("#marcas").val();
        var color = $("#colors").val();
        var ciudad = $("#ciudads").val();
        
        document.getElementById('light').style.display = 'none';
        document.getElementById('fade').style.display = 'none';
        var persona ={ cedula:cedula,
                    nombres: nombres,
                    apellidos: apellidos,
                    telefono: telefono,
                    direccion:direccion,
                    correo:correo,
                    placa:placa,
                    marca:marca,
                    color:color,
                    ciudad: ciudad
        };
        
        $.ajax({
                      type: "POST",
                      url: "/administrador/modificarMensajero",
                      data: persona
                  })
                  .done(function(msg) {
                      
                      var json = eval("(" + msg + ")");
              
                      if (json == "exito") {
                      
                         document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'
                         
                            
                            x.html ( "<p>Mensajero Modificado Correctamente</p>");
                            y.html();
                            exito();
                            ocultar();
                            $("#contenido").load("/administrador/gestionarMensajeros");
                      } else if(json == 23000) {

                            limpiarCajas();
                            x.html ( "<p>Error al Modificar Mensajero</p>");
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

        var identificacion = $("#identificacion").val();
        var nombres = $("#nombres").val();
        var apellidos = $("#apellidos").val();
        var telefono = $("#telefono").val();
        var direccion = $("#direccion").val();
        var correo = $("#correo").val();
        var placa = $("#placa").val();
        var marca = $("#marca").val();
        var color = $("#color").val();
        var ciudad = $("#ciudad").val();
        
        var persona ={ identificacion:identificacion,
                    nombres: nombres,
                    apellidos: apellidos,
                    telefono: telefono,
                    direccion:direccion,
                    correo:correo,
                    placa:placa,
                    marca:marca,
                    color:color,
                    ciudad:ciudad
        };

        $.ajax({
            type: "POST",
            url: "/administrador/registrarMensajero",
            data: persona
        })
                .done(function(msg) {

                    var json = eval("(" + msg + ")");

                    if (json == "exito") {

                        limpiarCajas();
                        x.html("<p>Mensajero Registrado Correctamente</p>");
                        y.html();
                        exito();
                        ocultar();
                        $("#contenido").load("/administrador/gestionarMensajeros");

                    } else if (json == 23000) {

                        limpiarCajas();
                        x.html("<p>Error al registrar Mensajero</p>");
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
        <table border="0" align="left" width="100%" >
            <tr><td style="text-align: left;"><h2>Registro de Mensajeros</h2></td></tr>
            <tr><td style="text-align: left;"><input type="number" id="identificacion" name="identificacion" required placeholder="Identificaci¨®n" class="box-text" onkeypress="javascript:return validarNro(event)" ></td></tr>
            <tr><td style="text-align: left;"><input type="text" name="nombres" id="nombres" required placeholder="Nombres"  class="box-text" onkeypress="javascript:return validar_texto(event)"></td></tr>
            <tr><td style="text-align: left;"><input type="text" name="apellidos" id="apellidos" required placeholder="Apellidos"  class="box-text" onkeypress="javascript:return validar_texto(event)" ></td>
            <tr><td style="text-align: left;"><input type="number" id="telefono" required placeholder="Telefono"  class="box-text" onkeypress="javascript:return validarNro(event)" ></td></tr>
            <tr><td style="text-align: left;"><input type="text" id="direccion" required placeholder="Direccion"  class="box-text" ></td></tr>
            <tr><td style="text-align: left;"><input type="email" id="correo" required placeholder="Correo"  class="box-text" ></td></tr>
            <tr><td style="text-align: left;"><input type="text" id="placa" required placeholder="Placa de Motocicleta"  class="box-text" ></td></tr>
            <tr><td style="text-align: left;"><input type="text" id="marca" required placeholder="Marca de Motocicleta"  class="box-text" ></td></tr>
            <tr><td style="text-align: left;"><input type="text" id="color" required placeholder="Color de Motocicleta"  class="box-text" ></td></tr>
                        <tr><td style="text-align: left;"><select id="ciudad" required class="box-text">
                                    <?php foreach($ciudades as $ciudad){ ?>
                                    <option value="<?php echo $ciudad['ciudad']; ?>"><?php echo $ciudad['ciudad']; ?></option>
                                    <?php } ?>
                    </select></td></tr>
            <tr><td style="text-align:right;"><button type="submit" class="button orange large"  >Guardar</button></td></tr>
        </table>
    </form>
</div>

<div id="cont-consulta">

    <table border="0" align="right" width="70%">
        <tr><td style="text-align: center;"><h2>Consulta de Mensajeros</h2></td>
            <td style="text-align: right;"><input type="text" name="idPersona" required placeholder="Buscar" class="box-text" id="filter"></td>
    </table>

    <div style="margin-top:10%;">
        <table border="0" align="center" width="100%" id="mitabla" >
            <thead>
            <th>Cedula</th>
            <th>Nombres</th>
            <th width="30%">Apellidos</th>
            <th width="30%">Ciudad</th>
            <th>Telefono</th>
            <th>Placa</th>
            <th>Marca</th>
            <th>Color</th>
            <th width="5%"></th>
            </thead>
            <tbody id="table">
                <?php foreach($mensajeros as $mensajero){ ?>
                <tr class="recorrer" align="left">
                    <td width="20%"><?php echo $mensajero->getCedula(); ?></td>
                    <td width="30%"><?php echo $mensajero->getNombres(); ?></td>
                    <td width="30%" ><?php echo $mensajero->getApellido(); ?></td>
                    <td width="30%" ><?php echo $mensajero->getCiudad(); ?></td>
                    <td width="10%"><?php echo $mensajero->getTelefono(); ?></td>
                    <td width="5%"><?php echo $mensajero->getPlaca(); ?></td>
                    <td width="5%"><?php echo $mensajero->getMarca(); ?></td>
                    <td width="5%"><?php echo $mensajero->getColor(); ?></td>
                    <td width="5%" style="text-align:right;"><buttom type="submit" class="button small red"  onclick="consultaPersona('<?php echo $mensajero->getIdMensajero(); ?>');">...</buttom></td> 
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
        <h2>Datos del Empleado</h2>
        </br>
        <table width="100%">
            <tr>
                <td>
                    Identificaci¨®n:
                </td>
                <td>
                    <input class="box-text-disable" value="" id="identificacions" type="text" disabled >
                </td>                          
            </tr>
            <tr>
                <td>
                    Nombres:
                </td>
                <td>
                    <input class="box-text" value="" id="nombre" type="text" >
                </td>                          
            </tr>
            <tr>
                <td>
                    Apellidos:
                </td>
                <td>
                    <input class="box-text" value="" id="apellido" type="text">
                </td>                          
            </tr>
            <tr>
                <td>
                    Telefono:
                </td>
                <td>
                    <input class="box-text" value="" id="telefonos" type="number">
                </td>                          
            </tr>
            <tr>
                <td>
                    Direccion:
                </td>
                <td>
                    <input class="box-text" value="" id="direccions" type="text" >
                </td>                          
            </tr>
            <tr>
                <td>
                    Correo:
                </td>
                <td>
                    <input class="box-text" value="" id="correos" type="text" >
                </td>                          
            </tr>
            <tr>
                <td>
                    Placa:
                </td>
                <td>
                    <input class="box-text" value="" id="placas" type="text">
                </td>                          
            </tr>
            <tr>
                <td>
                    Marca:
                </td>
                <td>
                    <input class="box-text" value="" id="marcas" type="text">
                </td>                          
            </tr>
            <tr>
                <td>
                    Color:
                </td>
                <td>
                    <input class="box-text" value="" id="colors" type="text">
                </td>                          
            </tr>
            <tr>
                <td>
                    Ciudad:
                </td>
                <td style="text-align: left;"><select id="ciudads" required class="box-text">
                                    <?php foreach($ciudades as $ciudad){ ?>
                                    <option value="<?php echo $ciudad['ciudad']; ?>"><?php echo $ciudad['ciudad']; ?></option>
                                    <?php } ?>
                                            </select>
                </td>
            </tr>
           <tr><td align="right"><button type="submit" class="button red small" onclick="modificarPersona()">Modificar</button></td></tr>
        </table>
        </div>
    <div style=" margin-top: 5%; margin-left:5%;float:right; width: 40%;" id="vistaServicios">
        <h2>Subir Foto</h2>
        <input type="file" name="mensajero" id="mensajero" />
        <button onclick="subir('mensajeros');">Subir</button>
    </div>
    </div> 