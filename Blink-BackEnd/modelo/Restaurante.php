<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Restaurante
 *
 * @author JoseCarlos
 */
class Restaurante extends Modelo {

    public function __construct() {
        parent::__construct();
    }

    private $idRestaurante;
    private $nombre;
    private $descripcion;
    private $email;
    private $telefono;
    private $direccion;
    private $idTipoRestaurante;
    private $lat;
    private $lng;
    private $puntaje;
    private $votos;
    private $regid;
    private $token;
    private $clave;
    private $estado;
    private $ciudad;
    private $activo;

    public function getIdRestaurante() {
        return $this->idRestaurante;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getIdTipoRestaurante() {
        return $this->idTipoRestaurante;
    }

    public function getLat() {
        return $this->lat;
    }

    public function getLng() {
        return $this->lng;
    }

    public function getPuntaje() {
        return $this->puntaje;
    }

    public function setIdRestaurante($idRestaurante) {
        $this->idRestaurante = $idRestaurante;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setIdTipoRestaurante($idTipoRestaurante) {
        $this->idTipoRestaurante = $idTipoRestaurante;
    }

    public function setLat($lat) {
        $this->lat = $lat;
    }

    public function setLng($lng) {
        $this->lng = $lng;
    }

    public function setPuntaje($puntaje) {
        $this->puntaje = $puntaje;
    }

    public function getVotos() {
        return $this->votos;
    }

    public function setVotos($votos) {
        $this->votos = $votos;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function getRegid() {
        return $this->regid;
    }

    public function getToken() {
        return $this->token;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setRegid($regid) {
        $this->regid = $regid;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }
    
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }
    function getActivo() {
        return $this->activo;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

        
    private function mapearRestaurante(Restaurante $restaurante, array $props) {
        if (array_key_exists('idRestaurante', $props)) {
            $restaurante->setIdRestaurante($props['idRestaurante']);
        }
        if (array_key_exists('nombre', $props)) {
            $restaurante->setNombre($props['nombre']);
        }
        if (array_key_exists('descripcion', $props)) {
            $restaurante->setDescripcion($props['descripcion']);
        }
        if (array_key_exists('telefono', $props)) {
            $restaurante->setTelefono($props['telefono']);
        }
        if (array_key_exists('direccion', $props)) {
            $restaurante->setDireccion($props['direccion']);
        }
        if (array_key_exists('idTipoRestaurante', $props)) {
            $restaurante->setIdTipoRestaurante($props['idTipoRestaurante']);
        }
        if (array_key_exists('lat', $props)) {
            $restaurante->setLat($props['lat']);
        }
        if (array_key_exists('lng', $props)) {
            $restaurante->setLng($props['lng']);
        }
        if (array_key_exists('puntaje', $props)) {
            $restaurante->setPuntaje($props['puntaje']);
        }
        if (array_key_exists('email', $props)) {
            $restaurante->setEmail($props['email']);
        }
        if (array_key_exists('votos', $props)) {
            $restaurante->setVotos($props['votos']);
        }
        if (array_key_exists('regid', $props)) {
            $restaurante->setRegid($props['regid']);
        }
        if (array_key_exists('token', $props)) {
            $restaurante->setToken($props['token']);
        }
        if (array_key_exists('clave', $props)) {
            $restaurante->setClave($props['clave']);
        }
        if (array_key_exists('estado', $props)) {
            $restaurante->setEstado($props['estado']);
        }
        if (array_key_exists('ciudad', $props)) {
            $restaurante->setCiudad($props['ciudad']);
        }
        if (array_key_exists('activo', $props)) {
            $restaurante->setActivo($props['activo']);
        }
    }

     private function getParametros(Restaurante $rest) {

        $parametros = array(
            ':nombre' => $rest->getNombre(),
            ':descripcion' => $rest->getDescripcion(),
            ':email' => $rest->getEmail(),
            ':telefono' => $rest->getTelefono(),
            ':direccion' => $rest->getDireccion(),
            ':idTipoRestaurante' => $rest->getIdTipoRestaurante(),
            ':puntaje' => $rest->getPuntaje(),
            ':votos' => $rest->getVotos(),
            ':lat' => $rest->getLat(),
            ':lng' => $rest->getLng(),
            ':estado' => $rest->getEstado(),
            ':regid' => $rest->getRegid(),
            ':token' => $rest->getToken(),
            ':clave' => $rest->getClave(),
            ':ciudad' => $rest->getCiudad(),
            ':activo' => $rest->getActivo(),
        );
        return $parametros;
    }
    
    private function getParametrosWithId(Restaurante $rest) {

        $parametros = array(
            ':idRestaurante' => $rest->getIdRestaurante(),
            ':nombre' => $rest->getNombre(),
            ':descripcion' => $rest->getDescripcion(),
            ':email' => $rest->getEmail(),
            ':telefono' => $rest->getTelefono(),
            ':direccion' => $rest->getDireccion(),
            ':idTipoRestaurante' => $rest->getIdTipoRestaurante(),
            ':puntaje' => $rest->getPuntaje(),
            ':votos' => $rest->getVotos(),
            ':lat' => $rest->getLat(),
            ':lng' => $rest->getLng(),
            ':estado' => $rest->getEstado(),
            ':regid' => $rest->getRegid(),
            ':token' => $rest->getToken(),
            ':clave' => $rest->getClave(),
            ':ciudad' => $rest->getCiudad(),
            ':activo' => $rest->getActivo(),
        );
        return $parametros;
    }
    
    
public function eliminarItem($idItem) {
        $sql = "DELETE FROM itemreserva WHERE idItemReserva=:idItemReserva";
         $this->__setSql($sql);
         $this->ejecutar(array(":idItemReserva"=>$idItem));
    }
    

 public function registrarCategoriaDeReserva($nombre,$idRestaurante) {
        $sql = "INSERT INTO categoriareservas (idCategoria,nombre,idRestaurante) VALUES (null, :nombre, :idRestaurante)";
        $this->__setSql($sql);
         $this->ejecutar(array(":nombre" => $nombre, ":idRestaurante" => $idRestaurante));
    }
      public function consultarCategoriaDeReserva($idRestaurante) {
       $sql = "SELECT * FROM categoriareservas WHERE idRestaurante=" .$idRestaurante;
         $this->__setSql($sql);
        return $resultado = $this->consultar($sql); 
    }
    
    
     public function registrarItemDeCategoria($nombre,$descripcion,$precio,$idCategoria){
        $sql = "INSERT INTO itemreserva (idItemReserva,nombre,descripcion,precio,idCategoria) VALUES (null, :nombre,:descripcion ,:precio , :idCategoria)";
        $this->__setSql($sql);
         $this->ejecutar(array(":nombre" => $nombre,":descripcion" => $descripcion,":precio" => $precio ,":idCategoria" => $idCategoria));
    }
      public function consultarItemDeCategoria($idCategoria) {
       $sql = "SELECT * FROM itemreserva WHERE idCategoria=" .$idCategoria;
         $this->__setSql($sql);
        return $resultado = $this->consultar($sql); 
    }
    
    public function crearRestaurante(Restaurante $restaurante) {
        $sql = "INSERT INTO restaurante (nombre, descripcion, email, telefono, direccion, idTipoRestaurante, puntaje, lat, lng, votos, regid, token, clave, estado, ciudad,activo) VALUES (:nombre, :descripcion, :email, :telefono, :direccion, :idTipoRestaurante, :puntaje, :lat, :lng, :votos, :regid, :token, :clave, :estado, :ciudad, :activo)";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametros($restaurante));
    }
    public function  crearModuloRestaurante($idRestaurante,$modulo){
           $sql = "INSERT INTO modulositio (idSitio,modulo) VALUES (:idSitio,:modulo)";
        $this->__setSql($sql);
        $this->ejecutar(array(":idSitio"=>$idRestaurante, ":modulo"=>$modulo));
    }

    public function leerUltimoRestaurante(){
         $sql = "SELECT MAX(idRestaurante) AS idRestaurante FROM restaurante";
         $this->__setSql($sql);
        return $resultado = $this->consultar($sql);
    }
    public function leerModulosSitios($idRestaurate) {
       $sql = "SELECT * FROM modulositio WHERE idSitio=" .$idRestaurate;
         $this->__setSql($sql);
        return $resultado = $this->consultar($sql); 
    }
    public function eliminarModulos($idRestaurante) {
       $sql = "DELETE FROM modulositio WHERE idSitio=:idRestaurante";
         $this->__setSql($sql);
        $this->ejecutar(array("idRestaurante"=>$idRestaurante));
    }
    
    public function cambiarEstadoSitio($idSitio,$estado){
          $sql = "UPDATE restaurante SET activo= :estado WHERE idRestaurante = :idSitio";
        $this->__setSql($sql);
        $this->ejecutar(array(":idSitio" => $idSitio, ":estado" => $estado));
    }
    
    public function leerPorId($id) {

        $sql = "SELECT * FROM restaurante WHERE idRestaurante=" . $id;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $restaurante = NULL;
        foreach ($resultado as $fila) {
            $restaurante = new Restaurante();
            $this->mapearRestaurante($restaurante, $fila);
        }
        return $restaurante;
    }

    public function leerLogin($correo, $clave) {

        $sql = "SELECT * FROM restaurante WHERE email='" . $correo . "' AND clave='" . $clave . "'";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $restaurante = NULL;
        foreach ($resultado as $fila) {
            $restaurante = new Restaurante();
            $this->mapearRestaurante($restaurante, $fila);
        }
        return $restaurante;
    }
    
    public function actualizarRestaurante(Restaurante $restaurante) {
        $sql = "UPDATE restaurante SET nombre=:nombre, descripcion=:descripcion, email=:email, telefono=:telefono, direccion=:direccion, idTipoRestaurante=:idTipoRestaurante, puntaje=:puntaje, lat=:lat, lng=:lng, votos=:votos, regid=:regid, token=:token, clave=:clave, estado=:estado, ciudad=:ciudad ,activo=:activo WHERE idRestaurante=:idRestaurante";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametrosWithId($restaurante));
    }

    public function leerRestaurantesPorIdTipo($idTipo) {

        $sql = "SELECT * FROM restaurante WHERE idTipoRestaurante=" . $idTipo;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $restaurantes = array();
        foreach ($resultado as $fila) {
            $restaurante = new Restaurante();
            $this->mapearRestaurante($restaurante, $fila);
            $restaurantes[$restaurante->getIdRestaurante()] = $restaurante;
        }
        return $restaurantes;
    }
    
    public function leerRestaurantesPorIdTipoYCiudad($idTipo, $ciudad, $modulo) {

        $sql = "SELECT r.* FROM restaurante r, modulositio ms, tipositios ts WHERE r.idRestaurante=ms.idSitio AND r.idRestaurante=ts.idRestaurante AND ts.idTipoRestaurante=" . $idTipo." AND ms.modulo='".$modulo."' AND r.ciudad='".$ciudad."' AND r.activo='1'";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $restaurantes = array();
        foreach ($resultado as $fila) {
            $restaurante = new Restaurante();
            $this->mapearRestaurante($restaurante, $fila);
            $restaurantes[$restaurante->getIdRestaurante()] = $restaurante;
        }
        return $restaurantes;
    }

    public function leerRestaurantesCercanos($lat, $lng, $km) {

        $sql = 'SELECT *, (6371 * ACOS( SIN(RADIANS(lat)) * SIN(RADIANS(' . $lat . ')) + COS(RADIANS(lng - ' . $lng . ')) * COS(RADIANS(lat)) * COS(RADIANS(' . $lat . ')) ) ) AS distance FROM restaurante HAVING distance < ' . $km . ' ORDER BY distance ASC';
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $restaurantes = array();
        foreach ($resultado as $fila) {
            $restaurante = new Restaurante();
            $this->mapearRestaurante($restaurante, $fila);
            $restaurantes[$restaurante->getIdRestaurante()] = $restaurante;
        }
        return $restaurantes;
    }

    public function actualizarRegId($idRestaurante, $regid) {
        $sql = "UPDATE restaurante SET regid=:regid WHERE idRestaurante=:idRestaurante";
        $this->__setSql($sql);
        $this->ejecutar(array(':idRestaurante' => $idRestaurante, ':regid' => $regid));
    }

    public function actualizarRegIdCentral($idCentral,$regid) {
        $sql = "UPDATE central SET regid=:regid WHERE idCentral=:idCentral";
        $this->__setSql($sql);
        $this->ejecutar(array(':regid' => $regid, ':idCentral'=>$idCentral));
    }
    
    public function actualizarToken($idRestaurante, $token) {
        $sql = "UPDATE restaurante SET token=:token WHERE idRestaurante=:idRestaurante";
        $this->__setSql($sql);
        $this->ejecutar(array(':idRestaurante' => $idRestaurante, ':token' => $token));
    }
public function leerRestaurantesCercanosPorComida($lat, $lng, $km, $nombre) {

        $sql = 'SELECT r.*, (6371 * ACOS( SIN(RADIANS(lat)) * SIN(RADIANS(' . $lat . ')) + COS(RADIANS(lng - ' . $lng . ')) * COS(RADIANS(lat)) * COS(RADIANS(' . $lat . ')) ) ) AS distance FROM restaurante r, productorestaurante p, categoriaproducto c WHERE c.idCategoria = p.idCategoria AND r.idRestaurante = c.idRestaurante AND p.nombre LIKE "%'.$nombre.'%" HAVING distance < ' . $km . ' ORDER BY distance ASC';
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $restaurantes = array();
        foreach ($resultado as $fila) {
            $restaurante = new Restaurante();
            $this->mapearRestaurante($restaurante, $fila);
            $restaurantes[$restaurante->getIdRestaurante()] = $restaurante;
        }
        return $restaurantes;
    }

public function leerPorNombre($nombre) {

        $sql = "SELECT * FROM restaurante WHERE nombre LIKE '%".$nombre."%'" ;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $restaurantes = array();
        foreach ($resultado as $fila) {
            $restaurante = new Restaurante();
            $this->mapearRestaurante($restaurante, $fila);
            $restaurantes[$restaurante->getIdRestaurante()] = $restaurante;
        }
        return $restaurantes;
    }
    
    public function actualizarEstado($idRestaurante, $estado) {
        $sql = "UPDATE restaurante SET estado=:estado WHERE idRestaurante=:idRestaurante";
        $this->__setSql($sql);
        $this->ejecutar(array(':idRestaurante' => $idRestaurante, ':estado' => $estado));
    }

    public function leerRestaurantes() {

        $sql = "SELECT * FROM restaurante WHERE idTipoRestaurante=1 OR idTipoRestaurante=2 OR idTipoRestaurante=3 OR idTipoRestaurante=4";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $restaurantes = array();
        foreach ($resultado as $fila) {
            $restaurante = new Restaurante();
            $this->mapearRestaurante($restaurante, $fila);
            $restaurantes[$restaurante->getIdRestaurante()] = $restaurante;
        }
        return $restaurantes;
    }
    
    public function leerCentral() {

        $sql = "SELECT * FROM central";
        $this->__setSql($sql);
        return  $this->consultar($sql);
    }

    public function leerSitios() {

        $sql = "SELECT * FROM restaurante ORDER BY nombre ASC";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $restaurantes = array();
        foreach ($resultado as $fila) {
            $restaurante = new Restaurante();
            $this->mapearRestaurante($restaurante, $fila);
            $restaurantes[$restaurante->getIdRestaurante()] = $restaurante;
        }
        return $restaurantes;
    }

public function actualizarCentral($regid) {
        $sql = "UPDATE central SET estado=:regid";
        //$sql = "UPDATE restaurante SET estado=:regid";
        $this->__setSql($sql);
        $this->ejecutar(array(':regid' => $regid));
    }

 public function leerActualizacion($fecha){
        $sql = "SELECT * FROM act WHERE fecha > '".$fecha."'";
        $this->__setSql($sql);
        return $this->consultar($sql);
        
    }

    public function leerFecha(){
        $sql = "SELECT * FROM act";
        $this->__setSql($sql);
        return $this->consultar($sql);
        
    }
    
    public function agregarTipo($idRestaurante, $idTipo){
        $sql = "INSERT INTO tipositios (idTipoRestaurante, idRestaurante) VALUES(:idTipoRestaurante, :idRestaurante)";
        $this->__setSql($sql);
        $this->ejecutar(array(':idRestaurante' => $idRestaurante,':idTipoRestaurante' => $idTipo));
    }
    
    public function elminarTipoSitio($idTipoSitio){
        $sql = "DELETE FROM tipositios WHERE idtipositio=:idtipositio";
        $this->__setSql($sql);
        $this->ejecutar(array(':idtipositio' => $idTipoSitio));
    }
    
    public function leerTipos($idRestaurante){
        $sql = "SELECT t.*, ts.idtipositio FROM tipositios ts, tiporestaurante t WHERE ts.idTipoRestaurante = t.idTipoRestaurante AND idRestaurante=".$idRestaurante;
        $this->__setSql($sql);
        return $this->consultar($sql);
    }

    public function leerModuloSitio($idRestaurante, $modulo){
        $sql = "SELECT * FROM modulositio WHERE idSitio=".$idRestaurante." AND modulo='".$modulo."'";
        $this->__setSql($sql);
        return $this->consultar($sql);
        
    }
}