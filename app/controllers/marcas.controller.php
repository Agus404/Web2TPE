<?php

require_once "app/models/marcas.model.php";
require_once "app/views/marcas.view.php";
require_once "app/views/layout.view.php";


class MarcasController{

    private $view;
    private $model;
    private $layoutView;

    function __construct()
    {
        $this->view = new MarcasView;
        $this->model = new MarcasModel;
        $this->layoutView = new LayoutView;
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
            $this->layoutView->showError('Producto no encontrado');
        }       
    }
}