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
               
               if (respuesta === "1") {
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
    
    
     function consultaPersona(idPersona) {
        var x = $("#mensaje");
        cargando();
        x.html ("<p>Cargando...</p>");
        x.show("speed");
      
        var data = { idPersona: idPersona };

        $.ajax({
            type: "POST",
            url: "/famacia/administrador/consultarPersona",
            data: data
        }).done(function(msg) {

            var json = eval("(" + msg + ")");
            $("#identificacions").val(json.identificacion);
            $("#tipoIdentificacions").val(json.tipoIdentificacion);
            $("#nombre").val(json.nombre);
            $("#pApellidos").val(json.primerApellido);
            $("#sApellidos").val(json.segundoApellido);
            $("#sexos").val(json.sexo);
            $("#fNacimientos").val(json.fechaNacimiento);
            $("#telefonos").val(json.telefono);
            $("#direccions").val(json.direccion);
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
      
 
        var idPersona = $("#idPersonas").val();
        var nombres = $("#nombre").val();
        var pApellido = $("#pApellidos").val();
        var sApellido = $("#sApellidos").val();
        var sexo = $("#sexos").val();
        var fecha = $("#fNacimientos").val();
        var telefono = $("#telefonos").val();
        var celular = $("#celulars").val();
        var direccion = $("#direccions").val();
        var correo = $("#correos").val();
        
        var persona ={ idPersona:idPersona,
                    nombres: nombres,
                    pApellido: pApellido,
                    sApellido: sApellido,
                    sexo: sexo,
                    fNacimiento: fecha,
                    telefono: telefono,
                    celular:celular,
                    direccion:direccion,
                    correo:correo
                    
        };
        
        $.ajax({
                      type: "POST",
                      url: "/famacia/administrador/modificarPersona",
                      data: persona
                  })
                  .done(function(msg) {
                      
                      var json = eval("(" + msg + ")");
              
                      if (json == "exito") {
                      
                         document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'
                         
                            
                            x.html ( "<p>Empleado Modificado Correctamente</p>");
                            y.html();
                            exito();
                            ocultar();
                      } else if(json == 23000) {

                            limpiarCajas();
                            x.html ( "<p>Error al Modificar Empleado</p>");
                            y.html();
                            error();
                            ocultar();

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
        var tipoIdentificacion = $("#tipoIdentificacion").val();
        var nombres = $("#nombres").val();
        var pApellido = $("#pApellido").val();
        var sApellido = $("#sApellido").val();
        var sexo = $("#sexo").val();
        var fecha = $("#fNacimiento").val();
        var telefono = $("#telefono").val();
        var direccion = $("#direccion").val();
        
        var persona ={ identificacion:identificacion,
                    tipoIdentificacion: tipoIdentificacion,
                    nombres: nombres,
                    pApellido: pApellido,
                    sApellido: sApellido,
                    sexo: sexo,
                    fNacimiento: fecha,
                    telefono: telefono,
                    direccion:direccion,
                    rol: "F"
        };

        $.ajax({
            type: "POST",
            url: "/famacia/administrador/registrarPersona",
            data: persona
        })
                .done(function(msg) {

                    var json = eval("(" + msg + ")");

                    if (json == "exito") {

                        limpiarCajas();
                        x.html("<p>Empleado Registrado Correctamente</p>");
                        y.html();
                        exito();
                        ocultar();


                    } else if (json == 23000) {

                        limpiarCajas();
                        x.html("<p>Error al registrar Empleado</p>");
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
            <tr><td style="text-align: left;"><h2>Registro de Empleados</h2></td></tr>
            <tr><td style="text-align: left;"><input type="number" id="identificacion" name="identificacion" required placeholder="Identificación" class="box-text" onkeypress="javascript:return validarNro(event)" ></td></tr>    
                    <tr><td style="text-align: left;">Tipo de Identificación:<select style="width:100%;" class="box-text" id="tipoIdentificacion">
                                                        <option value="CC">Cédula</option>
                                                        <option value="TI">Tarjeta de Identidad</option>
                                                        <option value="PP">Pasaporte</option>
                                                      </select>
                        </td></tr> 
            <tr><td style="text-align: left;"><input type="text" name="nombres" id="nombres" required placeholder="Nombres"  class="box-text" onkeypress="javascript:return validar_texto(event)"></td></tr> 
            <tr><td style="text-align: left;"><input type="text" name="pApellido" id="pApellido" required placeholder="Primer Apellido"  class="box-text" onkeypress="javascript:return validar_texto(event)" ></td>      
            <tr><td style="text-align: left;"><input type="text" name="sApellido" id="sApellido"  placeholder="Segundo Apellido"  class="box-text" onkeypress="javascript:return validar_texto(event)" ></td></tr>
           <tr><td style="text-align: left;"><select style="width:100%;" class="box-text" id="sexo"><option default>Sexo</option><option>M</option><option>F</option></select></td></tr>
      </table>
        <br><br>
           <table border="0" align="left" width="100%" >
                    <tr><td style="text-align: left; color:#c3c3c3; font-size:12px;">Fecha de Nacimiento:</td></tr>
            <tr><td style="text-align: left;"><input type="date" id="fNacimiento" required placeholder="Fecha de Nacimiento"  class="box-text" ></td></tr>
            <tr><td style="text-align: left;"><input type="number" id="telefono" required placeholder="Telefono"  class="box-text" onkeypress="javascript:return validarNro(event)" ></td></tr>
            <tr><td style="text-align: left;"><input type="text" id="direccion" required placeholder="Direccion"  class="box-text" ></td></tr>
            <tr><td style="text-align:right;"><button type="submit" class="button orange large"  >Guardar</button></td></tr>
        </table>
    </form>
</div>

<div id="cont-consulta">

    <table border="0" align="right" width="70%">
        <tr><td style="text-align: center;"><h2>Consulta de Empleados</h2></td>
            <td style="text-align: right;"><input type="text" name="idPersona" required placeholder="Buscar" class="box-text" id="filter"></td>
    </table>

    <div style="margin-top:10%;">
        <table border="0" align="center" width="100%" id="mitabla" >
            <thead>
            <th>Cedula</th>
            <th>Nombres</th>
            <th width="30%">Apellidos</th>
            <th width="5%">Sexo</th>
            <th>Telefono</th>
            <th width="5%"></th>
            </thead>
            <tbody id="table">
                <?php foreach($personas as $persona){ ?>
                <tr class="recorrer" align="left">
                    <td width="20%"><?php echo $persona->getIdentificacion(); ?></td>
                    <td width="30%"><?php echo $persona->getNombres(); ?></td>
                    <td width="30%" ><?php echo $persona->getpApellido()." ".$persona->getsApellido(); ?></td>
                    <td width="5%"><?php echo $persona->getSexo(); ?></td>
                    <td width="10%"><?php echo $persona->getTelefono(); ?></td>
                    <td width="5%" style="text-align:right;"><buttom type="submit" class="button small red"  onclick="consultaPersona('<?php echo $persona->getIdPersona(); ?>');">...</buttom></td> 
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
                    Identificación:
                </td>
                <td>
                    <input class="box-text-disable" value="" id="identificacions" type="text" disabled >
                </td>                          
            </tr>
            <tr>
                <td>
                    Tipo Identificación:
                </td>
                <td>
                    <select id="tipoIdentificacions"><option value="CC">Cédula</option>
                                                        <option value="TI">Tarjeta de Identidad</option>
                                                        <option value="PP">Pasaporte</option></select>
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
                    Primer Apellido:
                </td>
                <td>
                    <input class="box-text" value="" id="pApellidos" type="text">
                </td>                          
            </tr>
            <tr>
                <td>
                    Segundo Apellido:
                </td>
                <td>
                    <input class="box-text" value="" id="sApellidos" type="text" >
                </td>                          
            </tr>
            <tr>
                <td>
                    sexo:
                </td>
                <td>
                    <input class="box-text-disable" value="" id="sexos" type="text" disabled >
                </td>                          
            </tr>
            <tr>
                <td>
                    fecha de Nacimiento:
                </td>
                <td>
                    <input class="box-text" value="" id="fNacimientos" type="date" >
                </td>                          
            </tr>
            <tr>
                <td>
                    telefono:
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
           <tr><td align="right"><button type="submit" class="button red small" onclick="modificarPersona()">Modificar</button></td></tr>
        </table>
        </div>
    <div style=" margin-top: 5%; margin-left:5%;float:right; width: 40%;">
        <h2>Subir Foto</h2>
        <input type="file" name="mensajero" id="mensajero" />
        <button onclick="subir('mensajeros');">Subir</button>
    </div>
    </div>  
          
