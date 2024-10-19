<?php
require_once './app/models/usuarios.model.php';
require_once './app/views/auth.view.php';

class AuthController{

    private $model;
    private $view;

    public function __construct() {
        $this->model = new UsuariosModel;
        $this->view = new AuthView;
    }

    function showLogin() {
        return $this->view->showLogin();
    }

    function login(){
        if (!isset($_POST['username']) || empty($_POST['username'])) {
            return $this->view->showLogin('Falta completar el nombre de usuario');
        }
    
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Falta completar la contraseña');
        }
    
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $userFromDB = $this->model->getUserByUsername($username);

        if($userFromDB && password_verify($password, $userFromDB->password)){
            session_start();
            $_SESSION['id_usuario'] = $userFromDB->id_usuario;
            $_SESSION['nombre_usuario'] = $userFromDB->nombre_usuario;
            header('Location: ' . BASE_URL);
        } else {
            return $this->view->showLogin('Credenciales incorrectas');
        }

    }

    function logout(){
            session_start();
            session_destroy();
            header('Location: ' . BASE_URL);
    }

}