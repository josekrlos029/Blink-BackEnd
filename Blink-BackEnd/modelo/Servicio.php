<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicio
 *
 * @author JoseCarlos
 */
class Servicio extends Modelo{
    public function __construct() {
        parent::__construct();
    }

    private $idServicio;
    private $idUsuario;
    private $estado;
    private $fecha;
    private $hora;
    private $lat;
    private $lng;
    private $direccion;
    private $referencia;
    private $servicio;
    private $telefono;
    private $destino;
    private $descripcion;
    private $tipo;
    private $idCentral;
    private $express= "e";
    private $programado= "e";
    private $idMensajero;
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

        
    public function getIdServicio() {
        return $this->idServicio;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHora() {
        return $this->hora;
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

    public function getServicio() {
        return $this->servicio;
    }

    public function setIdServicio($idServicio) {
        $this->idServicio = $idServicio;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setHora($hora) {
        $this->hora = $hora;
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

    public function setServicio($servicio) {
        $this->servicio = $servicio;
    }
    
    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    
    function getDestino() {
        return $this->destino;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setDestino($destino) {
        $this->destino = $destino;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function getExpress() {
        return $this->express;
    }

    function getProgramado() {
        return $this->programado;
    }

    function getIdCentral() {
        return $this->idCentral;
    }

    function setIdCentral($idCentral) {
        $this->idCentral = $idCentral;
    }
    
    function getIdMensajero() {
        return $this->idMensajero;
    }

    function setIdMensajero($idMensajero) {
        $this->idMensajero = $idMensajero;
    }

                
    private function mapearServicio(Servicio $servicio, array $props) {
        if (array_key_exists('idServicio', $props)) {
            $servicio->setIdServicio($props['idServicio']);
        }
        if (array_key_exists('idUsuario', $props)) {
            $servicio->setIdUsuario($props['idUsuario']);
        }
        if (array_key_exists('estado', $props)) {
            $servicio->setEstado($props['estado']);
        }
        if (array_key_exists('fecha', $props)) {
            $servicio->setFecha($props['fecha']);
        }
        if (array_key_exists('lat', $props)) {
            $servicio->setLat($props['lat']);
        }
        if (array_key_exists('lng', $props)) {
            $servicio->setLng($props['lng']);
        }
        if (array_key_exists('direccion', $props)) {
            $servicio->setDireccion($props['direccion']);
        }
        if (array_key_exists('referencia', $props)) {
            $servicio->setReferencia($props['referencia']);
        }
        if (array_key_exists('servicio', $props)) {
            $servicio->setServicio($props['servicio']);
        }
        if (array_key_exists('telefono', $props)) {
            $servicio->setTelefono($props['telefono']);
        }
        if (array_key_exists('destino', $props)) {
            $servicio->setDestino($props['destino']);
        }
        if (array_key_exists('descripcion', $props)) {
            $servicio->setDescripcion($props['descripcion']);
        }
        if (array_key_exists('tipo', $props)) {
            $servicio->setTipo($props['tipo']);
        }
        if (array_key_exists('idCentral', $props)) {
            $servicio->setIdCentral($props['idCentral']);
        }
        if (array_key_exists('idMensajero', $props)) {
            $servicio->setIdMensajero($props['idMensajero']);
        }
        if (array_key_exists('nombre', $props)) {
            $servicio->setNombre($props['nombre']);
        }
        if (array_key_exists('regid', $props)) {
            $servicio->setRegid($props['regid']);
        }
    }

    private function getParametros(Servicio $servicio) {

        $parametros = array(
            ':idUsuario' => $servicio->getIdUsuario(),
            ':estado' => $servicio->getEstado(),
            ':fecha' => $servicio->getFecha(),
            ':hora' => $servicio->getHora(),
            ':lat' => $servicio->getLat(),
            ':lng' => $servicio->getLng(),
            ':direccion' => $servicio->getDireccion(),
            ':referencia' => $servicio->getReferencia(),
            ':servicio' => $servicio->getServicio(),
            ':telefono' => $servicio->getTelefono(),
            ':destino' => $servicio->getDestino(),
            ':descripcion' => $servicio->getDescripcion(),
            ':tipo' => $servicio->getTipo(),
            ':idCentral' => $servicio->getIdCentral(),
            ':nombre' => $servicio->getNombre(),
            ':regid' => $servicio->getRegid()
                
        );
        return $parametros;
    }

    public function crearServicio(Servicio $sericio) {
        $sql = "INSERT INTO servicio (idUsuario, estado, fecha, hora, lat, lng, direccion, referencia, servicio, telefono, destino, descripcion, tipo, idCentral, nombre, regid) "
                . "VALUES (:idUsuario, :estado, :fecha, :hora, :lat, :lng, :direccion, :referencia, :servicio, :telefono, :destino, :descripcion, :tipo, :idCentral, :nombre, :regid)";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametros($sericio));
    }

    public function leerPorId($idServicio) {

        $sql = "SELECT * FROM servicio WHERE idServicio=".$idServicio;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $servicio = NULL;
        foreach ($resultado as $fila) {
            $servicio = new Servicio();
            $this->mapearServicio($servicio, $fila);
        }
        return $servicio;
    }

    public function leerPorEstado($estado) {

        $sql = "SELECT s.*, u.nombres, u.apellidos as tel FROM servicio s, usuario u WHERE s.idUsuario = u.idUsuario AND s.estado='".$estado."'";
        $this->__setSql($sql);
        return $this->consultar($sql);
    }

    public function leerPorEstadoCentral($estado, $idCentral) {

        $sql = "SELECT s.*, u.nombres, u.apellidos as tel FROM servicio s, usuario u WHERE s.idUsuario = u.idUsuario AND s.estado='".$estado."' AND s.idCentral=".$idCentral;        $this->__setSql($sql);
        return $this->consultar($sql);
    }
    
public function actualizarEstado($idServicio, $estado) {
        $sql = "UPDATE servicio SET estado=:estado WHERE idServicio=:idServicio";
        $this->__setSql($sql);
        $this->ejecutar(array(':idServicio' => $idServicio, ':estado' => $estado));
    }

 public function actualizarMensajero($idServicio, $idMensajero) {
        $sql = "UPDATE servicio SET idMensajero=:idMensajero WHERE idServicio=:idServicio";
        $this->__setSql($sql);
        $this->ejecutar(array(':idServicio' => $idServicio, ':idMensajero' => $idMensajero));
    }

}