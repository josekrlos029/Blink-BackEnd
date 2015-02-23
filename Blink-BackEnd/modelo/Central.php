<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Central
 *
 * @author JoseCarlos
 */
class Central extends Modelo{
    
    private $idCentral;
    private $nombre;
    private $ciudad;
    private $regid;
    private $estado;
    private $lat;
    private $lng;
    private $usuario;
    private $clave;
    
    function getIdCentral() {
        return $this->idCentral;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getRegid() {
        return $this->regid;
    }

    function getEstado() {
        return $this->estado;
    }

    function getLat() {
        return $this->lat;
    }

    function getLng() {
        return $this->lng;
    }

    function setIdCentral($idCentral) {
        $this->idCentral = $idCentral;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setRegid($regid) {
        $this->regid = $regid;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setLat($lat) {
        $this->lat = $lat;
    }

    function setLng($lng) {
        $this->lng = $lng;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getClave() {
        return $this->clave;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

       
    private function mapearCentral(Central $central, array $props) {
        
        if (array_key_exists('idCentral', $props)) {
            $central->setIdCentral($props['idCentral']);
        }
        if (array_key_exists('nombre', $props)) {
            $central->setNombre($props['nombre']);
        }
         if (array_key_exists('ciudad', $props)) {
            $central->setCiudad($props['ciudad']);
        }
        if (array_key_exists('regid', $props)) {
            $central->setRegid($props['regid']);
        }
        if (array_key_exists('estado', $props)) {
            $central->setEstado($props['estado']);
        }
        if (array_key_exists('lat', $props)) {
            $central->setLat($props['lat']);
        }
        if (array_key_exists('lng', $props)) {
            $central->setLng($props['lng']);
        }
        if (array_key_exists('usuario', $props)) {
            $central->setUsuario($props['usuario']);
        }
        if (array_key_exists('clave', $props)) {
            $central->setClave($props['clave']);
        }
    }
    
    private function getParametros(Central $central){
              
        $parametros = array(
            ':nombre' => $central->getNombre(),
            ':ciudad' => $central->getCiudad(),
            ':estado' => $central->getEstado(),
            ':lat' => $central->getLat(),
            ':lng' => $central->getLng(),
            ':usuario' => $central->getUsuario(),
            ':clave' => $central->getClave(),
            ':regid' => $central->getRegid()
        );
        return $parametros;
    }
    
    private function getParametrosWithId(Central $central){
              
        $parametros = array(
            ':idCentral' => $central->getIdCentral(),
            ':nombre' => $central->getNombre(),
            ':ciudad' => $central->getCiudad(),
            ':estado' => $central->getEstado(),
            ':lat' => $central->getLat(),
            ':lng' => $central->getLng(),
            ':usuario' => $central->getUsuario(),
            ':clave' => $central->getClave(),
            ':regid' => $central->getRegid()
        );
        return $parametros;
    }
   
    public function crearCentral(Central $central) {
        $sql = "INSERT INTO central (nombre, ciudad, estado, lat, lng, regid, usuario, clave) VALUES (:nombre, :ciudad, :estado, :lat, :lng, :regid, :usuario, :clave)";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametros($central));       
    }
    
    public function actualizarCentral(Central $central) {
        $sql = "UPDATE central SET nombre=:nombre, ciudad=:ciudad, estado=:estado, lat=:lat, lng=:lng, regid=:regid, usuario=:usuario, clave=:clave WHERE idCentral=:idCentral";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametrosWithId($central));
    }
    
    public function leerPorId($id){
     
        $sql = "SELECT * FROM central WHERE idCentral=".$id;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $central = NULL;
        foreach ($resultado as $fila) {
            $central = new Central();
            $this->mapearCentral($central, $fila);
            
        }
        return $central;
       
    }
    
    public function leerLogin($usuario, $clave){
     
        $sql = "SELECT * FROM central WHERE usuario='".$usuario."' AND clave='".$clave."'";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $central = NULL;
        foreach ($resultado as $fila) {
            $central = new Central();
            $this->mapearCentral($central, $fila);
        }
        return $central;
    }
    
    public function leerCentrales(){
     
        $sql = "SELECT * FROM central";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $centrales = array();
        foreach ($resultado as $fila) {
            
            $central = new Central();
            $this->mapearCentral($central, $fila);
            $centrales[$central->getIdCentral()]=$central;           
        }
        return $centrales;
       
    }
    
    public function actualizarRegId($idCentral, $regid) {
        $sql = "UPDATE central SET regid=:regid WHERE idCentral=:idCentral";
        $this->__setSql($sql);
        $this->ejecutar(array(':idCentral' => $idCentral, ':regid' => $regid));
    }

public function actualizarEstadoCentral($idCentral, $estado) {
        $sql = "UPDATE central SET estado=:estado WHERE idCentral=:idCentral";
        $this->__setSql($sql);
        $this->ejecutar(array(':idCentral' => $idCentral, ':estado' => $estado));
    }
    
    public function leerCentralesCercanasCiudad($lat, $lng, $km, $ciudad) {

        $sql = 'SELECT *, (6371 * ACOS( SIN(RADIANS(lat)) * SIN(RADIANS(' . $lat . ')) + COS(RADIANS(lng - ' . $lng . ')) * COS(RADIANS(lat)) * COS(RADIANS(' . $lat . ')) ) ) AS distance FROM central WHERE ciudad = "'.$ciudad.'" AND estado = "1" HAVING distance < ' . $km . ' ORDER BY distance ASC';
        $this->__setSql($sql);

        $resultado = $this->consultar($sql);
        $centrales = array();
        foreach ($resultado as $fila) {
            $central = new Central();
            $this->mapearCentral($central, $fila);
            $centrales[$central->getIdCentral()] = $central;
        }
        return $centrales;
    }

public function leerCentralesCercanas($lat, $lng, $km) {

        $sql = 'SELECT *, (6371 * ACOS( SIN(RADIANS(lat)) * SIN(RADIANS(' . $lat . ')) + COS(RADIANS(lng - ' . $lng . ')) * COS(RADIANS(lat)) * COS(RADIANS(' . $lat . ')) ) ) AS distance FROM central WHERE estado = "1" HAVING distance < ' . $km . ' ORDER BY distance ASC';
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $centrales = array();
        foreach ($resultado as $fila) {
            $central = new Central();
            $this->mapearCentral($central, $fila);
            $centrales[$central->getIdCentral()] = $central;
        }
        return $centrales;
    }
     
}