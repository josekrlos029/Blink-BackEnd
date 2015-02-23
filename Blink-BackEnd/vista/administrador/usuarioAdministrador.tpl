<?php
/* 
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../utiles/css/style-index.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="../utiles/css/menu.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="../utiles/css/formularios.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="../utiles/css/botones.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="../utiles/css/tablas.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="../utiles/css/fullcalendar.css" rel="stylesheet" type="text/css" media="screen"/>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBOANqhrn5i6-jYE9XqXyaVClI0NvGLOQw&sensor=true&libraries=geometry"></script>
        <script src="../utiles/js/jquery-1.11.0.min.js" type="text/javascript"></script>
        <script src="../utiles/js/js.js" type="text/javascript"></script>
        <script src="../utiles/js/gmaps.js" type="text/javascript"></script>
        <script type='text/javascript' src='../utiles/js/jquery-ui.custom.min.js'></script>
        <script src="../utiles/js/fullcalendar.min.js"></script>
        <script src="../utiles/js/upload.js"></script>

        <title>Administrador</title>

        <script>
            $(document).ready(function(){
                $("#contenido").load("/administrador/gestionarSitios");
                $("#titulo").html("<h1>Gestión de Sitios</h1>");
            });
            
            function cargarUsuarios() {
                $("#titulo").html("<h1>Gestión de Usuarios</h1>");
                $("#contenido").load("/administrador/consultarUsuarios");

            }
            function cargarGestionCentrales() {
                $("#contenido").load("/administrador/gestionarCentrales");
                $("#titulo").html("<h1>Gestión de Centrales</h1>");
            }
            function cargarGestionCategorias() {
                $("#contenido").load("/administrador/gestionarCategorias");
                $("#titulo").html("<h1>Gestión de Categorías</h1>");
            }
            function cargarGestionSitios() {
                $("#contenido").load("/administrador/gestionarSitios");
                $("#titulo").html("<h1>Gestión de Sitios</h1>");
            }
            function cargarGestionMensajeros() {
                $("#contenido").load("/administrador/gestionarMensajeros");
                $("#titulo").html("<h1>Gestion de Mensajeros</h1>");
            }
            
            function cargarConsultas() {
                $("#contenido").load("/famacia/administrador/consultas");
                $("#titulo").html("<h1>Consultas</h1>");
            }
            
        </script>

    </head> 

    <body>
        <div id="menu">
            <div id="cont-title">
                <a  href="/administrador/usuarioAdministrador" ><h1><spam>Usuario</spam> | Administrador</h1></a>
                <div id="hora">
                    <?php

                    echo date("r");
                    ?>    
                </div>
            </div>
            <div style="margin-top:20px;"> 
                <ul class="accordion">
                    <li id="one" class="clientes"><a onclick="cargarUsuarios()" href="#">Usuarios<span><?php //echo count($personas); ?></span></a></li>
                    <li id="six" class="empleados"><a onclick="cargarGestionCentrales()" href="#">Centrales<span><?php //echo count($empleados); ?></span></a></li>
                    <li id="six" class="empleados"><a onclick="cargarGestionCategorias()" href="#">Categorias<span><?php //echo count($empleados); ?></span></a></li>
                    <li id="six" class="empleados"><a onclick="cargarGestionSitios()" href="#">Sitios<span><?php //echo count($empleados); ?></span></a></li>
                    <li id="two" class="productos"><a onclick="cargarGestionMensajeros()" href="#">Mensajeros<span><?php //echo count($productos); ?></span></a></li>
                    <li id="seven" class="consulta"><a onclick="cargarConsultas()" href="#">Consultas</a></li>
                    
                </ul>
            </div> 

        </div>
    </div>
    <div id="cuerpo">
        <div id="menu-horizontal">
            <div id="titulo"></div>
            <div id=cont-conf></div>
            <div id="cont-logo">
                <h1>Administrador BlinkManager</h1>
            </div>
        </div>

        <div id="contenido">

        </div>

    </div> 
    
</body>
</html>
