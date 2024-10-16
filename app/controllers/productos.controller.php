<?php

require_once "app/models/productos.model.php";
require_once "app/models/marcas.model.php";
require_once "app/views/productos.view.php";
require_once "app/views/layout.view.php";

class ProductosController{

    private $model;
    private $modelMarcas;
    private $view;
    private $layoutView;

    function __construct()
    {
        $this->model = new ProductosModel;
        $this->modelMarcas = new MarcasModel;
        $this->view = new ProductosView;
        $this->layoutView = new LayoutView;
    }

    function showProductos(){
        $productos = $this->model->getAllProductos();
        $marcas = $this->modelMarcas->getAllMarcas();
        $this->view->showProductos($productos,$marcas);
    }

    function showProductoById($id){
        $producto = $this->model->getProductoById($id);
        // $marca = $this->model->getMarcaById($producto->id_marca);
        if(!empty($producto)){
            $this->view->showProducto($producto);
        }else{
            $this->layoutView->showError('Producto no encontrado');
        }
    }

    function addProducto(){
        $nombre_producto = $_POST['nombre_producto'];
        $peso = $_POST['peso'];
        $precio = $_POST['precio'];
        $id_marca = $_POST['id_marca'];

        if (empty($nombre_producto) || empty($peso) || empty($precio) || empty($id_marca)) {
            $this->layoutView->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertProducto($nombre_producto, $peso, $precio, $id_marca);
        if ($id) {
            header('Location: ' . BASE_URL . 'productos');
        } else {
            $this->layoutView->showError("Error al insertar el producto");
        }
    }

    function removeProducto($id){
        $producto = $this->model->getProductoById($id);
        if (empty($producto)){
            $this->layoutView->showError('Producto no encontrado.');
        }else{
            $this->model->deleteProducto($id);
            header('Location: ' . BASE_URL . 'productos');
        }
    }

    function showFormEditar($id){
        $producto = $this->model->getProductoById($id);
        $marcas = $this->modelMarcas->getAllMarcas();
        $this->view->showFormEditar($producto,$marcas);
    }

    function updateProducto($id_producto){
        $nombre_producto = $_POST['nombre_producto'];
        $peso = $_POST['peso'];
        $precio = $_POST['precio'];
        $id_marca = $_POST['id_marca'];

        if (empty($nombre_producto) || empty($peso) || empty($precio) || empty($id_marca)) {
            $this->layoutView->showError("Debe completar todos los campos");
        }else{
            $this->model->updateProducto($nombre_producto, $peso, $precio, $id_marca, $id_producto);
            header('Location: ' . BASE_URL . 'productos');
        }
    }

    function showError($msg){
       $this->layoutView->showError($msg);
    }
}