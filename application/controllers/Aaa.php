<?php

class Aaa extends CI_Controller {
    
    
    public function index() {
        $_SESSION['test'] = "test" ;
        echo $_SESSION['test'];
    }
}
