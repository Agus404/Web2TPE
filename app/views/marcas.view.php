<?php

class MarcasView{
    
    function showMarcas($marcas){
        require 'templates/lista_marcas.phtml';
    }

    function showProductosByMarca($productos){
        require 'templates/lista_productos.phtml';
    }
}