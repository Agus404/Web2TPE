<?php

class MarcasView{
    
    function showMarcas($marcas){
        require 'templates/lista_marcas.phtml';
    }

    function showProductosByMarca($productos){
        require 'templates/lista_productos.phtml';
    }
    
    function showError($msg) {
        echo "<h1> ERROR </h1>";
        echo "<h2>$msg</h2";
    }
}