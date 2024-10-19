<?php

require_once "app/controllers/productos.controller.php";
require_once "app/controllers/marcas.controller.php";
require_once "app/controllers/auth.controller.php";
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
require_once "libs/response.php";

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$res = new Response();

$action = 'productos';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);
$controllerMarcas = new MarcasController($res);
$controllerProductos = new ProductosController($res);
$controllerAuth = new AuthController;


switch ($params[0]) {

    case 'productos':
        sessionAuthMiddleware($res);
        if (empty($params[1])) {
            $controllerProductos = new ProductosController($res);
            $controllerProductos->showProductos();
        } else {
            $id = $params[1];
            $controllerProductos = new ProductosController($res);
            $controllerProductos->showProductoById($id);
        }
        break;

    case 'marcas':
        sessionAuthMiddleware($res);
        if (empty($params[1])) {
            $controllerMarcas = new MarcasController($res);
            $controllerMarcas->showMarcas();
        } else {
            $marca = $params[1];
            $controllerMarcas = new MarcasController($res);
            $controllerMarcas->showProductosByMarca($marca);
        }
        break;

    case 'agregar-producto':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerProductos->addProducto();
        break;

    case 'eliminar-producto':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (empty($params[1])) {
            $controllerProductos->showError('Error al eliminar producto');
        } else {
            $id = $params[1];
            $controllerProductos->removeProducto($id);
        }
        break;

    case 'editar-producto':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (empty($params[1])) {
            $controllerProductos->showError('Producto no encontrado');
        } else if (empty($params[2])) {
            $id = $params[1];
            $controllerProductos->showFormEditar($id);
        } else {
            $id = $params[1];
            $controllerProductos->updateProducto($id);
        }
        break;

    case 'agregar-marca':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        $controllerMarcas->addMarca();
        break;

    case 'eliminar-marca':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (empty($params[1])) {
            $controllerMarcas->showError('Error al eliminar marca');
        } else {
            $id = $params[1];
            $controllerMarcas->removeMarca($id);
        }
        break;

    case 'editar-marca':
        sessionAuthMiddleware($res);
        verifyAuthMiddleware($res);
        if (empty($params[1])) {
            $controllerMarcas->showError('Marca no encontrada');
        } else if (empty($params[2])) {
            $id = $params[1];
            $controllerMarcas->showFormEditar($id);
        } else {
            $id = $params[1];
            $controllerMarcas->updateMarca($id);
        }
        break;
    
    case 'inicio-de-sesion':
        $controllerAuth->showLogin();
        break;

    case 'iniciar-sesion':
        $controllerAuth->login();
        break;

    case 'cerrar-sesion':
        $controllerAuth->logout();
        break;

    default:
        $controllerProductos->showError("Página no encontrada");
        break;
}
