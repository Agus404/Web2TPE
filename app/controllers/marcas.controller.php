<?php

require_once "app/models/marcas.model.php";
require_once "app/views/marcas.view.php";

class MarcasController{

    private $view;
    private $model;

    function __construct()
    {
        $this->view = new MarcasView;
        $this->model = new MarcasModel;
    }

    function showMarcas(){
        $marcas = $this->model->getAllMarcas();
        $this->view->showMarcas($marcas);
    }

    function showProductosByMarca($marca){
        $productos = $this->model->getProductosByMarca($marca);
        if(!empty($productos)){
            $this->view->showProductosByMarca($productos);
        }else{
            $this->view->showError('Producto no encontrado');
        }       
    }
}