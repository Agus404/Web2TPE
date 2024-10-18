<?php

class ProductosView{
    
    function showProductos($productos,$marcas){
        require 'templates/layout/header.phtml';
        require 'templates/form_insertar_producto.phtml';
        require 'templates/lista_productos.phtml';
        require 'templates/layout/footer.phtml';
    }

    function showProducto($producto){
        require 'templates/detalle_producto.phtml';
    }

    function showFormEditar($producto,$marcas){
        require 'templates/layout/header.phtml';
        require 'templates/form_editar_producto.phtml';
        require 'templates/layout/footer.phtml';
    }

    // function getMarcaById($id){
    //     return $this->controller->getMarcaById;
    // }
}