<?php
class Objective extends CI_Controller {
    
    /**
     * ログイン確認
     */
    public function __construct()
    {
        //社員ログインしていないと社員ログイン画面へ
        parent::__construct();
	if ($_SESSION['login'] != true) {
            redirect('/top/member_login?member_error=true');
        }
    }
    /**
     * 目標閲覧ページ
     */
     public function index()
    {
        $member_id = $_SESSION['member_id'];
        $objectives = $this->Comment_model->getObjectives($member_id);
        $data = ['objectives' => $objectives];
        $this->load->view('/objective/index', $data);
    }  
    /**
     * 目標投稿ページ
     */
    public function add()
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
        //バリデーションエラーだともう一度目標入力画面へ
        } else {
            $this->load->view('/objective/add');
        }
    }
    /**
     * 目標内容閲覧ページ
     */
     public function contents()
    {
        $objective_id = $this->input->get('objective_id');
        $data['contents'] = $this->Comment_model->getContents($objective_id);
        $this->load->view('/objective/contents', $data);
    } 
    /**
     * 目標内容編集ページ
     */
     public function update()
    {   
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
            $objective_id = $this->input->post('objective_id');
            $this->Objective_model->update($member_id, $year, $quarter, $objective, $objective_id);
            $this->load->view('/objective/done');
        //バリデーションエラーだともう一度目標入力画面へ
        } else {
            $objective_id = $this->input->get('objective_id');
            $data['contents'] = $this->Comment_model->getContents($objective_id);
            $this->load->view('/objective/update', $data);
        }  
    }
}