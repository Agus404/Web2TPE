<?php

require_once "app/models/productos.model.php";
require_once "app/views/productos.view.php";
require_once "app/views/layout.view.php";

class ProductosController{

    private $model;
    private $view;
    private $layoutView;

    function __construct()
    {
        $this->model = new ProductosModel;
        $this->view = new ProductosView;
        $this->layoutView = new LayoutView;
    }

    function showProductos(){
        $productos = $this->model->getAllProductos();
        $this->view->showProductos($productos);
    }

    function showProductoById($id){
        $producto = $this->model->getProductoById($id);
        if(!empty($producto)){
            $this->view->showProducto($producto);
        }else{
            $this->layoutView->showError('Producto no encontrado');
        }
    }
}