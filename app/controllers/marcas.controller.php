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
            $this->layoutView->showError('Marca no encontrada');
        }       
    }

    function addMarca(){
        $nombre_marca = $_POST['nombre_marca'];
        $contacto = $_POST['contacto'];
        $sede = $_POST['sede'];

        if (empty($nombre_marca) || empty($contacto) || empty($sede)) {
            $this->layoutView->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertMarca($nombre_marca, $contacto, $sede);
        if ($id) {
            header('Location: ' . BASE_URL . 'marcas');
        } else {
            $this->layoutView->showError("Error al insertar la marca");
        }
    }

    function removeMarca($id){
        $this->model->deleteMarca($id);
        header('Location: ' . BASE_URL . 'marcas');
    }

    function showError($msg){
        $this->layoutView->showError($msg);
    }
}