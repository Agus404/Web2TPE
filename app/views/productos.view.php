<?php

class ProductosView{
    
    function showProductos($productos){
        require 'templates/lista_productos.phtml';
    }

    function showProducto($producto){
        require 'templates/detalle_producto.phtml';
    }
}