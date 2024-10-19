<?php

require_once "app/models/marcas.model.php";
require_once "app/views/marcas.view.php";
require_once "app/views/layout.view.php";


class MarcasController{

    private $view;
    private $model;
    private $layoutView;

    function __construct($res)
    {
        $this->view = new MarcasView($res->usuario);
        $this->model = new MarcasModel;
        $this->layoutView = new LayoutView($res->usuario);
    }

    function showMarcas(){
        $marcas = $this->model->getAllMarcas();
        $this->view->showMarcas($marcas);
    }

    function showProductosByMarca($id_marca){
        $productos = $this->model->getProductosByMarca($id_marca);
        $marca = $this->model->getMarcaById($id_marca);
        // if(!empty($productos)){
            $this->view->showProductosByMarca($productos, $marca);
        // }else{
        //     $this->layoutView->showError('Marca sin productos');
        // }       
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
        $marca = $this->model->getMarcaById($id);
        if (empty($marca)){
            $this->layoutView->showError('Marca no encontrada.');
        }else{
            $this->model->deleteMarca($id);
            header('Location: ' . BASE_URL . 'marcas');
        }
    }

    function showFormEditar($id){
        $marca = $this->model->getMarcaById($id);
        $this->view->showFormEditar($marca);
    }

    function updateMarca($id){
        $nombre_marca = $_POST['nombre_marca'];
        $contacto = $_POST['contacto'];
        $sede = $_POST['sede'];

        if (empty($nombre_marca) || empty($contacto) || empty($sede)) {
            $this->layoutView->showError("Debe completar todos los campos");
        }else{
            $this->model->updateMarca($nombre_marca, $contacto, $sede, $id);
            header('Location: ' . BASE_URL . 'marcas');
        }
    }

    function showError($msg){
        $this->layoutView->showError($msg);
    }
}