<?php

class ProductosView{
    
    function showProductos($productos){
        require 'templates/lista_productos.phtml';
    }

    function showProducto($producto){
        require 'templates/detalle_producto.phtml';
    }

    function showError($msg) {
        echo "<h1> ERROR </h1>";
        echo "<h2>$msg</h2";
    }
}