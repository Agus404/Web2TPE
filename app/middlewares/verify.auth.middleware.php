<?php
    function verifyAuthMiddleware($res) {
        if($res->usuario) {
            return;
        } else {
            header('Location: ' . BASE_URL . 'inicio-de-sesion');
            die();
        }
    }
?>
