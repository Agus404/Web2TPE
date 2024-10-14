<?php

class ProductosModel{
    
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=chacinados;charset=utf8', 'root', '');
    }

    function getAllProductos(){
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function getProductoById($id) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
        $producto = $query->fetchAll(PDO::FETCH_OBJ);
        return $producto;
    }

    // private function connect(){
    //     $db = new PDO('mysql:host=localhost;dbname=chacinados;charset=utf8', 'root', '');
    //     return $db
    // }
    // $db = $this->connect();

}