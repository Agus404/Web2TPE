<?php

class LayoutView {

    function showError($msg){
        require 'templates/layout/header.phtml';
        require 'templates/error.phtml';
        // echo "<h1> ERROR </h1>";
        // echo "<h2>$msg</h2";
        require 'templates/layout/footer.phtml';
    }
}