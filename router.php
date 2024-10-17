<?php

require_once "app/controllers/productos.controller.php";
require_once "app/controllers/marcas.controller.php";

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'productos';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);
$controllerMarcas = new MarcasController;
$controllerProductos = new ProductosController;


switch ($params[0]) {

    case 'productos':
        if (empty($params[1])) {
            $controllerProductos->showProductos();
        } else {
            $id = $params[1];
            $controllerProductos->showProductoById($id);
        }
        break;
    
    case 'marcas':
        if (empty($params[1])) {
            $controllerMarcas->showMarcas();
        } else {
            $marca = $params[1];
            $controllerMarcas->showProductosByMarca($marca);
        }
        break;

    case 'agregar-producto':
        $controllerProductos->addProducto();
        break;

    case 'eliminar-producto':
        if (empty($params[1])) {
            $controllerProductos->showError('Error al eliminar producto');
        } else {
            $id = $params[1];
            $controllerProductos->removeProducto($id);
        }
        break;

    case 'agregar-marca':
        $controllerMarcas->addMarca();
        break;
    
    case 'eliminar-marca':
        if (empty($params[1])) {
            $controllerMarcas->showError('Error al eliminar marca');
        } else {
            $id = $params[1];
            $controllerMarcas->removeMarca($id);
        }
        break;

    default:
        $controllerProductos->showError("Página no encontrada");
        break;
}
