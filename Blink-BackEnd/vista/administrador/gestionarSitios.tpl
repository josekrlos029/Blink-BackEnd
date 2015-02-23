<script type="text/javascript">

 var mapa, mapa2;
 
    var lat= "10.4662643";
    var lng= "-73.2399389";
     
    mapa = new GMaps({
                  div: '#mapa',
                  lat: lat,
                  lng: lng,
                  zoom: 13,
                  zoomControl: true,
                  panControl: true,
                  streetViewControl: true,
                  mapTypeControl: true,
                  click: function(e) {
                    
                    var yourLocation = new google.maps.LatLng(e.latLng.k, e.latLng.D);
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ 'latLng': yourLocation }, processGeocoder);
                    $("#lat").val(e.latLng.k);
                    $("#lng").val(e.latLng.D);
                    
                  }
      });
      
      function processGeocoder(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var direccion =results[0].formatted_address;
                    var arrayDireccion = direccion.split(",");
                    $("#ciudad").val(arrayDireccion[1]);
                } else {
                    alert("Error al Obtener Dirección");
                }
            } else {
                alert("Error al Obtener Dirección");
            }
        }
      
      function processGeocoder2(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var direccion =results[0].formatted_address;
                    var arrayDireccion = direccion.split(",");
                    $("#ciudadR").val(arrayDireccion[1]);
                } else {
                    alert("Error al Obtener Dirección");
                }
            } else {
                alert("Error al Obtener Dirección");
            }
        }
      
      GMaps.geolocate({
            success: function(position) {
              mapa.setCenter(position.coords.latitude, position.coords.longitude);
            },
            error: function(error) {
              alert('Geolocation Fallida');
            },
            not_supported: function() {
              alert("Tu Navegador No Soporta Geolocalización");
            },
            always: function() {
              
            }
          });
      

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
    
    function mostrarMapa2(lat , lng){
        
        mapa2 = new GMaps({
                  div: '#mapa2',
                  lat: lat,
                  lng: lng,
                  zoom: 13,
                  zoomControl: true,
                  panControl: true,
                  streetViewControl: true,
                  mapTypeControl: true,
                  click: function(e) {
                    
                    var yourLocation = new google.maps.LatLng(e.latLng.k, e.latLng.B);
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ 'latLng': yourLocation }, processGeocoder2);
                    $("#latR").val(e.latLng.k);
                    $("#lngR").val(e.latLng.B);
                    
                  }
      });
        
    }
    
    function agregarTipo(){
        var idRestaurante = $("#idRestaurante").val();
        var tipo = $("#tipo").val();
        
        document.getElementById('light').style.display = 'none';
        document.getElementById('fade').style.display = 'none';
        
        var x = $("#mensaje");
        cargando();
        x.html ("<p>Cargando...</p>");
        x.show("speed");
        
        var data = {
                idRestaurante: idRestaurante,
                tipo: tipo
        };
        $.ajax({
            type: "POST",
            url: "/administrador/agregarTipo",
            data: data
        }).done(function(msg) {

            consultaPersona(idRestaurante);
            
        });
        
    }
    
    function eliminarTipo(idTipoSitio, idRestaurante){
        
        document.getElementById('light').style.display = 'none';
        document.getElementById('fade').style.display = 'none';
        
        var x = $("#mensaje");
        cargando();
        x.html ("<p>Cargando...</p>");
        x.show("speed");
        
        var data = {
                idTipoSitio: idTipoSitio
        };
        $.ajax({
            type: "POST",
            url: "/administrador/eliminarTipo",
            data: data
        }).done(function(msg) {

            consultaPersona(idRestaurante);
            
        });
        
    }
    
    function subir(carpeta){
        var id;
        
        if(carpeta == "fotos"){
             id = "logo";
        }else if(carpeta == "restaurantes"){
            id = "miniatura";
        }else if(carpeta == "marcadores"){
            id= "marcador";
        }
        
        var complemento = $("#idRestaurante").val() + "-" + carpeta;
        
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
    
    function consultaPersona(idRestaurante) {
        
        var x = $("#mensaje");
        cargando();
        x.html ("<p>Cargando...</p>");
        x.show("speed");
    
        var data = { idRestaurante: idRestaurante };

        $.ajax({
            type: "POST",
            url: "/administrador/consultarRestaurante",
            data: data
        }).done(function(msg) {

            var json = eval("(" + msg + ")");
            
            $("#idRestaurante").val(json.id);
            $("#nombreR").val(json.nombre);
            $("#ciudadR").val(json.ciudad);
            $("#latR").val(json.lat);
            $("#lngR").val(json.lng);
            $("#descripcionR").val(json.descripcion);
            $("#telefonoR").val(json.telefono);
            $("#direccionR").val(json.direccion);
            $("#correoR").val(json.email);
            $("#estado").val(json.activo);
            $("#tablaTipos").html(json.tabla);
            
             var listaModulos = (json.modulos);
             limpiarChecks();
    for (var i = 0; i < listaModulos .length; i++) {
        
             if(listaModulos[i].modulo == "PEDIDOS"){
                 document.getElementById("MpedidosM").checked = true;
             }
             if(listaModulos[i].modulo == "RESERVAS"){
                 document.getElementById("MreservasM").checked = true;
             }
             if(listaModulos[i].modulo == "SERVICIOS"){
                 document.getElementById("MserviciosM").checked = true;
             }
           }
             
            ocultar();
            document.getElementById('light').style.display = 'block';
            document.getElementById('fade').style.display = 'block';
            mostrarMapa2(json.lat, json.lng);
        });
    }  
    
    function limpiarChecks(){
        
        document.getElementById("MpedidosM").checked = false;

        document.getElementById("MreservasM").checked = false;

        document.getElementById("MserviciosM").checked = false;
        
    }
    
    function modificarPersona(){
   
        var x = $("#mensaje");
        var y = $("#overlay");
        cargando();
        x.html ("<p>Cargando...</p>");
        x.show("speed");
        y.show("speed");
        
       var modulosArray = new Array();
        var idRestaurante = $("#idRestaurante").val();
        var nombre = $("#nombreR").val();
        var descripcion = $("#descripcionR").val();
        var telefono = $("#telefonoR").val();
        var direccion = $("#direccionR").val();
        var correo = $("#correoR").val();
        var idTipo = "";
        var ciudad = $("#ciudadR").val();
        var lat = $("#latR").val();
        var lng = $("#lngR").val();
        var estado = $("#estado").val();
        
         if (document.getElementById('MpedidosM').checked){
             
            modulosArray.push("PEDIDOS");
        }
         if (document.getElementById('MreservasM').checked){
       
            modulosArray.push("RESERVAS");
        }
        if (document.getElementById('MserviciosM').checked){
            
            modulosArray.push("SERVICIOS");
        }
        
        
        document.getElementById('light').style.display = 'none';
        document.getElementById('fade').style.display = 'none';
        var persona = { idRestaurante:idRestaurante,
                    nombre: nombre,
                    descripcion:descripcion,
                    telefono:telefono,
                    direccion:direccion,
                    modulos:modulosArray,
                    correo:correo,
                    idTipo:idTipo,
                    ciudad: ciudad,
                    activo:estado,
                    lat:lat,
                    lng:lng
        };
        
        $.ajax({
                      type: "POST",
                      url: "/administrador/modificarRestaurante",
                      data: persona
                  })
                  .done(function(msg) {
                      
                      var json = eval("(" + msg + ")");
                       
                      if (json == "exito") {
                      
                         document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'
                           x.html ( "<p>Sitio Modificado Correctamente</p>");
                            y.html();
                            exito();
                            ocultar();
                            $("#contenido").load("/administrador/gestionarSitios");
                      } else if(json == 23000) {

                            limpiarCajas();
                            x.html ( "<p>Error al Modificar Sitio</p>");
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
        
         var modulosArray = new Array();
        var descripcion = $("#descripcion").val();
        var telefono = $("#telefono").val();
        var direccion = $("#direccion").val();
        var correo = $("#correo").val();
        var idTipo = "";
        var nombre = $("#nombre").val();
        var ciudad = $("#ciudad").val();
        var lat = $("#lat").val();
        var lng = $("#lng").val();
        var clave = $("#clave").val();
        var clave2 = $("#clave2").val();
        
        if (document.getElementById('Mpedidos').checked){
            modulosArray.push("PEDIDOS");
        }
         if (document.getElementById('Mreservas').checked){
            modulosArray.push("RESERVAS");
        }
        if (document.getElementById('Mservicios').checked){
            modulosArray.push("SERVICIOS");
        }
        
        
        if(clave == clave2){
            var persona ={ nombre:nombre,
                    descripcion:descripcion,
                    telefono:telefono,
                    correo:correo,
                    idTipo:idTipo,
                    ciudad:ciudad,
                    direccion:direccion,
                    modulos:modulosArray,
                    lat: lat,
                    lng: lng,
                    clave: clave
        };

        $.ajax({
            type: "POST",
            url: "/administrador/registrarRestaurante",
            data: persona
        })
                .done(function(msg) {

                    var json = eval("(" + msg + ")");
                    if (json == "exito") {

                        limpiarCajas();
                        x.html("<p>Sitio Registrado Correctamente</p>");
                        y.html();
                        exito();
                        ocultar();
                        $("#contenido").load("/administrador/gestionarSitios");

                    } else if (json == 23000) {

                        limpiarCajas();
                        x.html("<p>Error al registrar Sitio</p>");
                        y.html();
                        error();
                        ocultar();

                    }
                });
        }else{
            alert("Las Contraseñas no Coinciden, verifica los datos");
        }
        
    });
    
    function cambiarEstado(idSitio,estado){
    
         var sitio ={ idSitio:idSitio,
                    estado:estado       
        };
       
         $.ajax({
            type: "POST",
            url: "/administrador/cambiarEstadoSitio",
            data: sitio
        })
        
        .done(function(msg) {
                    var json = eval("(" + msg + ")");
         
                    if (json == "exito"){
                        alert("Estado del sitio Cambiado");
                       
                        $("#contenido").load("/administrador/gestionarSitios");

                    } else if (json == 23000) {
                        alert("Error al cambiar estado del sitio");
                      
                        ocultar();

                    }
                });
    }
    
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
            <tr><td style="text-align: left;"><h2>Registro de Sitios</h2></td></tr>
            <tr><td style="text-align: left;"><input type="text" name="nombre" id="nombre" required placeholder="Nombre"  class="box-text"></td></tr>
            <tr><td style="text-align: left;"><textarea id="descripcion" placeholder="Descripción..." class="box-text" cols="30" rows="3"></textarea></td></tr>
            <tr><td style="text-align: left;"><input type="telefono" name="telefono" id="telefono" required placeholder="Telefono"  class="box-text" onkeypress="javascript:return validarNro(event)"></td></tr>
            <tr><td style="text-align: left;"><input type="text" name="direccion" id="direccion" placeholder="Dirección..."  class="box-text"></td></tr>
            <tr><td style="text-align: left;"><input type="email" name="correo" id="correo" required placeholder="Correo Electronico"  class="box-text"></td></tr>
            <tr><td style="text-align: left;"><input type="password" name="nombre" id="clave" required placeholder="Contraseña"  class="box-text"></td></tr>
            <tr><td style="text-align: left;"><input type="password" name="nombre" id="clave2" required placeholder="Repetir Contraseña"  class="box-text"></td></tr>
        </table>
        <br>
         <h3>Moldulos de Sitio</h3>
        <br>
        <table>
            <tr>
                <td><input type="checkbox" name="Mpedidos" id="Mpedidos" value="Pedidos"></td>
                <td>Pedidos</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="Mreservas" id="Mreservas" value="Reservas"></td>
                <td>Reservas</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="Mservicios" id="Mservicios" value="Servicios"></td>
                <td>Servicios</td>
            </tr>
        </table>
        <br>
        <h3 style="margin-top: 10px">Ubicación</h3>
        <div id="mapa" style="width: 100%; height: 300px;"></div>
        <table border="0" align="left" width="100%" >   
            <tr><td style="text-align: left;"><input type="text" name="ciudad" id="ciudad" required disabled placeholder="Ciudad"  class="box-text-disable"></td>
            <tr><td style="text-align: left;"><input type="text" id="lat" required disabled placeholder="Latitud"  class="box-text-disable" ></td></tr>
            <tr><td style="text-align: left;"><input type="text" id="lng" required disabled placeholder="Longitud"  class="box-text-disable" ></td></tr>
            <tr><td style="text-align:right;"><button type="submit" class="button orange large"  >Guardar</button></td></tr>
        </table>
    </form>
    
    
</div>

<div id="cont-consulta">

    <table border="0" align="right" width="70%">
        <tr><td style="text-align: center;"><h2>Consulta de Sitios</h2></td>
            <td style="text-align: right;"><input type="text" name="idPersona" required placeholder="Buscar" class="box-text" id="filter"></td>
    </table>

    <div style="margin-top:10%; overflow: scroll; height: 500px">
        <table border="0" align="center" width="100%" id="mitabla" >
            <thead>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th width="30%">Ciudad</th>
            <th width="5%">...</th>
            <th width="5%">I/0</th>
            </thead>
            <tbody id="table">
                <?php 
                
                foreach($restaurantes as $restaurante){ 
                    
                ?>
                <tr class="recorrer" align="left">
                    <td><?php echo $restaurante->getNombre(); ?></td>
                    <td><?php echo $restaurante->getDireccion(); ?></td>
                    <td><?php echo $restaurante->getTelefono(); ?></td>
                    <td><?php echo $restaurante->getEmail(); ?></td>
                    <td><?php echo $restaurante->getCiudad(); ?></td>
                    <td width="5%" style="text-align:right;"><buttom type="submit" class="button small red"  onclick="consultaPersona('<?php echo $restaurante->getIdRestaurante(); ?>');">...</buttom></td> 
                    <?php if($restaurante->getActivo()== 1 ){ ?>
                     
                    <td width="5%" style="text-align:right;"><buttom type="submit" class="button small green"  onclick="cambiarEstado('<?php echo $restaurante->getIdRestaurante(); ?>',0);">A</buttom></td>
   
                    <?php
                    }else{ ?>
                        <td width="5%" style="text-align:right;"><buttom type="submit" class="button small red"  onclick="cambiarEstado('<?php echo $restaurante->getIdRestaurante(); ?>',1);">I</buttom></td>
                    <?php }
                    ?>
                  
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
                    Codigo del Sitio:
                </td>
                <td>
                    <input class="box-text-disable" value="" id="idRestaurante" type="text" disabled >
                </td>                          
            </tr>
            <tr>
                <td>
                    Nombres:
                </td>
                <td>
                    <input class="box-text" value="" id="nombreR" type="text" >
                </td>                          
            </tr>
            <tr>
                <td>
                    Descripción:
                </td>
                <td>
                    <textarea class="box-text" value="" id="descripcionR" rows="3" type="text" ></textarea>
                </td>                          
            </tr>
            <tr>
                <td>
                    Teléfono:
                </td>
                <td>
                    <input class="box-text" value="" id="telefonoR" type="text" onkeypress="validarNro(this)">
                </td>                          
            </tr>
            <tr>
                <td>
                    Dirección:
                </td>
                <td>
                    <input class="box-text" value="" id="direccionR" type="text" >
                </td>                          
            </tr>
            <tr>
                <td>
                    Correo:
                </td>
                <td>
                    <input class="box-text" value="" id="correoR" type="email" >
                </td>                          
            </tr>
            <tr>
                <td>
                    Ciudad:
                </td>
                <td>
                    <input class="box-text-disable" disabled value="" id="ciudadR" type="text">
                </td>                          
            </tr>
            <tr>
                <td>
                    Latitud:
                </td>
                <td>
                    <input class="box-text-disable" disabled value="" id="latR" type="number">
                </td>                          
            </tr>
            <tr>
                <td>
                    Longitud:
                </td>
                <td>
                    <input class="box-text-disable" disabled value="" id="lngR" type="text" >
                    <input  value="" id="estado" type="hidden" >
                </td>                          
            </tr>
           
        </table>
    </br>
          <h3>Moldulos de Sitio</h3>
          </br>
        <table>
            <tr>
                <td><input type="checkbox" name="MpedidosM" id="MpedidosM" value="Pedidos"></td>
                <td>Pedidos</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="MreservasM" id="MreservasM" value="Reservas"></td>
                <td>Reservas</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="MserviciosM" id="MserviciosM" value="Servicios"></td>
                <td>Servicios</td>
            </tr>
        </table>
        </div>
  
    <div style=" margin-top: 5%; margin-left:5%;float:right; width: 40%" >
        <div style="width: 100%; height: 250px" id="mapa2"></div>
        
        <br>
        <h2>Subir Logo</h2>
        <input type="file" name="logo" id="logo" />
        <button onclick="subir('fotos');">Subir</button>
        <h2>Subir Miniatura</h2>
        <input type="file" name="miniatura" id="miniatura" />
        <button onclick="subir('restaurantes');">Subir</button>
        <h2>Subir Marcador</h2>
        <input type="file" name="marcador" id="marcador" />
        <button onclick="subir('marcadores');">Subir</button>
        <br>
        <h2>Agregar a Categorias</h2>
        <select id="tipo" class="box-text">
            <?php foreach($tipos as $tipo){ ?>
            <option value="<?php echo $tipo->getIdTipoRestaurante(); ?>"><?php echo $tipo->getNombre()."[".$tipo->getSeccion()."]"; ?></option>
            <?php } ?>
        </select>
        <button onclick="agregarTipo();">Agregar</button>
        <br>
        <div id="tablaTipos"></div>
    </div>
    </br>
   
    <div style="margin-top:10px">
    <table  width="30%" align="center">
        <tr><td align="right"><button type="submit" class="button red large" onclick="modificarPersona()">Modificar</button></td></tr>
    </table>
    </div>
    </div> 