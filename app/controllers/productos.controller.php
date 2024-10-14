<?php

require_once "app/models/productos.model.php";
require_once "app/views/productos.view.php";

class ProductosController{

    private $view;
    private $model;

    function __construct()
    {
        $this->view = new ProductosView;
        $this->model = new ProductosModel;
    }

    function showProductos(){
        $productos = $this->model->getAllProductos();
        $this->view->showProductos($productos);
    }

    function showProductoById($id){
        $producto = $this->model->getProductoById($id);
        $this->view->showProducto($producto);
    }
}