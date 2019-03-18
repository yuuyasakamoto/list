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
     * 四半期と年度の確認
     */
    public function add()
    {
        //バリデーションエラーが無ければ目標内容投稿へ
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_rules('quarter', '第何半期かの選択', 'required');
        if ($this->form_validation->run() === true) {
            $year = $this->input->post('year');
            $quarter = $this->input->post('quarter');
            $member_id = $this->input->post('member_id');
            //年度と四半期が一致するデータが存在すればそのデータ内容を目標内容に表示
            $data = $this->Objective_model->select($member_id, $year, $quarter);
            $this->load->view('/objective/post', $data);
        //バリデーションエラーだともう一度年度、四半期入力画面へ
        } else {
            $this->load->view('/objective/add');
        }
    }
    /**
     * 目標投稿確認ページ
     */
    public function done()
    {
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_message('min_length', '最低30字はお書きください。');
        $this->form_validation->set_message('max_length', '目標は500字程度でお願い致します。');
        $this->form_validation->set_rules('objective', '目標内容', 'required|min_length[30]|max_length[600]');
        //バリデーションエラーが無ければ投稿内容確認画面へ
        if ($this->form_validation->run() === true) {
            $data['year'] = $this->input->post('year');
            $data['quarter'] = $this->input->post('quarter');
            $data['member_id'] = $_SESSION['member_id'];
            $data['objective'] = $this->input->post('objective');
            $this->load->view('/objective/post_confirmation', $data);
        //バリデーションエラーだともう一度目標入力画面へ
        } else {
            $this->load->view('/objective/post');
        }
    }  
     /**
     * 目標投稿完了ページ
     */
    public function post_done()
    {
            $year = $this->input->post('year');
            $quarter = $this->input->post('quarter');
            $member_id = $_SESSION['member_id'];
            $objective = $this->input->post('objective');
            $data = $this->Objective_model->insert($member_id, $year, $quarter, $objective);
            $this->load->view('/objective/done');
       
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
        $this->form_validation->set_message('min_length', '最低30字はお書きください。');
        $this->form_validation->set_message('max_length', '目標は500字程度でお願い致します。');
        $this->form_validation->set_rules('quarter', '第何半期かの選択', 'required');
        $this->form_validation->set_rules('objective', '目標内容', 'required|min_length[30]|max_length[600]');
        //バリデーションエラーが無ければ確認画面へ
        if ($this->form_validation->run() === true) {
            $data['year'] = $this->input->post('year');
            $data['quarter'] = $this->input->post('quarter');
            $data['objective'] = $this->input->post('objective');
            $data['member_id'] = $this->input->post('member_id');
            $data['objective_id'] = $this->input->post('objective_id');
            $this->load->view('/objective/update_confirmation', $data);
        //バリデーションエラーだともう一度目標入力画面へ
        } else {
            $objective_id = $this->input->get('objective_id');
            $data['contents'] = $this->Comment_model->getContents($objective_id);
            $this->load->view('/objective/update', $data);
        }  
    }
     /**
     * 目標内容編集完了画面
     */
     public function update_done()
    {   
            $year = $this->input->post('year');
            $quarter = $this->input->post('quarter');
            $objective = $this->input->post('objective');
            $member_id = $this->input->post('member_id');
            $objective_id = $this->input->post('objective_id');
            $this->Objective_model->update($member_id, $year, $quarter, $objective, $objective_id);
            $this->load->view('/objective/done');
    }
}