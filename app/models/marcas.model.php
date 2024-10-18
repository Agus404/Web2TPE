<?php

class MarcasModel{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=chacinados;charset=utf8', 'root', '');
    }

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


    function insertMarca($nombre_marca, $contacto, $sede) {
        $query = $this->db->prepare('INSERT INTO marcas (nombre_marca, contacto, sede) VALUES(?,?,?)');
        $query->execute([$nombre_marca, $contacto, $sede]);
        return $this->db->lastInsertId();
    }

    function updateMarca($nombre_marca, $contacto, $sede, $id) {
        $query = $this->db->prepare('UPDATE marcas SET nombre_marca=?, contacto=?, sede=? WHERE id_marca = ?');
        $query->execute([$nombre_marca, $contacto, $sede, $id]);
    }

    function deleteMarca($id) {
        $query = $this->db->prepare('DELETE FROM marcas WHERE id_marca = ?');
        $query->execute([$id]);
    }
    
}