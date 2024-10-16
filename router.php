<?php

require_once "app/controllers/productos.controller.php";
require_once "app/controllers/marcas.controller.php";
require_once "app/views/layout.view.php";


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'productos';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {

    case 'productos':
        $controller =  new ProductosController;
        if (empty($params[1])) {
            $controller->showProductos();
        } else {
            $id = $params[1];
            $controller->showProductoById($id);
        }
        break;
    
    case 'marcas':
        $controller = new MarcasController;
        if (empty($params[1])) {
            $controller->showMarcas();
        } else {
            $marca = $params[1];
            $controller->showProductosByMarca($marca);
        }
        break;

    case 'agregar-marca':
        $controller = new MarcasController;
        $controller->addMarca();
        break;
    
    case 'eliminar-marca':
        $controller = new MarcasController;
        $view = new LayoutView;
        if (empty($params[1])) {
            $view->showError('Error al eliminar marca');
        } else {
            $id = $params[1];
            $controller->removeMarca($id);
        }
        break;

    default:
        $view = new LayoutView;
        $view->showError("Página no encontrada");
        break;
}
