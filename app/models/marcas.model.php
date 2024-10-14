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
}