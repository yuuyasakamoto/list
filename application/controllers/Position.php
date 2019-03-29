<?php

/**
 * 役職機能
 */
class Position extends CI_Controller
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
     * 役職一覧画面
     */        
    public function index(){
        $data['positions'] = $this->Position_model->findPositionAll();
        $this->load->view('/position/index', $data);
    }
    /**
     * 新役職作成画面
     */
    public function add()
    {
        //バリデーションエラーが無ければ役職名確認画面へ
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_rules('name', '役職名の記入', 'required');
        if ($this->form_validation->run() === true) {
            $data['name'] = $this->input->post('name');
            $this->load->view('/position/add_confirmation', $data);
        //バリデーションエラーだと役職新規登録画面へ
        } else {
            $this->load->view('/position/add');
        }
    }
    /**
     * 新役職登録完了画面
     */
    public function add_done()
    {
        $name = $this->input->post('name');
        //新役職情報の登録
        $this->Position_model->insert($name); 
        //登録完了画面
        $this->load->view('/position/add_done');
    }
    /**
     * 役職名変更機能
     */
    public function update()
    {
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_rules('name', '役職名の入力', 'required');
        //バリデーションエラーが無かった時確認画面へ
        if ($this->form_validation->run() === true) {
            $data['id'] = $this->input->post('id');
            $data['name'] = $this->input->post('name');
            $this->load->view('/position/update_confirmation', $data);
        } else {
            $data['id'] = $this->input->get('id');
            $data['name'] = $this->input->get('name');
            $this->load->view('/position/update', $data);
        }
    }
    /**
     * 役職変更完了画面
     */
    public function update_done()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        //役職情報の更新
        $this->Position_model->update($id, $name); 
        //役職変更完了画面
        $this->load->view('/position/update_done');
    }
    /**
     * 部署削除画面
     */
    public function delete()
    {
        $id = $this->input->get('id');
        $this->Position_model->delete($id);
        $this->load->view('/position/delete');
    }
}
