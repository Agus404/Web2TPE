<?php

class LayoutView {

    function showError($msg){
        require 'templates/layout/header.phtml';
        require 'templates/error.phtml';
        require 'templates/layout/footer.phtml';
    }
}