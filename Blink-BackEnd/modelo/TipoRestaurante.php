<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoRestaurante
 *
 * @author JoseCarlos
 */
class TipoRestaurante extends Modelo{
    //put your code here
    private $idTipoRestaurante;
    private $nombre;
    private $descripcion;
    private $seccion;
    
    public function getIdTipoRestaurante() {
        return $this->idTipoRestaurante;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setIdTipoRestaurante($idTipoRestaurante) {
        $this->idTipoRestaurante = $idTipoRestaurante;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
    function getSeccion() {
        return $this->seccion;
    }

    function setSeccion($seccion) {
        $this->seccion = $seccion;
    }

        
    private function mapearTipo(TipoRestaurante $tipo, array $props) {
        if (array_key_exists('idTipoRestaurante', $props)) {
            $tipo->setIdTipoRestaurante($props['idTipoRestaurante']);
        }
        if (array_key_exists('nombre', $props)) {
            $tipo->setNombre($props['nombre']);
        }
        if (array_key_exists('descripcion', $props)) {
            $tipo->setDescripcion($props['descripcion']);
        }
        if (array_key_exists('seccion', $props)) {
            $tipo->setSeccion($props['seccion']);
        }
    }

     private function getParametros(TipoRestaurante $rest) {

        $parametros = array(
            ':nombre' => $rest->getNombre(),
            ':descripcion' => $rest->getDescripcion(),
            ':seccion' => $rest->getSeccion()
        );
        return $parametros;
    }
    
    private function getParametrosWithId(TipoRestaurante $rest) {

        $parametros = array(
            ':idTipoRestaurante' => $rest->getIdTipoRestaurante(),
            ':nombre' => $rest->getNombre(),
            ':descripcion' => $rest->getDescripcion(),
            ':seccion' => $rest->getSeccion()
        );
        return $parametros;
    }
    
    public function crearTipoRestaurante(TipoRestaurante $tipo) {
        $sql = "INSERT INTO tiporestaurante (nombre, descripcion, seccion) VALUES (:nombre, :descripcion, :seccion)";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametros($tipo));
    }
    public function leerPorId($id) {

        $sql = "SELECT * FROM tiporestaurante WHERE idTipoRestaurante=" . $id;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $tipo = NULL;
        foreach ($resultado as $fila) {
            $tipo = new TipoRestaurante();
            $this->mapearTipo($tipo, $fila);
        }
        return $tipo;
    }
    
    public function leerTiposRestaurantes() {
        $sql = "SELECT * FROM tiporestaurante";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $tipos = array();
        foreach ($resultado as $fila) {
            $tipoRestaurante = new TipoRestaurante();
            $this->mapearTipo($tipoRestaurante, $fila);
            $tipos[$tipoRestaurante->getIdTipoRestaurante()] = $tipoRestaurante;
        }
        return $tipos;
    }
    
    public function leerTiposRestaurantesByModulo($modulo) {
        $sql = "SELECT * FROM tiporestaurante WHERE seccion='".$modulo."'";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $tipos = array();
        foreach ($resultado as $fila) {
            $tipoRestaurante = new TipoRestaurante();
            $this->mapearTipo($tipoRestaurante, $fila);
            $tipos[$tipoRestaurante->getIdTipoRestaurante()] = $tipoRestaurante;
        }
        return $tipos;
    }
    
    public function actualizarTipoRestaurante(TipoRestaurante $tipo) {
        $sql = "UPDATE tiporestaurante SET nombre=:nombre, descripcion=:descripcion, seccion=:seccion WHERE idTipoRestaurante=:idTipoRestaurante";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametrosWithId($tipo));
    }

}