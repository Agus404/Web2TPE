<?php

class AuthView {
    private $user;
    public function showLogin($error = '') {
        require 'templates/layout/header.phtml';
        require 'templates/form_login.phtml';
        require 'templates/layout/footer.phtml';
    }
}
