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
                    $("#ciudadC").val(arrayDireccion[1]);
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
                    $("#latC").val(e.latLng.k);
                    $("#lngC").val(e.latLng.B);
                    
                  }
      });
        
    }
    
    function consultaPersona(idCentral) {
        
        var x = $("#mensaje");
        cargando();
        x.html ("<p>Cargando...</p>");
        x.show("speed");
    
        var data = { idCentral: idCentral };

        $.ajax({
            type: "POST",
            url: "/administrador/consultarCentral",
            data: data
        }).done(function(msg) {

            var json = eval("(" + msg + ")");
            $("#idCentral").val(json.idCentral);
            $("#nombreC").val(json.nombre);
            $("#ciudadC").val(json.ciudad);
            $("#latC").val(json.lat);
            $("#lngC").val(json.lng);
            
            ocultar();
            document.getElementById('light').style.display = 'block';
            document.getElementById('fade').style.display = 'block';
            mostrarMapa2(json.lat, json.lng);
        });
    }  
    
    function modificarPersona(){
   
        var x = $("#mensaje");
        var y = $("#overlay");
        cargando();
        x.html ("<p>Cargando...</p>");
        x.show("speed");
        y.show("speed");
      
 
        var idCentral = $("#idCentral").val();
        var nombre = $("#nombreC").val();
        var ciudad = $("#ciudadC").val();
        var lat = $("#latC").val();
        var lng = $("#lngC").val();
        
        document.getElementById('light').style.display = 'none';
        document.getElementById('fade').style.display = 'none';
        var persona ={ idCentral:idCentral,
                    nombre: nombre,
                    ciudad: ciudad,
                    lat:lat,
                    lng:lng
        };
        
        $.ajax({
                      type: "POST",
                      url: "/administrador/modificarCentral",
                      data: persona
                  })
                  .done(function(msg) {
                      
                      var json = eval("(" + msg + ")");
              
                      if (json == "exito") {
                      
                         document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'
                         
                            
                            x.html ( "<p>Central Modificada Correctamente</p>");
                            y.html();
                            exito();
                            ocultar();
                            $("#contenido").load("/administrador/gestionarCentrales");
                      } else if(json == 23000) {

                            limpiarCajas();
                            x.html ( "<p>Error al Modificar Central</p>");
                            y.html();
                            error();
                            ocultar();
                            document.getElementById('light').style.display = 'block';
                            document.getElementById('fade').style.display = 'block';
                      }
                  });
    }
    
    function cambiarEstado(idCentral,estado){
    
         var sitio ={ idCentral:idCentral,
                    estado:estado       
        };
       
         $.ajax({
            type: "POST",
            url: "/restaurante/cambiarEstadoCentrales",
            data: sitio
        })
        
        .done(function(msg) {

                    var json = eval("(" + msg + ")");
         
                    if (json.msj == "exito"){
                        alert("Estado del sitio Cambiado");
                       
                        $("#contenido").load("/administrador/gestionarCentrales");

                    } else if (json.msj == "error") {
                        alert("Error al cambiar estado del sitio");
                      
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

        var nombre = $("#nombre").val();
        var ciudad = $("#ciudad").val();
        var lat = $("#lat").val();
        var lng = $("#lng").val();
        var clave = $("#clave").val();
        var clave2 = $("#clave2").val();
        var usuario = $("#usuario").val();
        
        if(clave == clave2){
            var persona ={ nombre:nombre,
                    ciudad: ciudad,
                    lat: lat,
                    lng: lng,
                    usuario: usuario,
                    clave: clave
        };

        $.ajax({
            type: "POST",
            url: "/administrador/registrarCentral",
            data: persona
        })
                .done(function(msg) {

                    var json = eval("(" + msg + ")");

                    if (json == "exito") {

                        limpiarCajas();
                        x.html("<p>Central Registrada Correctamente</p>");
                        y.html();
                        exito();
                        ocultar();
                        $("#contenido").load("/administrador/gestionarCentrales");

                    } else if (json == 23000) {

                        limpiarCajas();
                        x.html("<p>Error al registrar Central</p>");
                        y.html();
                        error();
                        ocultar();

                    }
                });
        }else{
            alert("Las Contraseñas no Coinciden, verifica los datos");
        }
        
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
            <tr><td style="text-align: left;"><h2>Registro de Central</h2></td></tr>
            <tr><td style="text-align: left;"><input type="text" name="nombre" id="nombre" required placeholder="Nombre"  class="box-text"></td></tr>
            <tr><td style="text-align: left;"><input type="text" name="nombre" id="usuario" required placeholder="Usuario"  class="box-text"></td></tr>
            <tr><td style="text-align: left;"><input type="password" name="nombre" id="clave" required placeholder="Contraseña"  class="box-text"></td></tr>
            <tr><td style="text-align: left;"><input type="password" name="nombre" id="clave2" required placeholder="Repetir Contraseña"  class="box-text"></td></tr>
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
        <tr><td style="text-align: center;"><h2>Consulta de Centrales</h2></td>
            <td style="text-align: right;"><input type="text" name="idPersona" required placeholder="Buscar" class="box-text" id="filter"></td>
    </table>

    <div style="margin-top:10%;">
        <table border="0" align="center" width="100%" id="mitabla" >
            <thead>
            <th>Nombre</th>
            <th width="30%">Ciudad</th>
            <th width="5%">...</th>
            <th width="5%">I/0</th>
            
            </thead>
            <tbody id="table">
                <?php foreach($centrales as $central){ ?>
                <tr class="recorrer" align="left">
                    <td width="20%"><?php echo $central->getNombre(); ?></td>
                    <td width="30%"><?php echo $central->getCiudad(); ?></td>
                    <td width="5%" style="text-align:right;"><buttom type="submit" class="button small red"  onclick="consultaPersona('<?php echo $central->getIdCentral(); ?>');">...</buttom></td> 
                    <?php if($central->getEstado()== '1' || $central->getEstado()== '0' ){ ?>
                     
                    <td width="5%" style="text-align:right;"><buttom type="submit" class="button small green"  onclick="cambiarEstado('<?php echo $central->getIdCentral(); ?>',2);">A</buttom></td>
   
                    <?php
                    }else{ ?>
                        <td width="5%" style="text-align:right;"><buttom type="submit" class="button small red"  onclick="cambiarEstado('<?php echo $central->getIdCentral(); ?>',0);">I</buttom></td>
                    <?php } ?>
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
                    Codigo Central:
                </td>
                <td>
                    <input class="box-text-disable" value="" id="idCentral" type="text" disabled >
                </td>                          
            </tr>
            <tr>
                <td>
                    Nombres:
                </td>
                <td>
                    <input class="box-text" value="" id="nombreC" type="text" >
                </td>                          
            </tr>
            <tr>
                <td>
                    Ciudad:
                </td>
                <td>
                    <input class="box-text-disable" disabled value="" id="ciudadC" type="text">
                </td>                          
            </tr>
            <tr>
                <td>
                    Latitud:
                </td>
                <td>
                    <input class="box-text-disable" disabled value="" id="latC" type="number">
                </td>                          
            </tr>
            <tr>
                <td>
                    Longitud:
                </td>
                <td>
                    <input class="box-text-disable" disabled value="" id="lngC" type="text" >
                </td>                          
            </tr>
           <tr><td align="right"><button type="submit" class="button red small" onclick="modificarPersona()">Modificar</button></td></tr>
        </table>
        </div>
    <div style=" margin-top: 5%; margin-left:5%;float:right; width: 40%" >
        <div style="width: 100%; height: 400px" id="mapa2"></div>
    </div>
    </div>  