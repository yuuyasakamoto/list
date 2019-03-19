<?php

/**
 * 社員機能
 */
class Member extends CI_Controller {
    
    public function __construct()
    {
        //社員ログインしていないと社員ログイン画面に戻る
        parent::__construct();
	if ($_SESSION['login'] != true) {
        redirect('/login/member_login?member_error=true');
        }	
    }
    /**
     * 社員情報閲覧ページ
     */   
    public function index()
    {
        $member_id = $_SESSION['member_id'];
        //社員IDに紐づいた社員情報取得
        $member = $this->Member_model->find($member_id);
        //役職IDと部署IDに紐づいた役職名と部署名を取得
        $department_name = $this->Department_model->findById($member->department_id);
        $position_name = $this->Position_model->findById($member->position_id);
        $member->department_name = $department_name;
        $member->position_name = $position_name;
        $data = ['member' => $member];
        $this->load->view('/member/index', $data);
    }
    /**
     * 社員が自分の情報更新画面
     */
    public function update()
    {   
        //入力されたのバリデーションチェック
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_rules('first_name', '氏', 'required');
        $this->form_validation->set_rules('last_name', '名', 'required');
        $this->form_validation->set_rules('first_name_kana', '氏（カタカナ）', 'required');
        $this->form_validation->set_rules('last_name_kana', '名（カタカナ）', 'required');
        $this->form_validation->set_rules('birthday', '生年月日', 'required|callback_birth_check');
        $this->form_validation->set_rules('home', '住所', 'required');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        $this->form_validation->set_rules('sos', '緊急連絡先番号', 'required|callback_sos_check');
        
        //バリデーションエラーが無かった時確認画面へ
        if ($this->form_validation->run() === true) {
            $data['member_id'] = $this->input->post('member_id');
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['first_name_kana'] = $this->input->post('first_name_kana');
            $data['last_name_kana'] = $this->input->post('last_name_kana');
            $data['birthday'] = $this->input->post('birthday');
            $data['home'] = $this->input->post('home');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['sos'] = $this->input->post('sos');
            $this->load->view('/member/confirmation', $data);
        //バリデーションエラーなら再度編集画面に
        } else { 
            $member_id = $this->input->get('member_id');
            $query = $this->Member_model->select($member_id);
            $row['data'] = $query->row_array();
            $this->load->view('/member/update', $row);
        }  
    }
    /**
     * 社員が自分の情報更新確認画面
     */
    public function done()
    {   
            $member_id = $this->input->post('member_id');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $first_name_kana = $this->input->post('first_name_kana');
            $last_name_kana = $this->input->post('last_name_kana');
            $gender = $this->input->post('gender');
            $birthday = $this->input->post('birthday');
            $home = $this->input->post('home');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $sos = $this->input->post('sos');
            $this->Member_model->memberUpdate($member_id, $first_name, $last_name, $first_name_kana,
                                        $last_name_kana, $birthday, $home, 
                                        $email, $password, $sos);
            $this->load->view('/member/done');
    }
    
    /**
     * 1990-01-01の形式になっているかのバリデーション
     * @param type $str
     * @return boolean
     */
    public function birth_check($str)
    {
        $check = preg_match("/\d{4}\-\d{2}\-\d{2}/", $str);
        if ($check == true)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('birth_check', '1990-01-01の形式で入力してください');
            return false;
        }
    }
    /**
     * ハイフンなしの半角数字のみで記入しているかのバリデーション（緊急連絡先）
     * @param type $str
     * @return boolean
     */
    public function sos_check($number)
    {
        $check = preg_match("/^[0-9]+$/", $number);
        if ($check == true)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('sos_check', '半角数字のみで記入して下さい');
            return false;
        }
    }
}