<?php

require_once 'app/models/model.php';

class UsuariosModel extends Model{
 
    public function getUserByUsername($username) {    
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
        $query->execute([$username]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }
}
