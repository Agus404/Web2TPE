<?php

class UsuariosModel {

    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=chacinados;charset=utf8', 'root', '');
    }
 
    public function getUserByUsername($username) {    
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
        $query->execute([$username]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }
}
