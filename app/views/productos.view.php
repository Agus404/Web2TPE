<?php

class ProductosView{
    
    function showProductos($productos){
        require 'templates/lista_productos.phtml';
    }

    function showProducto($producto){
        echo $producto->nombre_producto;
    }
}