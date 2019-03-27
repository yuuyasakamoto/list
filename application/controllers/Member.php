<?php

/**
 * 社員機能
 */
class Member extends CI_Controller 
{
    
    public function __construct()
    {
        //社員ログインしていないと社員ログイン画面に戻る
        parent::__construct();
	if ($_SESSION['login'] != true) {
            redirect('/login/member?member_error=true');
        }	
    }
    /**
     * 社員情報閲覧ページ
     */   
    public function index()
    {
        //社員IDに紐づいた社員情報取得
        $member = $this->Member_model->select($_SESSION['member_id']);
        //役職IDと部署IDに紐づいた役職名と部署名を取得
        $department_name = $this->Department_model->findById($member->department_id);
        $position_name = $this->Position_model->findById($member->position_id);
        $member->department_name = $department_name;
        $member->position_name = $position_name;
        $data['member'] = $member;
        $this->load->view('/member/index', $data);
    }
    /**
     * 社員が自分の情報更新画面
     */
    public function update()
    {   
        //入力された値のバリデーションチェック
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_message('valid_email', 'Emailの形式で記入してください');
        $this->form_validation->set_message('min_length', '固定電話もしくは携帯番号を入力してください');
        $this->form_validation->set_message('max_length', '固定電話もしくは携帯番号を入力してください');
        $this->form_validation->set_rules('first_name', '氏', 'required');
        $this->form_validation->set_rules('last_name', '名', 'required');
        $this->form_validation->set_rules('first_name_kana', '氏（カタカナ）', 'required|callback_katakana_check');
        $this->form_validation->set_rules('last_name_kana', '名（カタカナ）', 'required|callback_katakana_check');
        $this->form_validation->set_rules('year', '年', 'required');
        $this->form_validation->set_rules('month', '月', 'required');
        $this->form_validation->set_rules('day', '日', 'required');
        $this->form_validation->set_rules('home', '住所', 'required');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|valid_email');
        $this->form_validation->set_rules('sos', '緊急連絡先番号', 'required|min_length[10]|max_length[11]');
        //バリデーションエラーが無かった時確認画面へ
        if ($this->form_validation->run() === true) {
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['first_name_kana'] = $this->input->post('first_name_kana');
            $data['last_name_kana'] = $this->input->post('last_name_kana');
            //生年月日の作成
            $year = $this->input->post('year');
            $month = $this->input->post('month');
            $day = $this->input->post('day');
            $data['birthday'] = $year.$month.$day;
            $data['home'] = $this->input->post('home');
            $data['email'] = $this->input->post('email');
            $data['sos'] = $this->input->post('sos');
            $this->load->view('/member/confirmation', $data);
        //バリデーションエラーなら再度編集画面に
        } else { 
            $member = $this->Member_model->select($_SESSION['member_id']);
            $data['member'] = $member;
            $this->load->view('/member/update', $data);
        }  
    }
    /**
     * 社員が自分の情報更新確認画面
     */
    public function done()
    {   
        $member_id = $_SESSION['member_id'];
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $first_name_kana = $this->input->post('first_name_kana');
        $last_name_kana = $this->input->post('last_name_kana');
        $birthday = $this->input->post('birthday');
        $home = $this->input->post('home');
        $email = $this->input->post('email');
        $sos = $this->input->post('sos');
        //社員のデータ取得
        $member = $this->Member_model->select($member_id);
        $gender = $member->gender;
        $hire_date = $member->hire_date;
        $retirement_date = $member->retirement_date;
        $department_id = $member->department_id;
        $position_id = $member->position_id;
        $this->Member_model->update($member_id, $first_name, $last_name, $first_name_kana,
                                    $last_name_kana, $birthday, $home, $email, $sos, $gender,
                                    $hire_date, $retirement_date, $department_id, $position_id);
        $this->load->view('/member/done');
    }
    /**
     * カタカナになっているかチェック
     * @param string $katakana
     * @return boolean
     */
    public function katakana_check(string $katakana)
    {
        $check = preg_match("/^[ァ-ヾ]+$/u", $katakana);
        if ($check == true) {
            return true;
        } else {
            $this->form_validation->set_message('katakana_check', '全角カタカナで記入して下さい');
            return false;
        }
    }
}