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

    function getAllMarcas(){
        $query = $this->db->prepare('SELECT * FROM marcas');
        $query->execute();
        $marcas = $query->fetchAll(PDO::FETCH_OBJ);
        return $marcas;
    }

    function getProductoById($id) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
        $producto = $query->fetch(PDO::FETCH_OBJ);
        return $producto;
    }

    function insertProducto($nombre_producto, $peso, $precio, $id_marca) {
        $query = $this->db->prepare('INSERT INTO productos (nombre_producto, peso, precio, id_marca) VALUES(?,?,?,?)');
        $query->execute([$nombre_producto, $peso, $precio, $id_marca]);
        return $this->db->lastInsertId();
    }

    function updateProducto($nombre_producto, $peso, $precio, $id_marca, $id_producto){
        $query = $this->db->prepare('UPDATE productos SET nombre_producto=?, peso=?, precio=?, id_marca=? WHERE id_producto = ?');
        $query->execute([$nombre_producto, $peso, $precio, $id_marca, $id_producto]);
    }

    function deleteProducto($id) {
        $query = $this->db->prepare('DELETE FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
    }
}