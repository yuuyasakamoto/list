<?php

/**
 * 部署機能
 */
class Department extends CI_Controller
{
   
    public function __construct()
    {
        //管理者ログインしていないとログイン画面に戻る
        parent::__construct();
	if ($_SESSION['admin'] != true) {
            redirect('/login/admin?admin_error=true');
        }
    }
    /**
     * 部署一覧画面
     */        
    public function index(){
        $data['departments'] = $this->Department_model->findDepartmentAll();
        $this->load->view('/department/index', $data);
    }
    /**
     * 新部署作成画面
     */
    public function add()
    {
        //バリデーションエラーが無ければ部署名確認画面へ
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_rules('name', '部署名の記入', 'required');
        if ($this->form_validation->run() === true) {
            $data['name'] = $this->input->post('name');
            $this->load->view('/department/add_confirmation', $data);
        //バリデーションエラーだと部署新規登録画面へ
        } else {
            $this->load->view('/department/add');
        }
    }
    /**
     * 新部署登録完了画面
     */
    public function add_done()
    {
        $name = $this->input->post('name');
        //管理者情報の登録
        $this->Department_model->insert($name); 
        //登録完了画面
        $this->load->view('/department/add_done');
    }
    /**
     * 部署名変更機能
     */
    public function update()
    {
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_rules('name', '部署名の入力', 'required');
        //バリデーションエラーが無かった時確認画面へ
        if ($this->form_validation->run() === true) {
            $data['id'] = $this->input->post('id');
            $data['name'] = $this->input->post('name');
            $this->load->view('/department/update_confirmation', $data);
        } else {
            $data['id'] = $this->input->get('id');
            $data['name'] = $this->input->get('name');
            $this->load->view('/department/update', $data);
        }
    }
    /**
     * 部署変更完了画面
     */
    public function update_done()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        //部署情報の更新
        $this->Department_model->update($id, $name); 
        //部署変更完了画面
        $this->load->view('/department/update_done');
    }
    /**
     * 部署削除画面
     */
    public function delete()
    {
        $id = $this->input->get('id');
        $this->Department_model->delete($id);
        $this->load->view('/department/delete');
    }
}