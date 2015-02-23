<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductoRestaurante
 *
 * @author JoseCarlos
 */
class ProductoRestaurante extends Modelo{
    public function __construct() {
        parent::__construct();
    }
    
    private $idProducto;
    private $nombre;
    private $descripcion;
    private $precio;
    private $idCategoria;
    private $estado;
    
    public function getIdProducto() {
        return $this->idProducto;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }
    
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    
    private function mapearProducto(ProductoRestaurante $producto, array $props) {
        if (array_key_exists('idProducto', $props)) {
            $producto->setIdProducto($props['idProducto']);
        }
         if (array_key_exists('nombre', $props)) {
            $producto->setNombre($props['nombre']);
        }
        if (array_key_exists('descripcion', $props)) {
            $producto->setDescripcion($props['descripcion']);
        }
        if (array_key_exists('precio', $props)) {
            $producto->setPrecio($props['precio']);
        }
         if (array_key_exists('idCategoria', $props)) {
            $producto->setIdCategoria($props['idCategoria']);
        }
         if (array_key_exists('estado', $props)) {
            $producto->setEstado($props['estado']);
        }
    }
    
    private function getParametros(ProductoRestaurante $pro){
              
        $parametros = array(
            ':nombre' => $pro->getNombre(),
            ':descripcion' => $pro->getDescripcion(),
            ':precio' => $pro->getPrecio(),
            ':idCategoria' => $pro->getIdCategoria(),
            ':estado' => $pro->getEstado()
        );
        return $parametros;
    }
   
    
    public function crearProducto(ProductoRestaurante $producto) {
        $sql = "INSERT INTO productorestaurante (nombre, descripcion, precio, idCategoria, estado) VALUES (:nombre, :descripcion, :precio, :idCategoria, :estado)";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametros($producto));       
    }
    public function leerProductoPorCategoria($idCategoria){
     
        $sql = "SELECT * FROM productorestaurante WHERE idCategoria=".$idCategoria;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $productos = array();
        foreach ($resultado as $fila) {
            $producto = new ProductoRestaurante();
            $this->mapearProducto($producto, $fila);
            $productos[$producto->getIdProducto()]= $producto;
        }
        return $productos;
    }

public function leerProductoPorId($idProducto){
     
        $sql = "SELECT * FROM productorestaurante WHERE idProducto=".$idProducto;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $producto = NULL;
        foreach ($resultado as $fila) {
            $producto = new ProductoRestaurante();
            $this->mapearProducto($producto, $fila);
        }
        return $producto;
    }

public function actualizarEstado($idProducto, $estado) {
        $sql = "UPDATE productorestaurante SET estado=:estado WHERE idProducto=:idProducto";
        $this->__setSql($sql);
        $this->ejecutar(array(':idProducto' => $idProducto, ':estado' => $estado));
    }

public function leerProductos(){
     
        $sql = "SELECT * FROM productorestaurante";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $productos = array();
        foreach ($resultado as $fila) {
            $producto = new ProductoRestaurante();
            $this->mapearProducto($producto, $fila);
            $productos[$producto->getIdProducto()]= $producto;
        }
        return $productos;
    }

    public function eliminarProducto($idProducto) {
        $sql = "DELETE FROM productorestaurante WHERE idProducto=:idProducto";
        $this->__setSql($sql);
        $this->ejecutar(array(':idProducto' => $idProducto));
    }

}