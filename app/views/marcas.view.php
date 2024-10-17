<?php

class MarcasView{
    
    function showMarcas($marcas){
        require 'templates/lista_marcas.phtml';
    }

    function showProductosByMarca($productos){
        require 'templates/layout/header.phtml';
        $id = $productos[0]->id_marca;
        echo "<h1>$id</h1>";
        require 'templates/lista_productos.phtml';
        require 'templates/layout/footer.phtml';
    }

    function showFormEditar($marca){
        require 'templates/layout/header.phtml';
        require 'templates/form_editar_marca.phtml';
        require 'templates/layout/footer.phtml';
    }
}