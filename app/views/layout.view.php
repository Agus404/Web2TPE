<?php

class LayoutView {
    
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    function showError($msg){
        require 'templates/layout/header.phtml';
        require 'templates/error.phtml';
        require 'templates/layout/footer.phtml';
    }
}