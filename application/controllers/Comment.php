<?php

class Comment extends CI_Controller 
{
    
    public function __construct()
    {
        //管理者ログインしていないと管理者ログイン画面（getパラメーターを付けて）
        parent::__construct();
	if ($_SESSION['admin'] != true) {
            redirect('/login/admin?admin_error=true');
        }	
    }
    /**
     * 目標一覧機能
     */
    public function index() {
        $member_id = $this->input->get('member_id');
        $objectives = $this->Objective_model->select($member_id);
        $data['objectives'] = $objectives;
        $this->load->view('/comment/index', $data);
    }
    /**
     * 目標内容閲覧画面
     */
    public function contents() {
        $objective_id = $this->input->get('objective_id');
        $data['content'] = $this->Objective_model->getContent($objective_id);
        $this->load->view('/comment/contents', $data);
    }
    /**
     * 目標に対するコメント入力機能
     */
    public function add() {
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_message('min_length', '最低10字はお書きください。');
        $this->form_validation->set_message('max_length', 'コメントは100字程度でお願い致します。');
        $this->form_validation->set_rules('comment', 'コメント', 'required|min_length[10]|max_length[150]');
        //バリデーションエラーが無ければ確認画面へ
        if ($this->form_validation->run() === true) {
            $data['comment'] = $this->input->post('comment');
            $data['objective_id'] = $this->input->post('objective_id');
            $this->load->view('/comment/confirmation', $data);
        //バリデーションエラーがあればもう一度入力画面
        } else {
            $objective_id = $this->input->get('objective_id');
            $data['objective'] = $this->Objective_model->getContent($objective_id);
            $this->load->view('/comment/add', $data);
        }
    }
    /**
     * 目標に対するコメント入力完了機能
     */
    public function done() {
        $comment = $this->input->post('comment');
        $admin_id = $_SESSION['id'];
        $objective_id = $this->input->post('objective_id');
        $this->Comment_model->insert($comment, $admin_id, $objective_id);
        $this->load->view('/comment/done');
    }
}