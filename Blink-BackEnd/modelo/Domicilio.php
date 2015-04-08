<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Domicilio
 *
 * @author JoseCarlos
 */
class Domicilio extends Modelo{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    private $idDomicilio;
    private $idRestaurante;
    private $idUsuario;
    private $estado;
    private $fecha;
    private $hora;
    private $lat;
    private $lng;
    private $direccion;
    private $referencia;
    private $telefono;
    private $billete;
    private $ciudad;
    private $idMensajero;
    private $idCentral;
    private $nombre;
    private $regid;
    
    function getNombre() {
        return $this->nombre;
    }

    function getRegid() {
        return $this->regid;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setRegid($regid) {
        $this->regid = $regid;
    }

        
    public function getIdDomicilio() {
        return $this->idDomicilio;
    }

    public function getIdRestaurante() {
        return $this->idRestaurante;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setIdDomicilio($idDomicilio) {
        $this->idDomicilio = $idDomicilio;
    }

    public function setIdRestaurante($idRestaurante) {
        $this->idRestaurante = $idRestaurante;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHora() {
        return $this->hora;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }
    
    public function getLat() {
        return $this->lat;
    }

    public function getLng() {
        return $this->lng;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getReferencia() {
        return $this->referencia;
    }

    public function setLat($lat) {
        $this->lat = $lat;
    }

    public function setLng($lng) {
        $this->lng = $lng;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setReferencia($referencia) {
        $this->referencia = $referencia;
    }
    public function getTelefono() {
        return $this->telefono;
    }

    public function getBillete() {
        return $this->billete;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setBillete($billete) {
        $this->billete = $billete;
    }
    
    function getCiudad() {
        return $this->ciudad;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }
    
    function getIdMensajero() {
        return $this->idMensajero;
    }

    function getIdCentral() {
        return $this->idCentral;
    }

    function setIdMensajero($idMensajero) {
        $this->idMensajero = $idMensajero;
    }

    function setIdCentral($idCentral) {
        $this->idCentral = $idCentral;
    }

    
        
        private function mapearDomicilio(Domicilio $domicilio, array $props) {
        if (array_key_exists('idDomicilio', $props)) {
            $domicilio->setIdDomicilio($props['idDomicilio']);
        }
         if (array_key_exists('idUsuario', $props)) {
            $domicilio->setIdUsuario($props['idUsuario']);
        }
         if (array_key_exists('idRestaurante', $props)) {
            $domicilio->setIdRestaurante($props['idRestaurante']);
        }
        if (array_key_exists('estado', $props)) {
            $domicilio->setEstado($props['estado']);
        }
        if (array_key_exists('fecha', $props)) {
            $domicilio->setFecha($props['fecha']);
        }  
        if (array_key_exists('lat', $props)) {
            $domicilio->setLat($props['lat']);
        }  
        if (array_key_exists('lng', $props)) {
            $domicilio->setLng($props['lng']);
        }  
        if (array_key_exists('direccion', $props)) {
            $domicilio->setDireccion($props['direccion']);
        }  
        if (array_key_exists('referencia', $props)) {
            $domicilio->setReferencia($props['referencia']);
        }  
        if (array_key_exists('telefono', $props)) {
            $domicilio->setTelefono($props['telefono']);
        }  
        if (array_key_exists('billete', $props)) {
            $domicilio->setBillete($props['billete']);
        }
        if (array_key_exists('ciudad', $props)) {
            $domicilio->setCiudad($props['ciudad']);
        }
        if (array_key_exists('idMensajero', $props)) {
            $domicilio->setIdMensajero($props['idMensajero']);
        }
        if (array_key_exists('idCentral', $props)) {
            $domicilio->setIdCentral($props['idCentral']);
        }
        
    }
    
    private function getParametros(Domicilio $domicilio){
              
        $parametros = array(
            ':idUsuario' => $domicilio->getIdUsuario(),
            ':idRestaurante' => $domicilio->getIdRestaurante(),
            ':estado' => $domicilio->getEstado(),
            ':fecha' => $domicilio->getFecha(),
            ':hora' => $domicilio->getHora(),
            ':lat' => $domicilio->getLat(),
            ':lng' => $domicilio->getLng(),
            ':direccion' => $domicilio->getDireccion(),
            ':referencia' => $domicilio->getReferencia(),
            ':telefono' => $domicilio->getTelefono(),
            ':billete' => $domicilio->getBillete(),
            ':idCentral' => $domicilio->getIdCentral()
        );
        return $parametros;
    }
    
    public function crearDomicilio(Domicilio $domicilio) {
        $sql = "INSERT INTO domicilio (idUsuario, idRestaurante, estado, fecha, hora, lat, lng, direccion, referencia, telefono, billete, idCentral) VALUES (:idUsuario, :idRestaurante, :estado, :fecha, :hora, :lat, :lng, :direccion, :referencia, :telefono, :billete, :idCentral)";
        $this->__setSql($sql);
        return $this->ejecutar2($this->getParametros($domicilio));       
    }
    
    public function leerPorId($idDomicilio){
     
        $sql = "SELECT * FROM domicilio WHERE idDomicilio=".$idDomicilio;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $domicilio = NULL;
        foreach ($resultado as $fila) {
            $domicilio = new Domicilio();
            $this->mapearDomicilio($domicilio, $fila);
            
        }
        return $domicilio;
       
    }

public function leerPendientes($idRestaurante) {

        $sql = "SELECT * FROM domicilio d, usuario u WHERE d.idUsuario = u.idUsuario AND d.idRestaurante='" . $idRestaurante . "' AND d.estado='p'";
        $this->__setSql($sql);
        return $this->consultar($sql);
    }

    public function leerAceptados($idRestaurante) {
        
        $sql = "SELECT * FROM domicilio d, usuario u WHERE d.idUsuario = u.idUsuario AND d.idRestaurante='" . $idRestaurante . "' AND d.estado='a'";
        $this->__setSql($sql);
       return $this->consultar($sql);
    }
    public function leerEntregados($idRestaurante) {
        
        $sql = "SELECT * FROM domicilio d, usuario u WHERE d.idUsuario = u.idUsuario AND idRestaurante='" . $idRestaurante . "' AND estado='e'";
        $this->__setSql($sql);
        return $this->consultar($sql);
    }

public function leerListos($idRestaurante) {
       
        $sql = "SELECT * FROM domicilio d, usuario u WHERE d.idUsuario = u.idUsuario AND idRestaurante='" . $idRestaurante . "' AND estado='l'";
        $this->__setSql($sql);
        return $this->consultar($sql);
    }

public function actualizarEstado($idDomicilio, $estado) {
        $sql = "UPDATE domicilio SET estado=:estado WHERE idDomicilio=:idDomicilio";
        $this->__setSql($sql);
        $this->ejecutar(array(':idDomicilio' => $idDomicilio, ':estado' => $estado));
    }   
public function domiciliosPendientesPersona($idPersona, $estado){
        $sql = "SELECT * FROM domicilio d, restaurante r WHERE d.idRestaurante = r.idRestaurante AND d.idUsuario=".$idPersona." AND d.estado='".$estado."'";
        $this->__setSql($sql);
        return $this->consultar($sql);
        
    }

public function leerRestaurantesConDomicilios($estado){
        $sql = "SELECT d.idDomicilio as idDomicilio, d.direccion, d.referencia, d.hora as hora, d.telefono, d.billete, r.direccion as direccionRestaurante, r.nombre as nombreRestaurante, u.nombres as nombreUsuario, u.apellidos as apellidoUsuario, r.lat as latRestaurante, d.lat as latUsuario, r.lng as lngRestaurante, d.lng as lngUsuario, r.clave as clave, r.telefono as telefonoRestaurante, d.idMensajero, m.nombres as nombreMensajero, m.apellidos as apellidoMensajero FROM domicilio d, restaurante r, usuario u, mensajero m WHERE d.idRestaurante = r.idRestaurante AND d.idUsuario = u.idUsuario AND d.idMensajero = m.idMensajero AND d.estado='".$estado."' ORDER BY d.idDomicilio ASC";
        $this->__setSql($sql);
        return $this->consultar($sql);
    
    }   
    
    public function leerRestaurantesConDomiciliosCentral($estado, $idCentral){
        $sql = "SELECT d.idDomicilio as idDomicilio, d.direccion, d.referencia, d.hora as hora, d.fecha as fecha, d.telefono, d.billete, r.direccion as direccionRestaurante, r.nombre as nombreRestaurante, u.nombres as nombreUsuario, u.apellidos as apellidoUsuario, r.lat as latRestaurante, d.lat as latUsuario, r.lng as lngRestaurante, d.lng as lngUsuario, r.clave as clave, r.telefono as telefonoRestaurante, d.idMensajero FROM domicilio d, restaurante r, usuario u WHERE d.idRestaurante = r.idRestaurante AND d.idUsuario = u.idUsuario AND d.estado='".$estado."' AND d.idCentral=".$idCentral." ORDER BY d.idDomicilio ASC";
        $this->__setSql($sql);

        return $this->consultar($sql);
    
    }   

public function actualizarMensajero($idDomicilio, $idMensajero) {
        $sql = "UPDATE domicilio SET idMensajero=:idMensajero WHERE idDomicilio=:idDomicilio";
        $this->__setSql($sql);
        $this->ejecutar(array(':idDomicilio' => $idDomicilio, ':idMensajero' => $idMensajero));
    }  
    
}