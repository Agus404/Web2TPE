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
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_marca = ?');
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

    function deleteMarca($id) {
        $query = $this->db->prepare('DELETE FROM marcas WHERE id_marca = ?');
        $query->execute([$id]);
    }
    
}