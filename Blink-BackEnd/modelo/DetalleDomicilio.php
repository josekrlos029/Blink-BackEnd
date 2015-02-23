<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DetalleDomicilio
 *
 * @author JoseCarlos
 */
class DetalleDomicilio extends Modelo {

    private $idDomicilio;
    private $idProducto;
    private $indicaciones;
    private $cantidad;
    private $valor;

    public function getIdDomicilio() {
        return $this->idDomicilio;
    }

    public function getIdProducto() {
        return $this->idProducto;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setIdDomicilio($idDomicilio) {
        $this->idDomicilio = $idDomicilio;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }
    public function getIndicaciones() {
        return $this->indicaciones;
    }

    public function setIndicaciones($indicaciones) {
        $this->indicaciones = $indicaciones;
    }

    
    private function mapearDetalleDomicilio(DetalleDomicilio $detalle, array $props) {
        if (array_key_exists('idDomicilio', $props)) {
            $detalle->setIdDomicilio($props['idDomicilio']);
        }
        if (array_key_exists('idProducto', $props)) {
            $detalle->setIdProducto($props['idProducto']);
        }
        if (array_key_exists('cantidad', $props)) {
            $detalle->setCantidad($props['cantidad']);
        }
        if (array_key_exists('valor', $props)) {
            $detalle->setValor($props['valor']);
        }
        if (array_key_exists('indicaciones', $props)) {
            $detalle->setIndicaciones($props['indicaciones']);
        }
    }

    private function getParametros(DetalleDomicilio $pro) {

        $parametros = array(
            ':idDomicilio' => $pro->getIdDomicilio(),
            ':idProducto' => $pro->getIdProducto(),
            ':cantidad' => $pro->getCantidad(),
            ':valor' => $pro->getValor(),
            ':indicaciones' => $pro->getIndicaciones()
        );
        return $parametros;
    }

    public function leerProductosPorIdFactura($idFactura) {
        $sql = "SELECT * FROM detallesDomicilio dp, producto p WHERE dp.idProducto=p.idProducto AND dp.idFactura=" . $idFactura;
        $this->__setSql($sql);
        return $this->consultar($sql);
    }

    public function crearDetalleDomicilio(DetalleDomicilio $detalle) {
        $sql = "INSERT INTO detallesdomicilio (idDomicilio,idProducto, cantidad, valor, indicaciones) VALUES ( :idDomicilio, :idProducto, :cantidad, :valor, :indicaciones)";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametros($detalle));
    }

    public function leerPagosPorIdProductoyRangoFecha($idProducto, $inicio, $fin) {
        $sql = "SELECT dp.idFactura, dp.idProducto, dp.cantidad, dp.precioVenta, f.fecha FROM detalles_producto dp, factura f WHERE dp.idFactura=f.idFactura AND dp.idProducto='" . $idProducto . "' AND f.fecha BETWEEN '" . $inicio . "' AND '" . $fin . "' ORDER BY f.fecha DESC";
        $this->__setSql($sql);
        return $this->consultar($sql);
    }

public function leerDetallesPorDomicilio($idDomicilio){
        $sql = "SELECT dd.*, p.*, c.nombre as nombreCategoria FROM detallesdomicilio dd, productorestaurante p, categoriaproducto c WHERE dd.idProducto=p.idProducto AND p.idCategoria= c.idCategoria AND dd.idDomicilio=".$idDomicilio;
        $this->__setSql($sql);
        return $this->consultar($sql);
    }
}