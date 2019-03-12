<?php
class Objective extends CI_Controller {
    
    /**
     * ログイン確認
     */
    public function __construct()
    {
        //ログインしていないとログインページへ
        parent::__construct();
	if ($_SESSION['login'] != true) {
            redirect('/member/index');
        }	
    }
    /**
     * 目標投稿ページ
     */
    public function index()
    {
        //各バリデーションエラーに引っ掛からなかったら目標テーブルに保存し完了画面に
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_message('min_length', '最低50字はお書きください。');
        $this->form_validation->set_message('max_length', '目標は500字程度でお願い致します。');
        $this->form_validation->set_rules('quarter', '第何半期かの選択', 'required');
        $this->form_validation->set_rules('objective', '目標内容', 'required|min_length[50]|max_length[600]');
        if ($this->form_validation->run() === true) {
            $year = $this->input->post('year');
            $quarter = $this->input->post('quarter');
            $objective = $this->input->post('objective');
            $member_id = $this->input->post('member_id');
            $this->Objective_model->insert($member_id, $year, $quarter, $objective);
            $this->load->view('/objective/done');
        //バリデーションエラーだともう一度投稿画面へ
        } else {
            $this->load->view('/objective/index');
        }
    }
}