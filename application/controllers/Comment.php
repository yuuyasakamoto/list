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
     * 目標内容閲覧画面
     */
    public function contents() {
        $member_id = $this->input->get('member_id');
        $created = $this->input->get('created');
        $data['contents'] = $this->Comment_model->getContents($member_id, $created);
        $this->load->view('/comment/contents', $data);
    }
    /**
     * 目標に対するコメント入力機能
     */
    public function add() {
        $this->form_validation->set_message('required', 'コメントお願いします。');
        $this->form_validation->set_rules('comment', 'コメント', 'required');
        if ($this->form_validation->run() === true) {
            $comment = $this->input->post('comment');
            $admin_id = $this->input->post('admin_id');
            $objective_id = $this->input->post('objective_id');
            $this->Comment_model->insert($comment, $admin_id, $objective_id);
            $this->load->view('/comment/done');
        } else {
        $this->load->view('/comment/add');
        }
    }
    /**
     * ログアウト
     */
    public function logout()
    {
        unset($_SESSION['admin']);
        unset($_SESSION['id']);
        redirect('/member/index');
    }
}