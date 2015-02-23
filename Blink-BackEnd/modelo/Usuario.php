<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author JoseCarlos
 */
class Usuario extends Modelo{
    
    public function __construct() {
        parent::__construct();
    }
    
    private $idUsuario;
    private $nombres;
    private $apellidos;
    private $telefono;
    private $fNacimiento;
    private $email;
    private $idFace;
    private $regid;
    private $token;
    private $clave;
    private $dispositivo;
    
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getNombres() {
        return $this->nombres;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getIdFace() {
        return $this->idFace;
    }

    public function getRegid() {
        return $this->regid;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setIdFace($idFace) {
        $this->idFace = $idFace;
    }

    public function setRegid($regid) {
        $this->regid = $regid;
    }
    
    public function getToken() {
        return $this->token;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getDispositivo() {
        return $this->dispositivo;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setDispositivo($dispositivo) {
        $this->dispositivo = $dispositivo;
    }
    
    public function getFNacimiento() {
        return $this->fNacimiento;
    }

    public function setFNacimiento($fNacimiento) {
        $this->fNacimiento = $fNacimiento;
    }

        private function mapearUsuario(Usuario $usuario, array $props) {
        if (array_key_exists('idUsuario', $props)) {
            $usuario->setIdUsuario($props['idUsuario']);
        }
         if (array_key_exists('nombres', $props)) {
            $usuario->setNombres($props['nombres']);
        }
         if (array_key_exists('apellidos', $props)) {
            $usuario->setApellidos($props['apellidos']);
        }
        if (array_key_exists('telefono', $props)) {
            $usuario->setTelefono($props['telefono']);
        }
        if (array_key_exists('fNacimiento', $props)) {
            $usuario->setFNacimiento($props['fNacimiento']);
        }
        if (array_key_exists('regid', $props)) {
            $usuario->setRegid($props['regid']);
        }  
        if (array_key_exists('idFace', $props)) {
            $usuario->setIdFace($props['idFace']);
        }  
        if (array_key_exists('email', $props)) {
            $usuario->setEmail($props['email']);
        } 
        if (array_key_exists('token', $props)) {
            $usuario->setToken($props['token']);
        } 
        if (array_key_exists('clave', $props)) {
            $usuario->setClave($props['clave']);
        } 
        if (array_key_exists('dispositivo', $props)) {
            $usuario->setDispositivo($props['dispositivo']);
        } 
        
       
    }
    
    private function getParametros(Usuario $user){
              
        $parametros = array(
            ':nombres' => $user->getNombres(),
            ':apellidos' => $user->getApellidos(),
            ':email' => $user->getEmail(),
            ':fNacimiento' => $user->getFNacimiento(),
            ':regid' => $user->getRegid(),
            ':token' => $user->getToken(),
            ':clave' => $user->getClave(),
            ':dispositivo' => $user->getDispositivo()
        );
        return $parametros;
    }
    
    private function getParametrosPreliminares(Usuario $user){
              
        $parametros = array(
            ':nombres' => $user->getNombres(),
            ':apellidos' => $user->getApellidos(),
            ':email' => $user->getEmail(),
            ':fNacimiento' => $user->getFNacimiento(),
            ':idFace' => $user->getIdFace(),
            ':regid' => $user->getRegid(),
            ':token' => $user->getToken(),
            ':dispositivo' => $user->getDispositivo(),
            ':clave' => $user->getClave()            
        );
        return $parametros;
    }
    
    public function crearUsuario(Usuario $usuario) {
        $sql = "INSERT INTO usuario (nombres, apellidos, email, idFace, fNacimiento, regid, token, dispositivo, clave) VALUES (:nombres, :apellidos, :email, :idFace, :fNacimiento, :regid, :token, :dispositivo, :clave)";
        $this->__setSql($sql);
        $this->ejecutar($this->getParametrosPreliminares($usuario));       
    }
    
    public function crearUsuarioFinal($usuario){
        $sql = "INSERT INTO usuario (nombres, apellidos, email, fNacimiento, regid, token, clave, dispositivo) VALUES (:nombres, :apellidos, :email, :fNacimiento, :regid, :token, :clave, :dispositivo)";
        $this->__setSql($sql);
        return $this->ejecutar2($this->getParametros($usuario)); 
    }
    
    public function leerPorIdFace($idFace){
     
        $sql = "SELECT * FROM usuario WHERE idFace='".$idFace."'";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $Usuario = NULL;
        foreach ($resultado as $fila) {
            $Usuario = new Usuario();
            $this->mapearUsuario($Usuario, $fila);
            
        }
        return $Usuario;
       
    }
    
    public function leerPorId($id){
     
        $sql = "SELECT * FROM usuario WHERE idUsuario=".$id;
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $Usuario = NULL;
        foreach ($resultado as $fila) {
            $Usuario = new Usuario();
            $this->mapearUsuario($Usuario, $fila);
            
        }
        return $Usuario;
       
    }
    
    public function leerLogin($correo, $clave){
     
        $sql = "SELECT * FROM usuario WHERE email='".$correo."' AND clave='".$clave."'";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $Usuario = NULL;
        foreach ($resultado as $fila) {
            $Usuario = new Usuario();
            $this->mapearUsuario($Usuario, $fila);
        }
        return $Usuario;
    }
    
    public function leerUsuarios(){
     
        $sql = "SELECT * FROM usuario";
        $this->__setSql($sql);
        $resultado = $this->consultar($sql);
        $usuarios = array();
        foreach ($resultado as $fila) {
            
            $Usuario = new Usuario();
            $this->mapearUsuario($Usuario, $fila);
            $usuarios[$Usuario->getIdUsuario()]=$Usuario;           
        }
        return $usuarios;
       
    }
    
    public function actualizarRegId($idUsuario, $regid) {
        $sql = "UPDATE usuario SET regid=:regid, dispositivo='android' WHERE idUsuario=:idUsuario";
        $this->__setSql($sql);
        $this->ejecutar(array(':idUsuario' => $idUsuario, ':regid' => $regid));
    }
    
    public function actualizarToken($idUsuario, $token) {
        $sql = "UPDATE usuario SET token=:token, dispositivo='ios' WHERE idUsuario=:idUsuario";
        $this->__setSql($sql);
        $this->ejecutar(array(':idUsuario' => $idUsuario, ':token' => $token));
    }

    public function actualizarClave($idUsuario, $claveA, $claveN) {
        $sql = "UPDATE usuario SET clave=:claveN WHERE idUsuario=:idUsuario AND clave=:claveA";
        $this->__setSql($sql);
        $this->ejecutar(array(':idUsuario' => $idUsuario, ':claveN' => $claveN, ':claveA' => $claveA));
    }
    
    public function verificarAdmin($usuario, $clave) {
        $sql = "SELECT * FROM admin WHERE usuario='".$usuario."' AND clave='".$clave."'";
        $this->__setSql($sql);
        return $this->consultar($sql);
    }

}