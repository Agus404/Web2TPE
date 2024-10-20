<?php

require_once "app/models/marcas.model.php";
require_once "app/views/marcas.view.php";
require_once "app/views/layout.view.php";


class MarcasController
{

    private $view;
    private $model;
    private $layoutView;

    function __construct($res)
    {
        $this->view = new MarcasView($res->usuario);
        $this->model = new MarcasModel;
        $this->layoutView = new LayoutView($res->usuario);
    }

    function showMarcas()
    {
        $marcas = $this->model->getAllMarcas();
        $this->view->showMarcas($marcas);
    }

    function showProductosByMarca($id_marca)
    {
        $productos = $this->model->getProductosByMarca($id_marca);
        $marca = $this->model->getMarcaById($id_marca);
        $this->view->showProductosByMarca($productos, $marca);
    }

    function addMarca()
    {
        $validation = $this->validateAndSanitizeFields(['nombre_marca', 'contacto', 'sede']);
        if (!$validation) {
            $this->layoutView->showError("Debe completar todos los campos");
        } else {
            $nombre_marca = $_POST['nombre_marca'];
            $contacto = $_POST['contacto'];
            $sede = $_POST['sede'];
            $imagen_marca = $_FILES['imagen_marca'];

            if($imagen_marca['name'] && ($imagen_marca['type'] == "image/jpg" || $imagen_marca['type'] == "image/jpeg" || $imagen_marca['type'] == "image/png"))
                $id = $this->model->insertMarca($nombre_marca, $contacto, $sede, $imagen_marca);
            else
                $id = $this->model->insertMarca($nombre_marca, $contacto, $sede);
            
                if ($id) {
                header('Location: ' . BASE_URL . 'marcas');
            } else {
                $this->layoutView->showError("Error al insertar la marca");
            }
        }
    }

    function removeMarca($id)
    {
        $marca = $this->model->getMarcaById($id);
        if (empty($marca)) {
            $this->layoutView->showError('Marca no encontrada.');
        } else {
            $this->model->deleteMarca($id);
            header('Location: ' . BASE_URL . 'marcas');
        }
    }

    function showFormEditar($id)
    {
        $marca = $this->model->getMarcaById($id);
        $this->view->showFormEditar($marca);
    }

    function updateMarca($id)
    {
        $validation = $this->validateAndSanitizeFields(['nombre_marca', 'contacto', 'sede']);
        if (!$validation) {
            $this->layoutView->showError("Debe completar todos los campos");
        } else {
            $nombre_marca = $_POST['nombre_marca'];
            $contacto = $_POST['contacto'];
            $sede = $_POST['sede'];
            $imagen_marca = $_FILES['imagen_marca'];
            
            if($imagen_marca['name'] && ($imagen_marca['type'] == "image/jpg" || $imagen_marca['type'] == "image/jpeg" || $imagen_marca['type'] == "image/png"))
                $this->model->updateMarca($nombre_marca, $contacto, $sede, $id, $imagen_marca);
            else
                $this->model->updateMarca($nombre_marca, $contacto, $sede, $id);


            header('Location: ' . BASE_URL . 'marcas');
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

    function showError($msg)
    {
        $this->layoutView->showError($msg);
    }
}
