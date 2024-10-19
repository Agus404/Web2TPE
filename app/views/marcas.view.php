<?php

class MarcasView{
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }
    
    function showMarcas($marcas){
        require 'templates/lista_marcas.phtml';
    }

    function showProductosByMarca($productos, $marca){
        require 'templates/layout/header.phtml';
        require 'templates/mostrar_nombre_marca.phtml';
        require 'templates/lista_productos.phtml';
        require 'templates/mostrar_datos_marca.phtml';
        require 'templates/layout/footer.phtml';
    }

    function showFormEditar($marca){
        require 'templates/layout/header.phtml';
        require 'templates/form_editar_marca.phtml';
        require 'templates/layout/footer.phtml';
    }
}