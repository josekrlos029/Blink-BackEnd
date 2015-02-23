<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RestauranteControl
 *
 * @author JoseCarlos
 */
class RestauranteControl extends Controlador {

    //put your code here
    public function __construct($modelo, $accion) {
        parent::__construct($modelo, $accion);
    }

    public function consultarRestaurantesCercanos() {
        $lat = isset($_POST['lat']) ? $_POST['lat'] : NULL;
        $lng = isset($_POST['lng']) ? $_POST['lng'] : NULL;
        $km = isset($_POST['km']) ? $_POST['km'] : NULL;

        $restaurante = new Restaurante();
        $restaurantes = $restaurante->leerRestaurantesCercanos($lat, $lng, $km);

        $res = array();
        foreach ($restaurantes as $r) {

            $res[] = array("id" => $r->getIdRestaurante(), "idTipo" => $r->getIdTipoRestaurante(), "nombre" => $r->getNombre(), "descripcion" => $r->getDescripcion(), "puntaje" => $r->getPuntaje(), "lat" => $r->getLat(), "lng" => $r->getLng(), "estado" => $r->getEstado());
        }

        echo json_encode($res);
    }


public function consultarRestaurantes() {
        
        $restaurante = new Restaurante();
        $restaurantes = $restaurante->leerRestaurantes();

        $res = array();
        foreach ($restaurantes as $r) {

            $res[] = array("id" => $r->getIdRestaurante(), "idTipo" => $r->getIdTipoRestaurante(), "nombre" => $r->getNombre(), "descripcion" => $r->getDescripcion(), "direccion" => $r->getDireccion(), "email" => $r->getEmail(), "puntaje" => $r->getPuntaje(), "lat" => $r->getLat(), "lng" => $r->getLng(), "estado" => $r->getEstado());
        }

        echo json_encode($res);
    }

    public function consultarRestaurantesPorTipo() {
        $idTipo = isset($_POST['idTipo']) ? $_POST['idTipo'] : NULL;
        $seccion = isset($_POST['seccion']) ? $_POST['seccion'] : NULL;
        $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL;
        $ciudad=trim($ciudad);
        $restaurante = new Restaurante();
        
        $restaurantes = $restaurante->leerRestaurantesPorIdTipoYCiudad($idTipo, $ciudad,$seccion);
        

        $res = array();
        shuffle($restaurantes);
        foreach ($restaurantes as $r) {

            $res[] = array("id" => $r->getIdRestaurante(), "idTipo" => $r->getIdTipoRestaurante(), "nombre" => $r->getNombre(), "descripcion" => $r->getDescripcion(), "direccion" => $r->getDireccion(), "telefono" => $r->getTelefono(), "puntaje" => $r->getPuntaje(), "lat" => $r->getLat(), "lng" => $r->getLng(), "estado" => $r->getEstado(),"email" => $r->getEmail());
        }


        echo json_encode($res);
    }

    public function consultarRestaurantesPorTipo2() {
        $idTipo = "restaurantes";

        $restaurante = new Restaurante();
        if ($idTipo == "restaurantes") {
            $restaurantes = $restaurante->leerRestaurantes();
        } else {
            $restaurantes = $restaurante->leerRestaurantesPorIdTipo($idTipo);
        }

        $res = array();
        shuffle($restaurantes);
        foreach ($restaurantes as $r) {

            $res[] = array("id" => $r->getIdRestaurante(), "idTipo" => $r->getIdTipoRestaurante(), "nombre" => $r->getNombre(), "descripcion" => $r->getDescripcion(), "direccion" => $r->getDireccion(), "email" => $r->getEmail(), "puntaje" => $r->getPuntaje(), "lat" => $r->getLat(), "lng" => $r->getLng(), "estado" => $r->getEstado());
        }


        echo json_encode($res);
    }
    
    public function consultarRestaurante() {
        $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
        $restaurante = new Restaurante();
        $r = $restaurante->leerPorId($idRestaurante);
        echo json_encode(array("id" => $r->getIdRestaurante(), "idTipo" => $r->getIdTipoRestaurante(), "nombre" => $r->getNombre(), "descripcion" => $r->getDescripcion(), "puntaje" => $r->getPuntaje(), "lat" => $r->getLat(), "lng" => $r->getLng(), "telefono" => $r->getTelefono(), "direccion" => $r->getDireccion(), "estado" => $r->getEstado()));
    }

    public function consultarMenuRestaurante() {

        try {
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            //$idRestaurante = "6";
            $categoria = new Categoria();
            $categorias = $categoria->leerCategoriasPorRestaurante($idRestaurante);
            $res2 = array();
            foreach($categorias as $categoria){
              $producto = new ProductoRestaurante();
              $productos = $producto->leerProductoPorCategoria($categoria->getIdCategoria());
              $res = array();
              foreach($productos as $p){
                 $nombre = $p->getNombre();
                 $idProducto = $p->getIdProducto();
                 $descripcion = $p->getDescripcion();
                 $estado = $p->getEstado();
                 $precio  = $p->getPrecio();
                 $res [] = array("nombre"=>$nombre, "idProducto"=>$idProducto, "descripcion"=>$descripcion, "estado"=>$estado, "precio"=>$precio);
              }
              $res2[]= array($categoria->getNombre()=>$res);
            }
            echo json_encode($res2);
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }

    public function menu() {

        try {
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $categoria = new Categoria();
            $categorias = $categoria->leerCategoriasPorRestaurante($idRestaurante);
            $this->vista->set('categorias', $categorias);
            return $this->vista->imprimir();
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }
    
    public function reserva() {

        try {
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $restaurante = new Restaurante();

            $categorias = $restaurante->consultarCategoriaDeReserva($idRestaurante);
            $this->vista->set('categorias', $categorias);
            return $this->vista->imprimir();
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }

    public function enviarNotificacion($array, $msg, $msgcnt) {

        $apiKey = 'AIzaSyDPo5D9SzKfVzIImE3dIVRFfL28zcMPjyc'; //Clave de la api
// Cabecera
        $headers = array('Content-Type:application/json',
            "Authorization:key=$apiKey");

// Datos
        $payload = array('title' => 'TusDomicilio',
            'message' => utf8_encode($msg),
            'msgcnt' => $msgcnt);

//Aqui se escriben los regid de los dispositivos para enviarle los mensajes
        /* $usuario = new Usuario();
          $usuarios = $usuario->leerUsuarios();
          $registrationIdsArray = array();
          foreach ($usuarios as $u) {
          $registrationIdsArray[] = $u->getRegid();
          }
         */

        $data = array(
            'data' => $payload,
            'registration_ids' => $array
        );

// Petici�n
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Conectamos y recuperamos la respuesta
        $response = curl_exec($ch);

// Cerramos conexi�n
        curl_close($ch);
    }

    public function confirmarRegistroFace() {
        try {

            $usuario = new Usuario();
            $idFace = isset($_POST['idFace']) ? $_POST['idFace'] : NULL;
            $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : NULL;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : NULL;
            $email = isset($_POST['email']) ? $_POST['email'] : NULL;
            $fechaNacimiento = isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : NULL;
            $regId = isset($_POST['regId']) ? $_POST['regId'] : NULL;
            $token = isset($_POST['token']) ? $_POST['token'] : NULL;
            $fecha = explode("/", $fechaNacimiento);

            $usuario->setNombres($nombres);
            $usuario->setApellidos($apellidos);
            $usuario->setEmail($email);
            $usuario->setIdFace($idFace);
            $usuario->setClave("");
            $usuario->setFNacimiento($fecha[2] . "-" . $fecha[1] . "-" . $fecha[0]);
            if ($regId != NULL) {
                $usuario->setRegId($regId);
                $usuario->setDispositivo("android");
                $usuario->setToken("");
            } else {
                $usuario->setRegId("");
                $usuario->setDispositivo("ios");
                $usuario->setToken($token);
            }

            $u = $usuario->leerPorIdFace($idFace);
            if ($u) {
                if ($regId != NULL) {
                    $usuario->actualizarRegId($u->getIdUsuario(), $regId);
                } else {
                    $usuario->actualizarToken($u->getIdUsuario(), $token);
                }
                echo json_encode(array("msj" => "autenticado", "id" => $u->getIdUsuario()));
            } else {
                $usuario->crearUsuario($usuario);
                $u = $usuario->leerPorIdFace($idFace);
                echo json_encode(array("msj" => "Registrado", "id" => $u->getIdUsuario()));
            }
        } catch (Exception $exc) {
            echo json_encode('Error de aplicacion');
        }
    }

    public function registrarUsuario() {
        try {
            $usuario = new Usuario();
            //$idFace = isset($_POST['idFace']) ? $_POST['idFace'] : NULL;
            $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : NULL;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : NULL;
            $email = isset($_POST['email']) ? $_POST['email'] : NULL;
            
            $regId = isset($_POST['regId']) ? $_POST['regId'] : NULL;
            $token = isset($_POST['token']) ? $_POST['token'] : NULL;
            $clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;

            $usuario->setNombres($nombres);
            $usuario->setApellidos($apellidos);
            $usuario->setEmail($email);
            $usuario->setIdFace("");
            $usuario->setClave($clave);
            $usuario->setFNacimiento("2015-01-01");
            if ($regId != NULL && $regId != "") {
                $usuario->setRegid($regId);
                $usuario->setDispositivo("android");
                $usuario->setToken(NULL);
            } else {
                $usuario->setRegid(NULL);
                $usuario->setDispositivo("ios");
                $usuario->setToken($token);
            }


            $id = $usuario->crearUsuarioFinal($usuario);

            echo json_encode(array("msj" => "registrado", "id" => $id));
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }

    public function login() {
        try {

            $correo = isset($_POST['correo']) ? $_POST['correo'] : NULL;
            $clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;
            $regId = isset($_POST['regId']) ? $_POST['regId'] : NULL;
            $token = isset($_POST['token']) ? $_POST['token'] : NULL;

            $usuario = new Usuario();
            $u = $usuario->leerLogin($correo, $clave);
            if ($u) {
                if ($regId != NULL) {
                    $usuario->actualizarRegId($u->getIdUsuario(), $regId);
                } else {
                    $usuario->actualizarToken($u->getIdUsuario(), $token);
                }
                echo json_encode(array("msj" => "autenticado", "id" => $u->getIdUsuario()));
            } else {
                echo json_encode(array("msj" => "no"));
            }
        } catch (Exception $exc) {
            echo json_encode('Error de aplicacion');
        }
    }

    public function envio($hola) {
        
        $this->enviarNotificacion(array("APA91bHpx90ObX3S2LD6dUeAMJl7UONJaLcXAccjpAFKND8DhLHUL4VlfcfD4LnbdnuwBFtZSWYL-ZeChtS59V1fctdDOuen7zRjifuYfhbRh9p-NhlX10Rxwqdh419c_VPcE3B9eY82o3stUjAtcsTYHf67yAchJunQub0rh4lYIjvO1C3q5xw"), $hola, "01");
echo "Exito";
    }

    public function registrarDomicilio() {
        try {
            $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : NULL;
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : NULL;
            $referencia = isset($_POST['referencia']) ? $_POST['referencia'] : NULL;
            $lat = isset($_POST['lat']) ? $_POST['lat'] : NULL;
            $lng = isset($_POST['lng']) ? $_POST['lng'] : NULL;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : NULL;
            $billete = isset($_POST['billete']) ? $_POST['billete'] : NULL;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL;
            $arreglo = isset($_POST['arreglo']) ? $_POST['arreglo'] : NULL;
            $ciudad=trim($ciudad);
            $array = json_decode($arreglo);
            
            
            $restaurante = new Restaurante();
            $r = $restaurante->leerPorId($idRestaurante);
            $central = new Central();
            $centrales= $central->leerCentralesCercanasCiudad($r->getLat(), $r->getLng(), 15, $ciudad);
            $cen = NULL;
            foreach ($centrales as $c){
                $cen = $c;
                break;
            }
            
            if($cen == NULL){
                echo json_encode(array('msj' => "cerrado"));
            }else{
                $estado = "pendiente";
                $fecha = getdate();
                $fecha = $fecha["year"] . "-" . $fecha["mon"] . "-" . $fecha["mday"];
                $hora = date("H:i:s");
                $usuario = new Usuario();

                if ($usuario->leerPorId($idUsuario)) {
                    $domicilio = new Domicilio();
                    $domicilio->setEstado($estado);
                    $domicilio->setIdRestaurante($idRestaurante);
                    $domicilio->setIdUsuario($idUsuario);
                    $domicilio->setFecha($fecha);
                    $domicilio->setHora($hora);
                    $domicilio->setDireccion($direccion);
                    $domicilio->setReferencia($referencia);
                    $domicilio->setLat($lat);
                    $domicilio->setLng($lng);
                    $domicilio->setTelefono($telefono);
                    $domicilio->setBillete($billete);
                    $domicilio->setIdCentral($cen->getIdCentral());
                    $idDomicilio = $domicilio->crearDomicilio($domicilio);
                    if ($idDomicilio) {

                        foreach ($array as $a) {
                            $detalle = new DetalleDomicilio();
                            $detalle->setIdDomicilio($idDomicilio);
                            $detalle->setIdProducto($a[0]);
                            $detalle->setValor($a[1]);
                            $detalle->setCantidad($a[2]);
                            $detalle->setIndicaciones($a[3]);
                            $detalle->crearDetalleDomicilio($detalle);
                        }
                        $this->enviarNotificacion(array($cen->getRegid()), "Tienes Un Domicilio Nuevo", '01');
                        
                        echo json_encode(array('msj' => "exito"));
                        $this->enviarNotificacion(array($r->getRegid()), "Tienes Un Domicilio", "01");
                    } else {
                        echo json_encode(array('msj' => "error"));
                    }
                }
            }
            
        } catch (Exception $exc) {
            //echo 'Error de aplicacion: ' . $exc->getMessage();
            echo json_encode(array('msj' => "error"));
        }
    }

    public function registrarServicio() {
        try {
            
            $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : NULL;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : NULL;
            $referencia = isset($_POST['referencia']) ? $_POST['referencia'] : NULL;
            $lat = isset($_POST['lat']) ? $_POST['lat'] : NULL;
            $lng = isset($_POST['lng']) ? $_POST['lng'] : NULL;
            $serv = isset($_POST['servicio']) ? $_POST['servicio'] : NULL;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : NULL;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL;
            $destino = isset($_POST['destino']) ? $_POST['destino'] : NULL;
            $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : NULL;
            $hora = isset($_POST['hora']) ? $_POST['hora'] : NULL;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL;
            $ciudad=trim($ciudad);
            //echo $ciudad. " ". " ";
            $estado = "p";
            if($tipo == "e"){
                $fecha = getdate();
                $fecha = $fecha["year"] . "-" . $fecha["mon"] . "-" . $fecha["mday"];
                $hora = date("H:i:s");
            }
            
            $central = new Central();
            $centrales= $central->leerCentralesCercanasCiudad($lat, $lng, 15, $ciudad);
            $cen = NULL;
            foreach ($centrales as $c){
                $cen = $c;
                break;
            }
            
            if($cen == NULL){
                echo json_encode(array('msj' => "cerrado"));
            }else{
                
                $usuario = new Usuario();

                if ($usuario->leerPorId($idUsuario)) {
                    
                    $servicio = new Servicio();
                    $servicio->setEstado($estado);
                    $servicio->setIdUsuario($idUsuario);
                    $servicio->setFecha($fecha);
                    $servicio->setHora($hora);
                    $servicio->setDireccion($direccion);
                    $servicio->setReferencia($referencia);
                    $servicio->setLat($lat);
                    $servicio->setLng($lng);
                    $servicio->setServicio($serv);
                    $servicio->setTelefono($telefono);
                    $servicio->setDestino($destino);
                    $servicio->setDescripcion($descripcion);
                    $servicio->setTipo($tipo);
                    $servicio->setIdCentral($cen->getIdCentral());
                    $servicio->crearServicio($servicio);
                    $this->enviarNotificacion(array($cen->getRegid()), "Tienes Un Servicio Nuevo", '01');
                    echo json_encode(array('msj' => "exito"));
                
                }else{
                    echo json_encode(array('msj' => "error"));
                }
                
            }
            

        } catch (Exception $exc) {
            //echo 'Error de aplicacion: ' . $exc->getMessage();
            echo json_encode(array('msj' => "error"));
        }
    }

    public function loginRestaurante() {

        try {
            $correo = isset($_POST['correo']) ? $_POST['correo'] : NULL;
            $clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;

            $restaurante = new Restaurante();
            $r = $restaurante->leerLogin($correo, $clave);
            if ($r) {
                echo json_encode(array("msj" => "exito", "id" => $r->getIdRestaurante()));
            } else {
                echo json_encode(array("msj" => "no"));
            }
        } catch (Exception $ex) {
            echo json_encode(array("msj" => "error"));
        }
    }
    
    public function loginCentral() {

        try {
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL;
            $clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;

            $central = new Central();
            $r = $central->leerLogin($usuario, $clave);
            if ($r) {
                echo json_encode(array("msj" => "exito", "id" => $r->getIdCentral()));
            } else {
                echo json_encode(array("msj" => "no"));
            }
        } catch (Exception $ex) {
            echo json_encode(array("msj" => "error"));
        }
    }

    public function updateRegId() {

        try {
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $regid = isset($_POST['regId']) ? $_POST['regId'] : NULL;

            $restaurante = new Restaurante();
            $restaurante->actualizarRegId($idRestaurante, $regid);
            echo json_encode(array("msj" => "exito"));
        } catch (Exception $ex) {
            echo json_encode(array("msj" => "error"));
        }
    }

    public function updateRegIdCentral() {

        try {
            $idCentral = isset($_POST['idCentral']) ? $_POST['idCentral'] : NULL;
            $regid = isset($_POST['regId']) ? $_POST['regId'] : NULL;

            $restaurante = new Restaurante();
            $restaurante->actualizarRegIdCentral($idCentral,$regid);
            echo json_encode(array("msj" => "exito"));
        } catch (Exception $ex) {
            echo json_encode(array("msj" => "error"));
        }
    }
    
    public function listarMensajeros(){
        $idCentral = isset($_POST['idCentral']) ? $_POST['idCentral'] : NULL;
        
        try {
            $central = new Central();
            $c = $central->leerPorId($idCentral);
            $ciudad = $c->getCiudad();
            
            $mensajero = new Mensajero();
            $mensajeros  = $mensajero->leerMensajerosByCiudad($ciudad);
            
            $this->vista->set('mensajeros', $mensajeros);
            return $this->vista->imprimir();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function domicilios() {

        try {
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $domicilio = new Domicilio();
            $domiciliosPendientes = $domicilio->leerPendientes($idRestaurante);
            $domiciliosAceptados = $domicilio->leerAceptados($idRestaurante);
            $domiciliosListos = $domicilio->leerListos($idRestaurante);
            $this->vista->set('pendientes', $domiciliosPendientes);
            $this->vista->set('aceptados', $domiciliosAceptados);
            $this->vista->set('listos', $domiciliosListos);
            return $this->vista->imprimir();
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }

    public function listaDomicilios() {

        try {
            $idCentral = isset($_POST['idCentral']) ? $_POST['idCentral'] : NULL;

            $domicilio = new Domicilio();
            $domiciliosPendientes = $domicilio->leerRestaurantesConDomiciliosCentral('p',$idCentral);
            $domiciliosAceptados = $domicilio->leerRestaurantesConDomiciliosCentral('a',$idCentral);
            $domiciliosListos = $domicilio->leerRestaurantesConDomiciliosCentral('l',$idCentral);

            $servicio = new Servicio();
            $serviciosPendientes = $servicio->leerPorEstadoCentral('p',$idCentral);
            $serviciosAceptados = $servicio->leerPorEstadoCentral('a',$idCentral);
            $serviciosListos = $servicio->leerPorEstadoCentral('l',$idCentral);

            $this->vista->set('pendientes', $domiciliosPendientes);
            $this->vista->set('aceptados', $domiciliosAceptados);
            $this->vista->set('listos', $domiciliosListos);

            $this->vista->set('sPendientes', $serviciosPendientes);
            $this->vista->set('sAceptados', $serviciosAceptados);
            $this->vista->set('sListos', $serviciosListos);
            return $this->vista->imprimir();

        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }

    public function listaDomicilios2() {

        try {

            $domicilio = new Domicilio();
            $domiciliosPendientes = $domicilio->leerRestaurantesConDomicilios('p');
            $domiciliosAceptados = $domicilio->leerRestaurantesConDomicilios('a');
            $domiciliosListos = $domicilio->leerRestaurantesConDomicilios('l');

            $servicio = new Servicio();
            $serviciosPendientes = $servicio->leerPorEstado('p');
            $serviciosAceptados = $servicio->leerPorEstado('a');
            $serviciosListos = $servicio->leerPorEstado('l');


            $resP = array();
            foreach ($domiciliosPendientes as $p) {

                $resP[] = array("id" => $p['idDomicilio'], "hora" => $p['hora'], "direccion" => $p['direccion'], "referencia" => $p['referencia'], "nombreUsuario" => $p['nombreUsuario'], "apellidoUsuario" => $p['apellidoUsuario'], "nombreRestaurante" => $p['nombreRestaurante'], "latRestaurante" => $p['latRestaurante'], "latUsuario" => $p['latUsuario'], "lngRestaurante" => $p['lngRestaurante'], "lngUsuario" => $p['lngUsuario']);
            }
            $resL = array();
            foreach ($domiciliosListos as $l) {

                $resL[] = array("id" => $l['idDomicilio'], "hora" => $l['hora'], "direccion" => $l['direccion'], "referencia" => $l['referencia'], "nombreUsuario" => $l['nombreUsuario'], "apellidoUsuario" => $l['apellidoUsuario'], "nombreRestaurante" => $l['nombreRestaurante'], "latRestaurante" => $l['latRestaurante'], "latUsuario" => $l['latUsuario'], "lngRestaurante" => $l['lngRestaurante'], "lngUsuario" => $l['lngUsuario']);
            }

            $resA = array();
            foreach ($domiciliosAceptados as $a) {

                $resA[] = array("id" => $a['idDomicilio'], "hora" => $a['hora'], "direccion" => $a['direccion'], "referencia" => $a['referencia'], "nombreUsuario" => $a['nombreUsuario'], "apellidoUsuario" => $a['apellidoUsuario'], "nombreRestaurante" => $a['nombreRestaurante'], "latRestaurante" => $a['latRestaurante'], "latUsuario" => $a['latUsuario'], "lngRestaurante" => $a['lngRestaurante'], "lngUsuario" => $a['lngUsuario']);
            }

            $serP = array();
            foreach ($serviciosPendientes as $sp) {

                $serP[] = array("id" => $sp['idServicio'], "nombre" => $sp['servicio'], "hora" => $sp['hora'], "direccion" => $sp['direccion'], "referencia" => $sp['referencia'], "nombreUsuario" => $sp['nombres'], "apellidoUsuario" => $sp['apellidos'], "latUsuario" => $sp['lat'], "lngUsuario" => $sp['lng']);
            }

            $serA = array();
            foreach ($serviciosAceptados as $sa) {

                $serA[] = array("id" => $sa['idServicio'], "nombre" => $sa['servicio'], "hora" => $sa['hora'], "direccion" => $sa['direccion'], "referencia" => $sa['referencia'], "nombreUsuario" => $sa['nombres'], "apellidoUsuario" => $sa['apellidos'], "latUsuario" => $sa['lat'], "lngUsuario" => $sa['lng']);
            }

            $serL = array();
            foreach ($serviciosListos as $sl) {

                $serL[] = array("id" => $sl['idServicio'], "nombre" => $sl['servicio'], "hora" => $sl['hora'], "direccion" => $sl['direccion'], "referencia" => $sl['referencia'], "nombreUsuario" => $sl['nombres'], "apellidoUsuario" => $sl['apellidos'], "latUsuario" => $sl['lat'], "lngUsuario" => $sl['lng']);
            }
            echo json_encode(array('pendientes' => $resP, 'listos' => $resL, 'aceptados' => $resA, 'sPendientes' => $serP, 'sListos' => $serL, 'sAceptados' => $serA));
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }
    
    public function asignarMensajero() {

        try {
            $idDomicilio = isset($_POST['id']) ? $_POST['id'] : NULL;
            $idMensajero = isset($_POST['idMensajero']) ? $_POST['idMensajero'] : NULL;
           
            $domicilio = new Domicilio();
            $d = $domicilio->leerPorId($idDomicilio);

            $usuario = new Usuario();
            $u = $usuario->leerPorId($d->getIdUsuario());

            $mensajero = new Mensajero();
            $r = $mensajero->leerPorId($idMensajero);

            $msg = "";
            $estado="o";

            $domicilio->actualizarMensajero($idDomicilio, $idMensajero);

            $r->actualizarEstado($idMensajero, $estado);
            
            $msgUser = "TuDomicilio Te ha asignado un mensajero. \n NOMBRE: ". $r->getNombres()." ".$r->getApellido()
                    ."\n PLACA: ".$r->getPlaca()."\n TELEFONO: ".$r->getTelefono();
            
            $msgMensajero = "TuDomicilio te ha Asignado un Servicio/".$d->getIdDomicilio()."/"
                    .$d->getDireccion()."/".$res->getDireccion(). " - ".$res->getNombre()."/"
                    .$d->getLat()."/".$d->getLng()."/".$res->getLat()."/".$res->getLng()."/"
                    .$u->getNombres()." ".$u->getApellidos()."/".$d->getBillete()."/".$d->getReferencia()."./Domicilio"."/".$u->getTelefono();
            
            if ($u->getDispositivo() == "android") {
                $this->enviarNotificacion(array($u->getRegid()), $msgUser, '01');
            } else {
                $this->enviarNotificacionAPN($u->getToken(), $msg);
            }
            $this->enviarNotificacion(array($r->getRegid()), $msgMensajero, '01');
            
            echo json_encode(array('msj' => 'exito'));
        } catch (Exception $exc) {
            echo json_encode(array('msj' => 'no'));
        }
    }
    
    public function asignarMensajeroServicio() {

        try {
            $idServicio = isset($_POST['id']) ? $_POST['id'] : NULL;
            $idMensajero = isset($_POST['idMensajero']) ? $_POST['idMensajero'] : NULL;
            
            $servicio = new Servicio();
            $d = $servicio->leerPorId($idServicio);

            $usuario = new Usuario();
            $u = $usuario->leerPorId($d->getIdUsuario());

            $mensajero = new Mensajero();
            $r = $mensajero->leerPorId($idMensajero);

            $msg = "";
            $estado="o";
            
            $servicio->actualizarMensajero($idServicio, $idMensajero);
            $r->actualizarEstado($idMensajero, $estado);
            
            $msgUser = "TuDomicilio Te ha asignado un mensajero. \n NOMBRE: ". $r->getNombres()." ".$r->getApellido()
                    ."\n PLACA: ".$r->getPlaca()."\n TELEFONO: ".$r->getTelefono();
            
            $msgMensajero = "TuDomicilio te ha Asignado un Servicio/".$d->getIdServicio()."/"
                    .$d->getDireccion()."/".$d->getDestino(). "/"
                    .$d->getLat()."/".$d->getLng()."/nada/nada/"
                    .$u->getNombres()." ".$u->getApellidos()."/.../".$d->getReferencia()."./".$d->getDescripcion()."/".$d->getTelefono()."/";
            
            if ($u->getDispositivo() == "android") {
                $this->enviarNotificacion(array($u->getRegid()), $msgUser, '01');
            } else {
                $this->enviarNotificacionAPN($u->getToken(), $msg);
            }
            $this->enviarNotificacion(array($r->getRegid()), $msgMensajero, '01');
            
            echo json_encode(array('msj' => 'exito'));
        } catch (Exception $exc) {
            echo json_encode(array('msj' => 'no'));
        }
    }
    
    
    public function cambiarEstadoDomicilio() {

        try {
            $idDomicilio = isset($_POST['idDomicilio']) ? $_POST['idDomicilio'] : NULL;
            $idCentral = isset($_POST['idCentral']) ? $_POST['idCentral'] : NULL;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : NULL;
            
            $domicilio = new Domicilio();
            $d = $domicilio->leerPorId($idDomicilio);

            $usuario = new Usuario();
            $u = $usuario->leerPorId($d->getIdUsuario());

            $restaurante = new Restaurante();
            $r = $restaurante->leerPorId($d->getIdRestaurante());

            if($idCentral == null){
                $central = new Central();
                $km = 15;
                $centrales = $central->leerCentralesCercanas($r->getLat(), $r->getLng(), $km);
                foreach ($centrales as $cen){
                    $c = $cen;
                    break;
                }
            }else{
                $central = new Central();
                $c = $central->leerPorId($idCentral);
            }
            
            $msg = "";
$domicilio->actualizarEstado($idDomicilio, $estado);
            if ($estado == 'a') {
                if($u->getDispositivo() == "android"){
                    return $this->pedirConfirmacion($idDomicilio, $u->getRegid(), $u->getDispositivo());
                }else{
                    return $this->pedirConfirmacion($idDomicilio, $usuario->getToken(), $u->getDispositivo());
                }
                
            
            } elseif ($estado == 'l') {
                $msg = "El domicilio de " . $r->getNombre() . " está listo, espéralo en unos minutos";
            } elseif ($estado == 'n') {
                $msg = "El domicilio de " . $r->getNombre() . " fue cancelado por errores técnicos";
            } elseif ($estado == 'c') {
                $msg = "El domicilio de " . $r->getNombre() . " fue cancelado por errores técnicos";
            } elseif ($estado == 'e') {
                $msg = "Gracias por confiar en TuDomicilio, estamos trabajando para mejorar día a día ";
                $idmensajero = $d->getIdMensajero();
                $mensajero = new Mensajero();
                $mensajero->actualizarEstado($idmensajero, "d");
            }

            if ($u->getDispositivo() == "android") {
                $this->enviarNotificacion(array($u->getRegid()), $msg, '01');
            } else {
                $this->enviarNotificacionAPN($u->getToken(), $msg);
            }

            if ($estado == 'a') {
                $msg = "Hay un pedido Aceptados de " . $r->getNombre() . ", Pronto estará listo para recogerlo";
                $this->enviarNotificacion(array($c->getRegid()), $msg, '01');
            } elseif ($estado == 'l') {
                $msg = "Hay un pedido LISTO en " . $r->getNombre() . ", enviar Mensajero !";
                $this->enviarNotificacion(array($c->getRegid()), $msg, '01');
            }

            echo json_encode(array('msj' => 'exito'));
        } catch (Exception $exc) {
            echo json_encode(array('msj' => 'no'));
        }
    }

    public function cambiarEstadoServicio() {

        try {
            $idServicio = isset($_POST['idServicio']) ? $_POST['idServicio'] :NULL;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : NULL;
            $idCentral = isset($_POST['idCentral']) ? $_POST['idCentral'] : NULL;
            
            $servicio = new Servicio();
            $s = $servicio->leerPorId($idServicio);

            if($idCentral == NULL){
                $central = new Central();
                $km = 15;
                $centrales = $central->leerCentralesCercanas($s->getLat(), $s->getLng(), $km);

                foreach ($centrales as $cen){

                    $c = $cen;
                    break;
                }
            }else{
                $central = new Central();
                $c = $central->leerPorId($idCentral);
            }
            $servicio->actualizarEstado($idServicio, $estado);
            $usuario = new Usuario();
            $u = $usuario->leerPorId($s->getIdUsuario());

            $msg = "";
            if ($estado == 'a') {
                return $this->pedirConfirmacionServicio($idServicio, $u->getRegid(), $u->getDispositivo());
            } elseif ($estado == 'l') {
                $msg = "El Servicio está listo, espéralo en unos minutos";
            } elseif ($estado == 'n') {
                $msg = "El Servicio fue cancelado por errores técnicos";
            } elseif ($estado == 'c') {
                $msg = "El servicio fue cancelado por errores técnicos";
            } elseif ($estado == 'e') {
                $msg = "Gracias por confiar en TuDomicilio, estamos trabajando para mejorar día a día ";
                $idmensajero = $s->getIdMensajero();
                $mensajero = new Mensajero();
                $mensajero->actualizarEstado($idmensajero, "d");
            }
            
            if ($u->getDispositivo() == "android") {
                $this->enviarNotificacion(array($u->getRegid()), $msg, '01');
            } else {
                $this->enviarNotificacionAPN($u->getToken(), $msg);
            }
            
            if ($estado == 'e') {
                $msg = "Uno de los Servicios Entregado ha sido entregado";
                $this->enviarNotificacion(array($c->getRegid()), $msg, '01');
            }
            
            echo json_encode(array('msj' => 'exito'));
        } catch (Exception $exc) {
            echo json_encode(array('msj' => 'no'));
        }
    }

    public function cambiarEstadoRestaurante() {

        try {
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : NULL;

            $restaurante = new Restaurante();
            $restaurante->actualizarEstado($idRestaurante, $estado);

            echo json_encode(array('msj' => 'exito'));
        } catch (Exception $exc) {
            echo json_encode(array('msj' => 'no'));
        }
    }

    public function buscar($params) {

        try {
            $array = explode(",", $params);
            $restaurante = new Restaurante();
            $restaurantes = $restaurante->leerRestaurantesCercanosPorComida($array[0], $array[1], $array[2], $array[3]);
            $this->vista->set('restaurantes', $restaurantes);
            return $this->vista->imprimir();
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }

    public function buscaRestaurante($params) {

        try {
            //$array = explode(",", $params);
            $restaurante = new Restaurante();
            $restaurantes = $restaurante->leerPorNombre($params);
            $this->vista->set('restaurantes', $restaurantes);
            return $this->vista->imprimir();
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }

    public function consultarUsuario() {
        $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : NULL;
        $usuario = new Usuario();
        $u = $usuario->leerPorId($idUsuario);
        echo json_encode(array("id" => $u->getIdUsuario(), "email" => $u->getEmail(), "clave" => $u->getClave(), "nombres" => $u->getNombres(), "apellidos" => $u->getApellidos()));
    }

    public function cambiarClave() {
        try {
            $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : NULL;
            $pass2 = isset($_POST['pass2']) ? $_POST['pass2'] : NULL;
            $pass1 = isset($_POST['pass1']) ? $_POST['pass1'] : NULL;
            $usuario = new Usuario();
            $usuario->actualizarClave($idUsuario, $pass1, $pass2);
            echo json_encode(array("msj" => "exito"));
        } catch (Exception $exc) {
            echo json_encode(array("msj" => "no"));
        }
    }

    public function consultarPedidos() {
        try {
            $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : NULL;
            $domicilio = new Domicilio();
            $pendientes = $domicilio->domiciliosPendientesPersona($idUsuario, 'p');
            $listos = $domicilio->domiciliosPendientesPersona($idUsuario, 'l');
            $entregados = $domicilio->domiciliosPendientesPersona($idUsuario, 'e');
            $aceptados = $domicilio->domiciliosPendientesPersona($idUsuario, 'a');
            $this->vista->set('pendientes', $pendientes);
            $this->vista->set('listos', $listos);
            $this->vista->set('entregados', $entregados);
            $this->vista->set('aceptados', $aceptados);
            return $this->vista->imprimir();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function listaRestaurantes() {


        $restaurante = new Restaurante();
        $restaurantes = $restaurante->leerSitios();
        $res = array();
        foreach ($restaurantes as $r) {

            $res[] = array("id" => $r->getIdRestaurante(), "idTipo" => $r->getIdTipoRestaurante(), "nombre" => $r->getNombre(), "descripcion" => $r->getDescripcion(), "puntaje" => $r->getPuntaje(), "lat" => $r->getLat(), "lng" => $r->getLng(), "estado" => $r->getEstado());
        }

        echo json_encode($res);
    }

    public function listaCategorias() {
        try {
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $categoria = new Categoria();
            $categorias = $categoria->leerCategoriasPorRestaurante($idRestaurante);
            $this->vista->set('categorias', $categorias);
            return $this->vista->imprimir();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function listaCategoriasSelect() {
        try {
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $categoria = new Categoria();
            $categorias = $categoria->leerCategoriasPorRestaurante($idRestaurante);
            $this->vista->set('categorias', $categorias);
            return $this->vista->imprimir();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function listaProductos() {
        try {
            $idCategoria = isset($_POST['idCategoria']) ? $_POST['idCategoria'] : NULL;
            $producto = new ProductoRestaurante();
            $productos = $producto->leerProductoPorCategoria($idCategoria);
            $this->vista->set('productos', $productos);
            return $this->vista->imprimir();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function guardarProducto() {
        try {
            $idCategoria = isset($_POST['idCategoria']) ? $_POST['idCategoria'] : 254;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : 2000;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "asdsdsdsa";
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "dsadad";

            $producto = new ProductoRestaurante();
            $producto->setDescripcion($descripcion);
            $producto->setIdCategoria($idCategoria);
            $producto->setPrecio($precio);
            $producto->setNombre($nombre);
            $producto->setEstado("d");
            $producto->crearProducto($producto);

            echo json_encode(array("msj" => "exito"));
        } catch (Exception $exc) {
            echo json_encode(array("msj" => "no"));
        }
    }

    public function consultarEstadoProducto() {

        try {

            $idProducto = isset($_POST['idProducto']) ? $_POST['idProducto'] : NULL;
            $producto = new ProductoRestaurante();
            $p = $producto->leerProductoPorId($idProducto);
            echo json_encode(array("estado" => $p->getEstado()));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function modificarEstadoProducto() {

        try {

            $idProducto = isset($_POST['idProducto']) ? $_POST['idProducto'] : NULL;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : NULL;
            $producto = new ProductoRestaurante();
            $producto->actualizarEstado($idProducto, $estado);
            echo json_encode(array("msj" => "exito"));
        } catch (Exception $exc) {
            echo json_encode(array("msj" => "n"));
        }
    }

    public function consultarEstadoRestaurante() {

        try {

            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;

            $restaurante = new Restaurante();
            $r = $restaurante->leerPorId($idRestaurante);
            echo json_encode(array("estado" => $r->getEstado()));
        } catch (Exception $exc) {
            echo json_encode(array("msj" => "n"));
        }
    }

    public function localizacion() {
        isset($_POST['lat']) ? $lat = $_POST['lat'] : $lat = '0';
        isset($_POST['lng']) ? $lng = $_POST['lng'] : $lng = '0';
        isset($_POST['cedula']) ? $cedula = $_POST['cedula'] : $cedula = '0';
        
        $mensajero = new Mensajero();
        $m = $mensajero->leerPorCedula($cedula);
        $ciudad = $m->getCiudad();
        $central = new Central();
        $km = 15;
        $centrales = $central->leerCentralesCercanasCiudad($lat, $lng, $km, $ciudad);
        $nombre = $m->getNombres() . " " . $m->getApellido();
        
        $array = array();
        foreach ($centrales as $c ) {
            $array[]= $c->getRegid();
             
        }
echo $nombre;
echo $array[0] ;
        $payload = array('title' => 'Ubicación',
            'message2' => utf8_encode($lat . "/" . $lng . "/" . $nombre),
            'msgcnt' => "02",
            'ubicacion' => 'true'
        );
        $this->enviarNotificacion2($array, $payload);
    }

public function localizacion2() {
        $restaurante = new Restaurante();
        $a = $restaurante->leerCentral();
        isset($_POST['location']) ? $location= $_POST['location'] : $location= '0';
        if($location=='0'){
        $msg="NO";
        }else{ $msg= "SI"; }
        $location= json_decode($location);
        
        $payload = array('title' => 'Ubicación',
            'message' => utf8_encode($location["latidude"] . "/" . $location["longitude"] . "/Jose/".$msg),
            'msgcnt' => "02"
            
        );
        $this->enviarNotificacion2(array($a[0]["regid"]), $payload);
    }

    public function enviarNotificacion2($array, $payload) {

        $apiKey = 'AIzaSyDPo5D9SzKfVzIImE3dIVRFfL28zcMPjyc'; //Clave de la api
// Cabecera
        $headers = array('Content-Type:application/json',
            "Authorization:key=$apiKey");

// Datos
//Aqui se escriben los regid de los dispositivos para enviarle los mensajes
        /* $usuario = new Usuario();
          $usuarios = $usuario->leerUsuarios();
          $registrationIdsArray = array();
          foreach ($usuarios as $u) {
          $registrationIdsArray[] = $u->getRegid();
          }
         */

        $data = array(
            'data' => $payload,
            'registration_ids' => $array
        );

// Petici�n
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Conectamos y recuperamos la respuesta
        $response = curl_exec($ch);

// Cerramos conexi�n
        curl_close($ch);
    }

    public function abrirCentral() {
        try {
            $idCentral = isset($_POST['idCentral']) ? $_POST['idCentral'] : NULL;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : NULL;
            $central = new Central();
            $c = $central->leerPorId($idCentral);
            
            if($estado=='1' || $estado=='0'){
                if($c->getEstado() != '2'){
                    $central->actualizarEstadoCentral($idCentral,$estado);
                }    
            }else{
                $central->actualizarEstadoCentral($idCentral,$estado);
            }
            echo json_encode(array("msj"=>"exito"));
        } catch (Exception $ex) {
            echo json_encode(array("msj"=>"error"));
        }
        
        
    }

public function cambiarEstadoCentral() {
        try {
            $idCentral = isset($_POST['idCentral']) ? $_POST['idCentral'] : 3;
            $central = new Central();

            $c = $central->leerPorId($idCentral);
            $estado = $c->getEstado();

            if($estado=='1'){
                if($c->getEstado() != '2'){
                    $central->actualizarEstadoCentral($idCentral,0);
                    $msj="Central Cerrada Correctamente";
                }    
            }else if($estado=='0'){
                if($c->getEstado() != '2'){
                    $central->actualizarEstadoCentral($idCentral,1);
                    $msj="Central Abierta Correctamente";
                }
            }else{
                $central->actualizarEstadoCentral($idCentral,$estado);
            }
            echo json_encode(array("msj"=>"exito", "alerta"=>$msj));
        } catch (Exception $ex) {
            echo json_encode(array("msj"=>"error"));
        }
        
        
    }

public function consultarEstadoCentral() {
        try {
            $idCentral = isset($_POST['idCentral']) ? $_POST['idCentral'] : 3;
            $central = new Central();

            $c = $central->leerPorId($idCentral);
            $estado = $c->getEstado();

            echo json_encode(array("estado"=>$estado));
        } catch (Exception $ex) {
            echo json_encode(array("msj"=>"error"));
        }
        
        
    }

public function cambiarEstadoCentrales() {
        try {
            $idCentral = isset($_POST['idCentral']) ? $_POST['idCentral'] : NULL;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : NULL;
            
            $central= new Central();
            
            $central->actualizarEstadoCentral($idCentral,$estado);
            
            echo json_encode(array("msj"=>"exito"));
        } catch (Exception $ex) {
            echo json_encode(array("msj"=>"error"));
        }
        
        
    }

    public function confirmarDomicilio() {

        try {
            $idDomicilio = isset($_POST['idDomicilio']) ? $_POST['idDomicilio'] : NULL;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : NULL;

            $domicilio = new Domicilio();
            $d = $domicilio->leerPorId($idDomicilio);

            $usuario = new Usuario();
            $u = $usuario->leerPorId($d->getIdUsuario());

            $restaurante = new Restaurante();
            $r = $restaurante->leerPorId($d->getIdRestaurante());
            $ciudad = "";
            $central = new Central();
            $centrales= $central->leerCentralesCercanasCiudad($r->getLat(), $r->getLng(), 15, $ciudad);
            $cen = NULL;
            foreach ($centrales as $c){
                $cen = $c;
                break;
            }
            
            $domicilio->actualizarEstado($idDomicilio, $estado);
            $msg = "";
            if ($estado == 'a') {
                $msg = "Pedido Confirmado Correctamente";
            } elseif ($estado == 'c') {
                $msg = "Se ha Cancelado el pedido Correctamente";
            }
            if ($u->getDispositivo() == "android") {
                $this->enviarNotificacion(array($u->getRegid()), $msg, '01');
            } else {
                $this->enviarNotificacionAPN($u->getToken(), $msg);
            }
            
            if ($estado == 'a') {
                $msg = "Hay un pedido Confirmado de " . $r->getNombre();
                $this->enviarNotificacion(array($cen->getRegid()), $msg, '01');
            } elseif ($estado == 'c') {
                $msg = "Se ha Cancelado el pedido en " . $r->getNombre();
                $this->enviarNotificacion(array($cen->getRegid()), $msg, '01');
            }

            echo json_encode(array('msj' => 'exito'));
        } catch (Exception $exc) {
            echo json_encode(array('msj' => 'no'));
        }
    }

    public function confirmarServicio() {

        try {
            $idServicio = isset($_POST['idServicio']) ? $_POST['idServicio'] : NULL;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : NULL;

            $servicio = new Servicio();
            $d = $servicio->leerPorId($idServicio);

            $usuario = new Usuario();
            $u = $usuario->leerPorId($d->getIdUsuario());

            $ciudad = "";
            $central = new Central();
            $centrales= $central->leerCentralesCercanasCiudad($d->getLat(), $d->getLng(), 15, $ciudad);
            $cen = NULL;
            foreach ($centrales as $c){
                $cen = $c;
                break;
            }
            
            $servicio->actualizarEstado($idServicio, $estado);
            $msg = "";
            if ($estado == 'a') {
                $msg = "Servicio Confirmado Correctamente";
            } elseif ($estado == 'c') {
                $msg = "Se ha Cancelado el Servicio Correctamente";
            }
            if ($u->getDispositivo() == "android") {
                $this->enviarNotificacion(array($u->getRegid()), $msg, '01');
            } else {
                $this->enviarNotificacionAPN($u->getToken(), $msg);
            }
            
            if ($estado == 'a') {
                $msg = "Hay un Servicio Confirmado";
                $this->enviarNotificacion(array($cen->getRegid()), $msg, '01');
            } elseif ($estado == 'c') {
                $msg = "Se ha Cancelado un Servicio";
                $this->enviarNotificacion(array($cen->getRegid()), $msg, '01');
            }

            echo json_encode(array('msj' => 'exito'));
        } catch (Exception $exc) {
            echo json_encode(array('msj' => 'no'));
        }
    }

    public function guardarCategoria() {
        try {
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $categoria = new Categoria();
            $categoria->setIdRestaurante($idRestaurante);
            $categoria->setNombre($nombre);

            $categoria->crearCategoria($categoria);

            echo json_encode(array("msj" => "exito"));
        } catch (Exception $exc) {
            echo json_encode(array("msj" => "no"));
        }
    }

    public function guardarRestaurante() {
        try {

            $restaurante = new Restaurante();
            $restaurante->setClave("");
            $restaurante->setDescripcion("Lo mejor en comidas rápidas");
            $restaurante->setDireccion("Cra 19 # 9 - 74");
            $restaurante->setEmail("");
            $restaurante->setEstado("c");
            $restaurante->setIdTipoRestaurante(2);
            $restaurante->setLat("10.47865");
            $restaurante->setLng("-73.260621");
            $restaurante->setNombre("Punto Azul");
            $restaurante->setPuntaje(0);
            $restaurante->setRegid("");
            $restaurante->setTelefono("5734457");
            $restaurante->setToken("");
            $restaurante->setVotos(0);
            $restaurante->crearRestaurante($restaurante);
            echo json_encode(array("msj" => "exito"));
        } catch (Exception $exc) {
            echo json_encode(array("msj" => "no"));
        }
    }

    public function pedirConfirmacion($idDomicilio, $regid, $dispositivo) {
        if ($dispositivo == "android") {
            $payload = array('title' => 'Confirmar',
                'message' => utf8_encode("Confirma tu Pedido !"),
                'msgcnt' => '1',
                'confirmacion' => 'true',
                'idDomicilio' => $idDomicilio);
            $this->enviarNotificacion2(array($regid), $payload);
            echo json_encode(array('msj' => "exito"));
        } else {
            $payload = array(
            'alert' => utf8_encode("Confirma tu Pedido !"),
            'sound' => 'default',
            'badge' => 1,
            'confirmacion' => 'true',
            'idDomicilio' => $idDomicilio
            );
           $this->enviarNotificacionAPN2($payload, $regid);
            echo json_encode(array('msj' => "exito"));
        }
    }

    public function pedirConfirmacionServicio($idServicio, $regid, $dispositivo) {
        if ($dispositivo == "android") {
            $payload = array('title' => 'Confirmar',
                'message' => utf8_encode("Confirma tu Servicio !"),
                'msgcnt' => '1',
                'confirmacionServicio' => 'true',
                'idServicio' => $idServicio);
            echo json_encode(array('msj' => "exito"));
            $this->enviarNotificacion2(array($regid), $payload);
        } else {
            $payload = array(
            'alert' => utf8_encode("Confirma tu Servicio !"),
            'sound' => 'default',
            'badge' => 1,
            'confirmacion' => 'true',
            'idServicio' => $idServicio
            );
           $this->enviarNotificacionAPN2($payload, $regid);
            echo json_encode(array('msj' => "exito"));
        }
    }

    public function enviarNotificacionAPN($deviceToken, $message) {
// Put your private key's passphrase here:
        $passphrase = 'qaz123';

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns-dev.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
        $fp = stream_socket_client(
                'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default',
            'badge' => 1
        );

// Encode the payload as JSON
        $payload = json_encode($body);

// Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result)
            echo 'Message not delivered' . PHP_EOL;
        else
            echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
        fclose($fp);
    }

    public function enviarNotificacionAPN2($array, $deviceToken ) {
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Put your private key's passphrase here:
        $passphrase = 'qaz123';
 echo "Entra3";
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'http://admin.blinkmanager.com/utiles/cerk.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
 echo "Entra4";
// Open a connection to the APNS server
        $fp = stream_socket_client(
                'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
echo "Entra5";
        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        echo 'Connected to APNS' . PHP_EOL;
echo "Entra6";
// Create the payload body
        $body['aps'] = $array;

// Encode the payload as JSON
        $payload = json_encode($body);
echo "Entra6";
// Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result)
            echo 'Message not delivered' . PHP_EOL;
        else
            echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server
        fclose($fp);
    }


 public function envioAPN(){
 echo "Entra1";
 $payload = array(
            'alert' => utf8_encode("Confirma tu Servicio !"),
            'sound' => 'default',
            'badge' => 1
            );
 echo "Entra2";
           $this->enviarNotificacionAPN2($payload, "3cfa42cfc35d2778d25b794f2114c669a5c2958f49d82f269f40f1b83ee72b1e");
            echo json_encode(array('msj' => "exito"));

}

public function info(){
phpinfo();
}

public function upload() {
ini_set("display_errors", 1);
        $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : NULL;
         //$fecha = getdate('Y-m-d H:i:s');
//$dateTime = new DateTime("now", new DateTimeZone('America/Bogota'));
//$fecha= $dateTime->format("Y-m-d H:i:s");
$restaurante = new Restaurante();
        if($fecha!="" && $fecha!=NULL){

        
        $act = $restaurante->leerActualizacion($fecha);
        }
        if ($act != NULL || $fecha == "" || $fecha == NULL) {
            $a = $restaurante->leerFecha();
            $restaurantes = $restaurante->leerRestaurantes();
            $res = array();
            foreach ($restaurantes as $r) {

                $res[] = array("id" => $r->getIdRestaurante(), "idTipo" => $r->getIdTipoRestaurante(), "nombre" => $r->getNombre(), "descripcion" => $r->getDescripcion(), "direccion" => $r->getDireccion(), "telefono" => $r->getTelefono(), "email" => $r->getEmail(), "puntaje" => $r->getPuntaje(), "lat" => $r->getLat(), "lng" => $r->getLng(), "estado" => $r->getEstado());            
}
            /*
            $cat = array();
            $categoria = new Categoria();
            $categorias = $categoria->leerCategorias();
            
            foreach($categorias as $c){
                $cat[] = array("id"=> $c->getIdCategoria(), "nombre"=> $c->getNombre(), "idRestaurante"=> $c->getIdRestaurante());
            }
            
            $pro = array();            
            $producto = new ProductoRestaurante();
            $productos = $producto->leerProductos();
            
            foreach ($productos as $p){
                $pro[] = array("id"=> $p->getIdProducto(), "nombre"=> $p->getNombre(), "descripcion"=> $p->getDescripcion(), "precio"=>$p->getPrecio(),"estado"=>$p->getEstado(), "idCategoria"=>$p->getIdCategoria());
            }
            */
            //echo json_encode(array("restaurantes"=>$res, "categorias"=>$cat, "productos"=>$pro, "fecha"=>$a[0]["fecha"]));
            echo json_encode(array("restaurantes"=>$res, "fecha"=>$a[0]["fecha"]));
        } else {
            echo json_encode(array("fecha"=>NULL));
        }
    }
    
    public function consultarTipos(){
        
        try {
            $modulo = isset($_POST['modulo']) ? $_POST['modulo'] : NULL;
            $tipo = new TipoRestaurante();
            $tipos = $tipo->leerTiposRestaurantesByModulo($modulo);

            $this->vista->set('tipos', $tipos);
            return $this->vista->imprimir();
            
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    
    }


public function registrarCategoriaDeReserva() {
        try {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
           
            $restaurante = new Restaurante();
            $restaurante->registrarCategoriaDeReserva($nombre,$idRestaurante);

            echo json_encode("exito");
        } catch (Exception $exc) {
            echo json_encode($exc->getMessage());
        }
    }
    
     public function consultarCategoriaDeReserva() {
        try {
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $restaurante = new Restaurante();
            $categorias = $restaurante->consultarCategoriaDeReserva($idRestaurante);

             foreach ($categorias as $c) {
               $cat[] = array("idCategoria" => $c['idCategoria'], 
                      "nombre" => $c['nombre'],
                      ); 
            }
            
            echo json_encode(array("categorias" => $cat ));
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }
    
     public function registrarItemDeCategoria() {
        try {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
            $idCategoria = isset($_POST['idCategoria']) ? $_POST['idCategoria'] : NULL;
           
            $restaurante = new Restaurante();
            $restaurante->registrarItemDeCategoria($nombre,$descripcion,$precio,$idCategoria);

            echo json_encode("exito");
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }
    
     public function consultarItemDeCategoria() {
        try {
            $idCategoria = isset($_POST['idCategoria']) ? $_POST['idCategoria'] : NULL;
            $restaurante = new Restaurante();
            $items = $restaurante->consultarItemDeCategoria($idCategoria);

             foreach ($items as $i) {
               $item[] = array("idItemReserva" => $i['idItemReserva'], 
                      "nombre" => $i['nombre'],
                      "descripcion" => $i['descripcion'],
                      "precio" => $i['precio'],
                      ); 
            }
            
            echo json_encode(array("items" => $item ));
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }

 public function eliminarItem(){
        try {
            $idItem = isset($_POST['idItem']) ? $_POST['idItem'] : NULL;
            $restaurante = new Restaurante();
            $restaurante->eliminarItem($idItem);

            echo json_encode("exito");
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        } 
    }
public function loginMensajero(){
        try {
            $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : NULL;
            $mensajero = new Mensajero();
            $m = $mensajero->leerPorCedula($cedula);
            if($m == NULL){
                echo json_encode(array("msj"=>"no"));
            }else{
                echo json_encode(array("msj"=>"si"));
            }
            
        } catch (Exception $exc) {
            echo json_encode(array("msj"=>"error"));
        }
            
    }

public function actualizarRegIdMensajero(){
        try {
            $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : NULL;
$regId= isset($_POST['regId']) ? $_POST['regId'] : NULL;
            $mensajero = new Mensajero();
            $mensajero->actualizarRegId($cedula, $regId);
            
                echo json_encode(array("msj"=>"si"));
            
            
        } catch (Exception $exc) {
            echo json_encode(array("msj"=>"no"));
        }
            
    }

public function eliminarProducto(){
        
        $idProducto = isset($_POST['idProducto']) ? $_POST['idProducto'] : NULL;
        try {
            
            $producto = new ProductoRestaurante();
            $producto->eliminarProducto($idProducto);
            
            echo json_encode(array("msj"=>"exito"));
        } catch (Exception $ex) {
            echo json_encode(array("msj"=>"error"));
        }
}
public function eliminarCategoria(){
        
        $idCategoria = isset($_POST['idCategoria']) ? $_POST['idCategoria'] : NULL;
        try {
            $categoria = new Categoria();
            $categoria->eliminarCategoria($idCategoria);
            echo json_encode(array("msj"=>"exito"));
        } catch (Exception $ex) {
            echo json_encode(array("msj"=>"error"));
        }
    }
} 