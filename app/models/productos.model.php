<?php

class ProductosModel{
    
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=chacinados;charset=utf8', 'root', '');
    }

    function getAllProductos(){
        $query = $this->db->prepare('SELECT id_producto, nombre_producto, peso, precio, productos.id_marca, marcas.nombre_marca as nombre_marca FROM productos, marcas WHERE productos.id_marca=marcas.id_marca');
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
    
        function getProductoById($id) {
            $query = $this->db->prepare('SELECT id_producto, nombre_producto, peso, precio, productos.id_marca, marcas.nombre_marca as nombre_marca FROM productos, marcas WHERE id_producto = ? AND productos.id_marca=marcas.id_marca');
            $query->execute([$id]);
            $producto = $query->fetch(PDO::FETCH_OBJ);
            return $producto;
        }

    // function getAllMarcas(){
    //     $query = $this->db->prepare('SELECT * FROM marcas');
    //     $query->execute();
    //     $marcas = $query->fetchAll(PDO::FETCH_OBJ);
    //     return $marcas;
    // }

    // function getMarcaById($id) {
    //     $query = $this->db->prepare('SELECT * FROM marcas WHERE id_marca = ?');
    //     $query->execute([$id]);
    //     $marca = $query->fetch(PDO::FETCH_OBJ);
    //     return $marca;
    // }

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