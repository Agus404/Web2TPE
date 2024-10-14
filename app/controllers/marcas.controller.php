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
}