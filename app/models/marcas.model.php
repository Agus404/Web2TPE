<?php

require_once 'app/models/model.php';

class MarcasModel extends Model{

    function getAllMarcas(){
        $query = $this->db->prepare('SELECT * FROM marcas');
        $query->execute();
        $marcas = $query->fetchAll(PDO::FETCH_OBJ);
        return $marcas;
    }

    function getProductosByMarca($marca) {
        $query = $this->db->prepare('SELECT id_producto, nombre_producto, peso, precio, productos.id_marca, marcas.nombre_marca as nombre_marca FROM productos, marcas WHERE productos.id_marca = ? AND productos.id_marca=marcas.id_marca');
        $query->execute([$marca]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function getMarcaById($id) {
        $query = $this->db->prepare('SELECT * FROM marcas WHERE id_marca = ?');
        $query->execute([$id]);
        $marca = $query->fetch(PDO::FETCH_OBJ);
        return $marca;
    }


    function insertMarca($nombre_marca, $contacto, $sede, $imagen_marca=null) {
        $query = $this->db->prepare('INSERT INTO marcas (nombre_marca, contacto, sede) VALUES(?,?,?)');
        $query->execute([$nombre_marca, $contacto, $sede]);
        $id = $this->db->lastInsertId();
        if($imagen_marca){
            $filePath = $this->moveUploadedFile($imagen_marca);
            $query = $this->db->prepare('UPDATE marcas SET imagen_marca=? WHERE id_marca=?'); 
            $query->execute([$filePath, $id]);    
        }
        return $id;
    }

    function moveUploadedFile($imagen_marca){
        $filePath = "img/" . uniqid("", true) . "." . strtolower(pathinfo($imagen_marca['name'], PATHINFO_EXTENSION));
        move_uploaded_file($imagen_marca['tmp_name'], $filePath);
        return $filePath;
    }

    function updateMarca($nombre_marca, $contacto, $sede, $id, $imagen_marca=null) {
        $query = $this->db->prepare('UPDATE marcas SET nombre_marca=?, contacto=?, sede=? WHERE id_marca = ?');
        $query->execute([$nombre_marca, $contacto, $sede, $id]);
        if($imagen_marca){
            $marca = $this->getMarcaById($id);
            unlink($marca->imagen_marca);
            $filePath = $this->moveUploadedFile($imagen_marca);
            $query = $this->db->prepare('UPDATE marcas SET imagen_marca=? WHERE id_marca=?'); 
            $query->execute([$filePath, $id]);
        }
    }

    function deleteMarca($id) {
        $marca = $this->getMarcaById($id);
        if ($marca->imagen_marca)
            unlink($marca->imagen_marca);
        $query = $this->db->prepare('DELETE FROM marcas WHERE id_marca = ?');
        $query->execute([$id]);
    }
    
}