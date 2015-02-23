<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 * @author JoseCarlos
 */
class Categoria extends Modelo{
    public function __construct() {
        parent::__construct();
    }
    
    private $idCategoria;
    private $nombre;
    private $idRestaurante;
    
    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getIdRestaurante() {
        return $this->idRestaurante;
    }

    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setIdRestaurante($idRestaurante) {
        $this->idRestaurante = $idRestaurante;
    }

    private function mapearCategoria(Categoria $categoria, array $props) {
        if (array_key_exists('idCategoria', $props)) {
            $categoria->setIdCategoria($props['idCategoria']);
        }
         if (array_key_exists('nombre', $props)) {
            $categoria->setNombre($props['nombre']);
        }
         if (array_key_exists('idRestaurante', $props)) {
            $categoria->setIdRestaurante($props['idRestaurante']);
        }
    }
    
    private function getParametros(Categoria $cat){
              
        $parametros = array(
            ':nombre' => $cat->getNombre(),
            ':idRestaurante' => $cat->getIdRestaurante()
        );
        return $parametros;
    }
   
    
    public function crearCategoria(Categoria $categoria) {
        $sql = "INSERT INTO categoriaproducto (nombre, idRestaurante) VALUES (:nombre, :idRestaurante)";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametros($categoria));       
    }
    public function leerCategoriasPorRestaurante($idRestaurante){
     
        $sql = "SELECT * FROM categoriaproducto WHERE idRestaurante=".$idRestaurante;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $categorias = array();
        foreach ($resultado as $fila) {
            $categoria = new Categoria();
            $this->mapearCategoria($categoria, $fila);
            $categorias[$categoria->getIdCategoria()]= $categoria;
        }
        return $categorias;
       
    }

    public function leerCategorias(){
     
        $sql = "SELECT * FROM categoriaproducto";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $categorias = array();
        foreach ($resultado as $fila) {
            $categoria = new Categoria();
            $this->mapearCategoria($categoria, $fila);
            $categorias[$categoria->getIdCategoria()]= $categoria;
        }
        return $categorias;
       
    }
    
    public function leerCategoriaPorId($idCategoria){
     
        $sql = "SELECT * FROM categoriaproducto WHERE idCategoria=".$idCategoria;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $categoria = NULL;
        foreach ($resultado as $fila) {
            $categoria = new Categoria();
            $this->mapearCategoria($categoria, $fila);
        }
        return $categoria;
       
    }

public function eliminarCategoria($idCategoria) {
        $sql = "DELETE FROM categoriaproducto WHERE idCategoria=:idCategoria";
        $this->__setSql($sql);
        $this->ejecutar(array(':idCategoria' => $idCategoria));
    }

}
