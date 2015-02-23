<?php
/**
 * Description of AdministradorControl
 *
 * @author JoseCarlos
 */

  
class AdministradorControl extends Controlador{
    
    public function __construct($modelo, $accion) {
        parent::__construct($modelo, $accion);
        $this->setModelo($modelo);
    }
    
//**************************************************************************************************//        
//**********************************INICIO IMPRIMIR VISTAS*********************************************//
//**************************************************************************************************//     
         /**
         * Imprime la Vista principal del Usuario Administrador
         * @return type
         */
        public function usuarioAdministrador(){
        try {
            if($this->verificarSession()){
    
            $this->vista->set('titulo', 'Usuario Administrador');
            return $this->vista->imprimir();
            }
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
            
        }
         public function cerrarSesion() {
             parent::cerrarSesion();
         }
         
     public function gestionarMensajeros() {
        try {

            $this->vista->set('titulo', 'Gestionar Mensajeros');
            
            $mensajero = new Mensajero();
            $mensajeros = $mensajero->leerMensajeros();
            $ciudades = $mensajero->leerCiudades();

            $this->vista->set('mensajeros', $mensajeros);
            $this->vista->set('ciudades', $ciudades);
            return $this->vista->imprimir();
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }
    
    public function gestionarSitios() {
        try {

            $this->vista->set('titulo', 'Gestionar Sitios');
            
            $restaurante = new Restaurante();
            $restaurantes = $restaurante->leerSitios();
            
            $tipoRestaurante = new TipoRestaurante();
            $tipos = $tipoRestaurante->leerTiposRestaurantes();
            
            $this->vista->set('restaurantes', $restaurantes);
            $this->vista->set('tipos', $tipos);
            return $this->vista->imprimir();
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }
    
    public function gestionarCentrales() {
        try {

            $this->vista->set('titulo', 'Gestionar Centrales');
            
            $central = new Central();
            $centrales = $central->leerCentrales();

            $this->vista->set('centrales', $centrales);
            return $this->vista->imprimir();
            
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }
    
    public function gestionarCategorias() {
        try {

            $this->vista->set('titulo', 'Gestionar Categorías');
            
            $tipo = new TipoRestaurante();
            $tipos = $tipo->leerTiposRestaurantes();

            $this->vista->set('tipos', $tipos);
            return $this->vista->imprimir();
            
        } catch (Exception $exc) {
            echo 'Error de aplicacion: ' . $exc->getMessage();
        }
    }
    
    public function registrarMensajero() {
        try {
            $identificacion = isset($_POST['identificacion']) ? $_POST['identificacion'] : NULL;
            $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : NULL;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : NULL;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : NULL;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : NULL;
            $correo = isset($_POST['correo']) ? $_POST['correo'] : NULL;
            $placa = isset($_POST['placa']) ? $_POST['placa'] : NULL;
            $marca = isset($_POST['marca']) ? $_POST['marca'] : NULL;
            $color = isset($_POST['color']) ? $_POST['color'] : NULL;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL;

            $mensajero = new Mensajero();

            $mensajero->setCedula($identificacion);
            $mensajero->setNombres($nombres);
            $mensajero->setApellido($apellidos);
            $mensajero->setTelefono($telefono);
            $mensajero->setDireccion($direccion);
            $mensajero->setCorreo($correo);
            $mensajero->setPlaca($placa);
            $mensajero->setMarca($marca);
            $mensajero->setColor($color);
            $mensajero->setUsuario($identificacion);
            $mensajero->setClave($identificacion);
            $mensajero->setRegid("");
            $mensajero->setCiudad($ciudad);
            
            $mensajero->crearMensajero($mensajero);

            echo json_encode("exito");
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }
    
    public function registrarCentral() {
        try {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL;
            $lat = isset($_POST['lat']) ? $_POST['lat'] : NULL;
            $lng = isset($_POST['lng']) ? $_POST['lng'] : NULL;
            $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL;
            $clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;
            $ciudad=trim($ciudad);
            $central = new Central();

            $central->setNombre($nombre);
            $central->setCiudad($ciudad);
            $central->setLat($lat);
            $central->setLng($lng);
            $central->setClave($clave);
            $central->setUsuario($usuario);
            $central->setEstado('0');
            $central->setRegid("");
            
            $central->crearCentral($central);

            echo json_encode("exito");
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }
    
    public function registrarRestaurante() {
        try {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : NULL;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : NULL;
            $email = isset($_POST['correo']) ? $_POST['correo'] : NULL;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL;
            $lat = isset($_POST['lat']) ? $_POST['lat'] : NULL;
            $lng = isset($_POST['lng']) ? $_POST['lng'] : NULL;
            $clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;
            $modulos = isset($_POST['modulos']) ? $_POST['modulos'] : NULL;
            $idTipoRestaurante = isset($_POST['idTipo']) ? $_POST['idTipo'] : NULL;
            $ciudad=trim($ciudad);
            $restaurante = new Restaurante();

            $restaurante->setNombre($nombre);
            $restaurante->setDescripcion($descripcion);
            $restaurante->setTelefono($telefono);
            $restaurante->setDireccion($direccion);
            $restaurante->setCiudad($ciudad);
            $restaurante->setLat($lat);
            $restaurante->setLng($lng);
            $restaurante->setClave($clave);
            $restaurante->setEmail($email);
            $restaurante->setPuntaje(0);
            $restaurante->setVotos(0);
            $restaurante->setEstado('c');
            $restaurante->setRegid("");
            $restaurante->setToken("");
            $restaurante->setActivo(1);
            $restaurante->setIdTipoRestaurante($idTipoRestaurante);
            
            $restaurante->crearRestaurante($restaurante);
            
            $ultimoRest = $restaurante->leerUltimoRestaurante();
            foreach ($ultimoRest as $uIdRest){
                $idRestaurante = $uIdRest['idRestaurante'];
            }
            
         foreach ($modulos as $modulo) {
             $restaurante->crearModuloRestaurante($idRestaurante,$modulo);
         }
             

            echo json_encode("exito");
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }
    public function cambiarEstadoSitio(){
           try {
               
            $idSitio= isset($_POST['idSitio']) ? $_POST['idSitio'] : NULL;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : NULL;
                
             $restaurante = new Restaurante();
             $restaurante->cambiarEstadoSitio($idSitio,$estado);
            
            echo json_encode("exito");
            
           } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }

    public function registrarTipoRestaurante() {
        try {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL;
            $modulo = isset($_POST['modulo']) ? $_POST['modulo'] : NULL;
            
            $tipoRestaurante = new TipoRestaurante();

            $tipoRestaurante->setNombre($nombre);
            $tipoRestaurante->setDescripcion($descripcion);
            $tipoRestaurante->setSeccion($modulo);
            
            $tipoRestaurante->crearTipoRestaurante($tipoRestaurante);

            echo json_encode("exito");
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }
    
     public function consultarMensajero() {
        try {
            
            $idMensajero = isset($_POST['idMensajero']) ? $_POST['idMensajero'] : NULL;
            $mensajero = new Mensajero();
            $p = $mensajero->leerPorId($idMensajero);

            echo json_encode(array("idMensajero" => $p->getIdMensajero(), "identificacion" => $p->getCedula(), "nombre" => $p->getNombres(), "apellidos" => $p->getApellido(), "telefono" => $p->getTelefono(), "direccion" => $p->getDireccion(), "correo" => $p->getCorreo(), "placa" => $p->getPlaca(), "marca" => $p->getMarca(), "color" => $p->getColor(), "ciudad" => $p->getCiudad()));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    
    public function consultarCentral() {
        try {
            
            $idCentral = isset($_POST['idCentral']) ? $_POST['idCentral'] : NULL;
            $central = new Central();
            $p = $central->leerPorId($idCentral);

            echo json_encode(array("idCentral" => $p->getIdCentral(), "nombre" => $p->getNombre(), "ciudad" => $p->getCiudad(), "lat" => $p->getLat(), "lng" => $p->getLng()));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    public function consultarRestaurante() {
        
        try {
           
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $restaurante = new Restaurante();
            $r = $restaurante->leerPorId($idRestaurante);
            
            $modulos = $restaurante->leerModulosSitios($idRestaurante);
            $mod = array();
            foreach ($modulos as $m) {
               $mod[] = array("idSitio" => $m['idSitio'], 
                      "modulo" => $m['modulo'],
                      ); 
            }
            
            $tipos = $restaurante->leerTipos($idRestaurante);
            $html = '<table border="0" align="center" width="100%" id="mitabla" >'
                    . '<thead>'
                    . '<th>Categoria</th>'
                    . '<th>ELIMINAR</th>'
                    . '</thead>
                    <tbody id="table">';
            foreach ($tipos as $t) {
                
              $html.= '<tr><td>'.$t["nombre"].'['.$t["seccion"].']</td>'
                      .'<td><buttom type="submit" class="button small red" onclick="eliminarTipo('.$t["idtipositio"].','.$idRestaurante.')">ELIMINAR</buttom></td><tr>';
               
            }
            
            $html .= '</tbody>'
                    . '</table>'; 
            
            echo json_encode(array("id" => $r->getIdRestaurante(), "idTipo" => $r->getIdTipoRestaurante(), "nombre" => $r->getNombre(), "descripcion" => $r->getDescripcion(), "puntaje" => $r->getPuntaje(), "lat" => $r->getLat(), "lng" => $r->getLng(), "telefono" => $r->getTelefono(), "direccion" => $r->getDireccion(), "estado" => $r->getEstado(), "ciudad"=> $r->getCiudad(),"activo" => $r->getActivo(), "email"=>$r->getEmail(),"modulos" => $mod,"tabla"=>$html));
        
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        
    }
    
    public function consultarTipoRestaurante() {
        
        try {
            
            $idTipo = isset($_POST['idTipo']) ? $_POST['idTipo'] : NULL;
            $tipo = new TipoRestaurante();
            $r = $tipo->leerPorId($idTipo);
            echo json_encode(array("id" => $r->getIdTipoRestaurante(), "nombre" => $r->getNombre(), "descripcion" => $r->getDescripcion(), "modulo" => $r->getSeccion()));
        
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
        
    }
    
    public function modificarMensajero() {
        try {
            $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : NULL;
            $nombres = isset($_POST['nombres']) ? $_POST['nombres'] : NULL;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : NULL;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : NULL;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : NULL;
            $correo = isset($_POST['correo']) ? $_POST['correo'] : NULL;
            $placa = isset($_POST['placa']) ? $_POST['placa'] : NULL;
            $marca = isset($_POST['marca']) ? $_POST['marca'] : NULL;
            $color = isset($_POST['color']) ? $_POST['color'] : NULL;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL;

            $mensajero = new Mensajero();
            
            $m = $mensajero->leerPorCedula($cedula);
            
            $mensajero->setCedula($cedula);
            $mensajero->setNombres($nombres);
            $mensajero->setApellido($apellidos);
            $mensajero->setPlaca($placa);
            $mensajero->setMarca($marca);
            $mensajero->setColor($color);
            $mensajero->setTelefono($telefono);
            $mensajero->setDireccion($direccion);
            $mensajero->setCorreo($correo);
            $mensajero->setRegid($m->getRegid());
            $mensajero->setUsuario($m->getUsuario());
            $mensajero->setClave($m->getClave());
            $mensajero->setCiudad($ciudad);
            
            $mensajero->actualizarMensajero($mensajero);

            echo json_encode("exito");
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }
    
    public function modificarCentral() {
        try {
            $idCentral = isset($_POST['idCentral']) ? $_POST['idCentral'] : NULL;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL;
            $lat = isset($_POST['lat']) ? $_POST['lat'] : NULL;
            $lng = isset($_POST['lng']) ? $_POST['lng'] : NULL;
            $ciudad=trim($ciudad);
            $central = new Central();
            
            $m = $central->leerPorId($idCentral);
            
            $central->setIdCentral($idCentral);
            $central->setNombre($nombre);
            $central->setCiudad($ciudad);
            $central->setLat($lat);
            $central->setLng($lng);
            $central->setRegid($m->getRegid());
            $central->setEstado($m->getEstado());
            $central->setUsuario($m->getUsuario());
            $central->setClave($m->getClave());
            
            $central->actualizarCentral($central);

            echo json_encode("exito");
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }
    
    public function modificarRestaurante() {
        try {
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : NULL;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : NULL;
            $modulos = isset($_POST['modulos']) ? $_POST['modulos'] : NULL;
            $email = isset($_POST['correo']) ? $_POST['correo'] : NULL;
            $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : NULL;
            $lat = isset($_POST['lat']) ? $_POST['lat'] : NULL;
            $lng = isset($_POST['lng']) ? $_POST['lng'] : NULL;
            $idTipoRestaurante = isset($_POST['idTipo']) ? $_POST['idTipo'] : NULL;
            $activo = isset($_POST['activo']) ? $_POST['activo'] : NULL;
            $ciudad=trim($ciudad);
            $restaurante = new Restaurante();

            $r = $restaurante->leerPorId($idRestaurante);
            
            $restaurante->setIdRestaurante($idRestaurante);
            $restaurante->setNombre($nombre);
            $restaurante->setDescripcion($descripcion);
            $restaurante->setTelefono($telefono);
            $restaurante->setDireccion($direccion);
            $restaurante->setCiudad($ciudad);
            
            $restaurante->setLat($lat);
            $restaurante->setLng($lng);
            $restaurante->setClave($r->getClave());
            $restaurante->setEmail($email);
            $restaurante->setPuntaje($r->getPuntaje());
            $restaurante->setVotos($r->getVotos());
            $restaurante->setEstado($r->getEstado());
            $restaurante->setRegid($r->getRegid());
            $restaurante->setToken($r->getToken());
            $restaurante->setIdTipoRestaurante($idTipoRestaurante);
            $restaurante->setActivo($activo);
         
                        
           $restaurante->actualizarRestaurante($restaurante);
            
            $restaurante->eliminarModulos($idRestaurante); 
            
             foreach ($modulos as $modulo) {
               $restaurante->crearModuloRestaurante($idRestaurante,$modulo);
              }
             
        echo json_encode("exito");
        
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }
    
    public function modificarTipo() {
        try {
            $idTipo = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : NULL;
            $seccion = isset($_POST['modulo']) ? $_POST['modulo'] : NULL;
            
            $tipo = new TipoRestaurante();

            $tipo->setIdTipoRestaurante($idTipo);
            $tipo->setNombre($nombre);
            $tipo->setDescripcion($descripcion);
            $tipo->setSeccion($seccion);
            $tipo->actualizarTipoRestaurante($tipo);

            echo json_encode("exito");
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }
    
    public function actualizarFoto($datos){
        
        $array = split("-", $datos);
        $idObjeto = $array[0];
        $carpeta = $array[1];
        
        if($carpeta == "fotos"){
             $id = "logo";
        }else if($carpeta == "restaurantes"){
            $id = "miniatura";
        }else if($carpeta == "marcadores"){
            $id= "marcador";
        }else if($carpeta == "categorias"){
            $id= "categoria";
        }else if($carpeta == "mensajeros"){
            $id= "mensajero";
        }
        
        $archivo = $_FILES[$id]['name'];
        $trozos = explode(".", $archivo); 
        $extension = end($trozos); 
        $ruta = HOME.DS.'utiles'.DS.'imagenes'.DS;

        $destino = $ruta.$carpeta.DS.$idObjeto.".".$extension;
        $extensiones = ['png'];

        if ($archivo != "") {
            $band=0;    
            for($i=0; $i<count($extensiones); $i++){
                if ($extensiones[$i]==$extension){
                    $band = 1;
                }
            }
                if($band == 1){
                    
                    if (($_FILES[$id]["size"])/1048576 <= 4){

                        if (file_exists($ruta.$carpeta.DS.$idObjeto.'.png')) {
                            unlink($ruta.$carpeta.DS.$idObjeto.'.png');
                        }
                        copy($_FILES[$id]['tmp_name'],$destino);
                        echo "1";
                    }    
                }

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
            echo json_encode($exc->getCode());
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
    
    
     public function agregarTipo() {
        try {
            $idRestaurante = isset($_POST['idRestaurante']) ? $_POST['idRestaurante'] : NULL;
            $idTipo = isset($_POST['tipo']) ? $_POST['tipo'] : NULL;
            
            $t=NULL;
            $tipo = new TipoRestaurante();
            $t= $tipo->leerPorId($idTipo);
            
            $restaurante = new Restaurante();
            
            $r = NULL;
            
            $r= $restaurante->leerModuloSitio($idRestaurante, $t->getSeccion());
            
            if($r!= NULL){
                $restaurante->agregarTipo($idRestaurante,$idTipo);
            }
            

            echo json_encode("exito");
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }
    
    public function eliminarTipo() {
        try {
            $idTipoSitio = isset($_POST['idTipoSitio']) ? $_POST['idTipoSitio'] : NULL;
            
            $restaurante = new Restaurante();
            $restaurante->elminarTipoSitio($idTipoSitio);

            echo json_encode("exito");
        } catch (Exception $exc) {
            echo json_encode($exc->getCode());
        }
    }
    
}
?>