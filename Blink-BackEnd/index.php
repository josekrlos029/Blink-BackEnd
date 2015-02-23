<?php
session_start();
header("Access-Control-Allow-Origin: *");
define('DS', DIRECTORY_SEPARATOR);
define('HOME', dirname(__FILE__));

date_default_timezone_set("America/Bogota");
ini_set('display_erros', 1);
error_reporting(E_ALL);
/**
 * Esta funcion se utiliza para cambiar de INFORMACION DE ERRORES
 * a MANEJO DE EXCEPCIONES
 * @param type $code
 * @param type $mensaje
 * @param type $archivo
 * @param type $linea
 * @param type $contexto
 * @return boolean
 * @throws ErrorException
 */
function manejadorErrores($code, $mensaje, $archivo, $linea, $contexto = NULL){
    if(E_RECOVERABLE_ERROR === $code){
        throw new ErrorException($mensaje, $code,1, $archivo, $linea, NULL );
    }
    return false;
}
set_error_handler('manejadorErrores'); //Indica la funcion (callback) que manejara los errores
                                       //Esto es para cambiar de manejo de errores a manejo de 
                                       //Excepciones

function cargadorClases(){
    require_once './config/Configuracion.php';
    require_once './config/Db.php';
    require_once './modelo/Modelo.php';
    require_once './modelo/Domicilio.php';
    require_once './modelo/Servicio.php';
    require_once './modelo/Categoria.php';
    require_once './modelo/Central.php';
    require_once './modelo/Mensajero.php';
    require_once './modelo/ProductoRestaurante.php';
    require_once './modelo/Restaurante.php';
    require_once './modelo/TipoRestaurante.php';
    require_once './modelo/Usuario.php';
    require_once './modelo/Administrador.php';
    require_once './modelo/DetalleDomicilio.php';
    require_once './modelo/Inicio.php';
    require_once './controlador/Controlador.php';
    require_once './controlador/AdministradorControl.php';
    require_once './controlador/UsuarioControl.php';
    require_once './controlador/RestauranteControl.php';
    require_once './controlador/InicioControl.php';
    require_once './vista/Vista.php';
}

spl_autoload_register('cargadorClases');

require_once './utiles/inicio.php';
?>