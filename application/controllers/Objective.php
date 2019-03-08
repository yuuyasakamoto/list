<?php
class Objective extends CI_Controller {
    
    /**
     * ログイン確認
     */
    public function __construct()
    {
        parent::__construct();
	//if ($_SESSION['login'] != true) {
            //redirect('/login/index');
        //}	
    }
    public function index()
    {
        
    }
}