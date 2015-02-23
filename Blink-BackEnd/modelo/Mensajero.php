<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mensajero
 *
 * @author JoseCarlos
 */
class Mensajero extends Modelo{
    
  private $idMensajero;
    private $cedula;
    private $nombres;
    private $apellido;
    private $telefono;
    private $direccion;
    private $correo;
    private $placa;
    private $marca;
    private $color;
    private $regid;
    private $usuario;
    private $clave;
    private $estado;
    private $ciudad;
    
    function getIdMensajero() {
        return $this->idMensajero;
    }
    
    function getCedula() {
        return $this->cedula;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getPlaca() {
        return $this->placa;
    }

    function getMarca() {
        return $this->marca;
    }

    function getColor() {
        return $this->color;
    }

    function getRegid() {
        return $this->regid;
    }

    function setIdMensajero($idMensajero) {
        $this->idMensajero = $idMensajero;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setPlaca($placa) {
        $this->placa = $placa;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function setRegid($regid) {
        $this->regid = $regid;
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
    
    function getEstado() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

        
    private function mapearMensajero(Mensajero $mensajero, array $props) {
        
        if (array_key_exists('idMensajero', $props)) {
            $mensajero->setIdMensajero($props['idMensajero']);
        }
        if (array_key_exists('cedula', $props)) {
            $mensajero->setCedula($props['cedula']);
        }
         if (array_key_exists('nombres', $props)) {
            $mensajero->setNombres($props['nombres']);
        }
         if (array_key_exists('apellidos', $props)) {
            $mensajero->setApellido($props['apellidos']);
        }
        if (array_key_exists('telefono', $props)) {
            $mensajero->setTelefono($props['telefono']);
        }
        if (array_key_exists('direccion', $props)) {
            $mensajero->setDireccion($props['direccion']);
        }
        if (array_key_exists('regid', $props)) {
            $mensajero->setRegid($props['regid']);
        }  
        
        if (array_key_exists('correo', $props)) {
            $mensajero->setCorreo($props['correo']);
        } 
        if (array_key_exists('usuario', $props)) {
            $mensajero->setUsuario($props['usuario']);
        } 
        if (array_key_exists('clave', $props)) {
            $mensajero->setClave($props['clave']);
        } 
        if (array_key_exists('placa', $props)) {
            $mensajero->setPlaca($props['placa']);
        } 
        if (array_key_exists('marca', $props)) {
            $mensajero->setMarca($props['marca']);
        } 
        if (array_key_exists('color', $props)) {
            $mensajero->setColor($props['color']);
        } 
        if (array_key_exists('estado', $props)) {
            $mensajero->setEstado($props['estado']);
        } 
        if (array_key_exists('ciudad', $props)) {
            $mensajero->setCiudad($props['ciudad']);
        } 

    }
    
    private function getParametros(Mensajero $mensajero){
              
        $parametros = array(
            ':cedula' => $mensajero->getCedula(),
            ':nombres' => $mensajero->getNombres(),
            ':apellidos' => $mensajero->getApellido(),
            ':correo' => $mensajero->getCorreo(),
            ':telefono' => $mensajero->getTelefono(),
            ':direccion' => $mensajero->getDireccion(),
            ':usuario' => $mensajero->getUsuario(),
            ':clave' => $mensajero->getClave(),
            ':regid' => $mensajero->getRegid(),
            ':placa' => $mensajero->getPlaca(),
            ':marca' => $mensajero->getMarca(),
            ':color' => $mensajero->getColor(),
            ':ciudad' => $mensajero->getCiudad()
        );
        return $parametros;
    }
   
    public function crearMensajero(Mensajero $mensajero) {
        $sql = "INSERT INTO mensajero (cedula, nombres, apellidos, correo, regid, telefono, direccion, usuario, clave, placa, marca, color, ciudad) VALUES (:cedula, :nombres, :apellidos, :correo, :regid, :telefono, :direccion, :usuario, :clave, :placa, :marca, :color, :ciudad)";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametros($mensajero));       
    }
    
    public function actualizarMensajero(Mensajero $mensajero) {
        $sql = "UPDATE mensajero SET nombres=:nombres, apellidos=:apellidos, correo=:correo, regid=:regid, telefono=:telefono, direccion=:direccion, usuario=:usuario, clave=:clave, placa=:placa, marca=:marca, color=:color, ciudad=:ciudad  WHERE cedula=:cedula";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametros($mensajero));
    }
    
    public function leerPorId($id){
     
        $sql = "SELECT * FROM mensajero WHERE idMensajero=".$id;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $mensajero = NULL;
        foreach ($resultado as $fila) {
            $mensajero = new Mensajero();
            $this->mapearMensajero($mensajero, $fila);
            
        }
        return $mensajero;
       
    }
    
    public function leerPorCedula($cedula){
     
        $sql = "SELECT * FROM mensajero WHERE cedula='".$cedula."'";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $mensajero = NULL;
        foreach ($resultado as $fila) {
            $mensajero = new Mensajero();
            $this->mapearMensajero($mensajero, $fila);
            
        }
        return $mensajero;
       
    }
    
    public function leerLogin($usuario, $clave){
     
        $sql = "SELECT * FROM mensajero WHERE usuario='".$usuario."' AND clave='".$clave."'";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $mensajero = NULL;
        foreach ($resultado as $fila) {
            $mensajero = new Mensajero();
            $this->mapearMensajero($mensajero, $fila);
        }
        return $mensajero;
    }
    
    public function leerMensajeros(){
     
        $sql = "SELECT * FROM mensajero";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $mensajeros = array();
        foreach ($resultado as $fila) {
            
            $mensajero = new Mensajero();
            $this->mapearMensajero($mensajero, $fila);
            $mensajeros[$mensajero->getIdMensajero()]=$mensajero;           
        }
        return $mensajeros;
       
    }
    
    public function leerMensajerosByCiudad($ciudad){
     
        $sql = "SELECT * FROM mensajero WHERE ciudad='".$ciudad."' AND estado='d'";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $mensajeros = array();
        foreach ($resultado as $fila) {
            
            $mensajero = new Mensajero();
            $this->mapearMensajero($mensajero, $fila);
            $mensajeros[$mensajero->getIdMensajero()]=$mensajero;           
        }
        return $mensajeros;
       
    }
    
    public function actualizarRegId($cedula, $regid) {
        $sql = "UPDATE mensajero SET regid=:regid WHERE cedula=:cedula";
        $this->__setSql($sql);
        $this->ejecutar(array(':cedula' => $cedula, ':regid' => $regid));
    }
    
    public function actualizarEstado($idMensajero, $estado) {
        $sql = "UPDATE mensajero SET estado=:estado WHERE idMensajero=:idMensajero";
        $this->__setSql($sql);
        $this->ejecutar(array(':idMensajero' => $idMensajero, ':estado' => $estado));
    }

public function leerCiudades(){
     
        $sql = "SELECT DISTINCT ciudad FROM central";
        $this->__setSql($sql);
        return $this->consultar($sql);
        
    }
    
}