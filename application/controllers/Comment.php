<?php

class Comment extends CI_Controller {
    
    public function __construct()
    {
        //ログインしていないと管理者一覧画面へ
        parent::__construct();
	if ($_SESSION['admin'] != true) {
            redirect('/admin/index?error=true');
        }	
    }
    /**
     * 目標一覧機能
     */
    public function index() {
        $member_id = $this->input->get('member_id');
        $objectives = $this->Comment_model->getObjectives($member_id);
        $data = ['objectives' => $objectives];
        $this->load->view('/comment/index', $data);
    }
    /**
     * コメント入力機能
     */
    public function add() {
        $this->load->view('/comment/add');
    }
    /**
     * ログアウト
     */
    public function logout()
    {
        unset($_SESSION['admin']);
        redirect('/member/index');
    }
}