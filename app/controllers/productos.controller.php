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

    function __construct($res)
    {
        $this->model = new ProductosModel;
        $this->modelMarcas = new MarcasModel;
        $this->view = new ProductosView($res->usuario);
        $this->layoutView = new LayoutView($res->usuario);
    }

    function showProductos(){
        $productos = $this->model->getAllProductos();
        $marcas = $this->modelMarcas->getAllMarcas();
        $this->view->showProductos($productos,$marcas);
    }

    function showProductoById($id){
        $producto = $this->model->getProductoById($id);
        if(!empty($producto)){
            $this->view->showProducto($producto);
        }else{
            $this->layoutView->showError('Producto no encontrado');
        }
    }

    function addProducto(){
        
        $validation = $this->validateAndSanitizeFields(['nombre_producto', 'peso', 'precio']);
        if (!$validation) {
            $this->layoutView->showError("Debe completar todos los campos");
        }else{
            $nombre_producto = $_POST['nombre_producto'];
            $peso = $_POST['peso'];
            $precio = $_POST['precio'];
            $id_marca = $_POST['id_marca'];
            $imagen_producto = $_FILES['imagen_producto'];

            if($imagen_producto['name'] && ($imagen_producto['type'] == "image/jpg" || $imagen_producto['type'] == "image/jpeg" || $imagen_producto['type'] == "image/png")) 
                $id = $this->model->insertProducto($nombre_producto, $peso, $precio, $id_marca, $imagen_producto);
            else
                $id = $this->model->insertProducto($nombre_producto, $peso, $precio, $id_marca);

            if ($id) {
                header('Location: ' . BASE_URL . 'productos');
            } else {
                $this->layoutView->showError("Error al insertar el producto");
            }
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
        
        $validation = $this->validateAndSanitizeFields(['nombre_producto', 'peso', 'precio']);
        if (!$validation) {
            $this->layoutView->showError("Debe completar todos los campos");
        }else{
            $nombre_producto = $_POST['nombre_producto'];
            $peso = $_POST['peso'];
            $precio = $_POST['precio'];
            $id_marca = $_POST['id_marca'];
            $imagen_producto = $_FILES['imagen_producto'];

            if($imagen_producto['name'] && ($imagen_producto['type'] == "image/jpg" || $imagen_producto['type'] == "image/jpeg" || $imagen_producto['type'] == "image/png")) 
                $this->model->updateProducto($nombre_producto, $peso, $precio, $id_marca, $id_producto, $imagen_producto);
            else
                $this->model->updateProducto($nombre_producto, $peso, $precio, $id_marca, $id_producto);
            header('Location: ' . BASE_URL . 'productos');
        }
    }

    function validateAndSanitizeFields($fields){
        foreach ($fields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field]))
                return false;
            $_POST[$field] = htmlspecialchars($_POST[$field], ENT_QUOTES, 'UTF-8');
        }
        return true;
    }

    function showError($msg){
       $this->layoutView->showError($msg);
    }
}