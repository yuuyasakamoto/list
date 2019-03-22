<?php

/**
 * 管理者機能
 */
class Admin extends CI_Controller
{
    

    public function __construct()
    {
        //管理者ログインしていないとログイン画面に戻る
        parent::__construct();
	if ($_SESSION['admin'] != true) {
            redirect('/login/admin_login?admin_error=true');
        }
    }
    /**
     * 管理者一覧画面
     */        
    public function admin_index(){
        $admins = $this->Admin_model->findAdminAll();
        $data['admins'] = $admins;       
        $this->load->view('/admin/admin_index', $data);
    }
    /**
     * 管理者登録画面
     */
    public function admin_add(){
        //空白もしくはemailがusersテーブルに被りがあるとバリデーションエラー
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_message('is_unique', '他のユーザーが使用しているメールアドレスです');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|is_unique[admins.email]');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        $this->form_validation->set_rules('name', '名前', 'required');
        //バリデーションエラーが無ければ登録確認画面へ
        if ($this->form_validation->run() === true) {
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['name'] = $this->input->post('name');
            $this->load->view('/admin/admin_confirmation', $data);
        //バリデーションエラーが有れば入力画面に戻る
        } else {
            $this->load->view('/admin/admin_add');
        }  
    }
    /**
     * 管理者登録完了画面
     */
    public function admin_done()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $name = $this->input->post('name');
        //管理者情報の登録
        $this->Admin_model->insert($email, $password, $name); 
        //登録完了画面
        $this->load->view('/admin/admin_done');
    }
    
    /**
     * 社員一覧ページ
     */   
    public function member_index()
    {
        $members = $this->Member_model->findMemberAll();
        foreach($members as $member){
            //役職IDと部署IDに紐づいた役職名と部署名を取得
            $department_name = $this->Department_model->findById($member->department_id);
            $position_name = $this->Position_model->findById($member->position_id);
            $member->department_name = $department_name;
            $member->position_name = $position_name;
        }
        $data['members'] = $members;
        $this->load->view('/admin/member_index', $data);
    }
    /**
     * 社員情報登録画面
     */
    public function member_add()
    {
        //postされた値のバリデーションチェック
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_message('is_unique', '他のユーザーが使用している%sです');
        $this->form_validation->set_rules('member_id', '社員ID', 'required|is_unique[members.member_id]');
        $this->form_validation->set_rules('first_name', '氏', 'required');
        $this->form_validation->set_rules('last_name', '名', 'required');
        $this->form_validation->set_rules('first_name_kana', '氏（カタカナ）', 'required|callback_katakana_check');
        $this->form_validation->set_rules('last_name_kana', '名（カタカナ）', 'required|callback_katakana_check');
        $this->form_validation->set_rules('gender', '性別', 'required');
        $this->form_validation->set_rules('birthday', '生年月日', 'required|callback_birth_check');
        $this->form_validation->set_rules('home', '住所', 'required');
        $this->form_validation->set_rules('hire_date', '入社日', 'required|callback_birth_check');
        $this->form_validation->set_rules('department_id', '部署ID', 'required|callback_id_check');
        $this->form_validation->set_rules('position_id', '役職ID', 'required|callback_id_check');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|is_unique[members.email]');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        $this->form_validation->set_rules('sos', '緊急連絡先番号', 'required|callback_sos_check');
        //バリデーションエラーが無かった時登録確認画面へ
        if ($this->form_validation->run() === true) {
            $data['member_id'] = $this->input->post('member_id');
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['first_name_kana'] = $this->input->post('first_name_kana');
            $data['last_name_kana'] = $this->input->post('last_name_kana');
            $data['gender'] = $this->input->post('gender');
            $data['birthday'] = $this->input->post('birthday');
            $data['home'] = $this->input->post('home');
            $data['hire_date'] = $this->input->post('hire_date');
            $data['department_id'] = $this->input->post('department_id');
            $data['position_id'] = $this->input->post('position_id');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['sos'] = $this->input->post('sos');
            $this->load->view('/admin/member_confirmation', $data);
        //バリデーションエラーが有る時入力フォームに戻る
        } else {
            $this->load->view('/admin/member_add');
        }   
    } 
    /**
     * 社員情報登録完了ページ
     */
    public function member_done()
    {
        $member_id = $this->input->post('member_id');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $first_name_kana = $this->input->post('first_name_kana');
        $last_name_kana = $this->input->post('last_name_kana');
        $gender = $this->input->post('gender');
        $birthday = $this->input->post('birthday');
        $home = $this->input->post('home');
        $hire_date = $this->input->post('hire_date');
        $department_id = $this->input->post('department_id');
        $position_id = $this->input->post('position_id');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $sos = $this->input->post('sos');
        //社員情報の登録
        $this->Member_model->memberInsert($member_id, $first_name, $last_name, $first_name_kana,
                                    $last_name_kana, $gender, $birthday, $home, $hire_date,
                                    $department_id, $position_id, $email, $password, $sos);
        //登録完了画面
        $this->load->view('/admin/member_done');
    } 
     /**
     * 社員情報更新画面
     */
    public function member_update()
    {   
        //入力された値のバリデーションチェック
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_rules('first_name', '氏', 'required');
        $this->form_validation->set_rules('last_name', '名', 'required');
        $this->form_validation->set_rules('first_name_kana', '氏（カタカナ）', 'required|callback_katakana_check');
        $this->form_validation->set_rules('last_name_kana', '名（カタカナ）', 'required|callback_katakana_check');
        $this->form_validation->set_rules('gender', '性別', 'required');
        $this->form_validation->set_rules('birthday', '生年月日', 'required|callback_birth_check');
        $this->form_validation->set_rules('home', '住所', 'required');
        $this->form_validation->set_rules('hire_date', '入社日', 'required|callback_birth_check');
        $this->form_validation->set_rules('department_id', '部署ID', 'required|callback_id_check');
        $this->form_validation->set_rules('position_id', '役職ID', 'required|callback_id_check');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('sos', '緊急連絡先番号', 'required|callback_sos_check'); 
        //バリデーションエラーが無かった時確認画面へ
        if ($this->form_validation->run() === true) {
            $data['member_id'] = $this->input->post('member_id');
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['first_name_kana'] = $this->input->post('first_name_kana');
            $data['last_name_kana'] = $this->input->post('last_name_kana');
            $data['gender'] = $this->input->post('gender');
            $data['birthday'] = $this->input->post('birthday');
            $data['home'] = $this->input->post('home');
            $data['hire_date'] = $this->input->post('hire_date');
            $data['retirement_date'] = $this->input->post('retirement_date');
            $data['department_id'] = $this->input->post('department_id');
            $data['position_id'] = $this->input->post('position_id');
            $data['email'] = $this->input->post('email');
            $data['sos'] = $this->input->post('sos');
            $this->load->view('/admin/member_update_confirmation', $data);
        //バリデーションエラーなら再度編集画面に
        } else { 
            $member_id = $this->input->get('member_id');
            $member = $this->Member_model->select($member_id);
            $data['member'] = $member;
            $this->load->view('/admin/member_update', $data);
        }  
    }
    /**
     * 社員情報更新完了ページ
     */
    public function member_update_done()
    {
        $member_id = $this->input->post('member_id');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $first_name_kana = $this->input->post('first_name_kana');
        $last_name_kana = $this->input->post('last_name_kana');
        $gender = $this->input->post('gender');
        $birthday = $this->input->post('birthday');
        $home = $this->input->post('home');
        $hire_date = $this->input->post('hire_date');
        $retirement_date = $this->input->post('retirement_date');
        $department_id = $this->input->post('department_id');
        $position_id = $this->input->post('position_id');
        $email = $this->input->post('email');
        $sos = $this->input->post('sos');
        //社員情報の更新(管理者による)
        $this->Member_model->update($member_id, $first_name, $last_name, $first_name_kana,
                                    $last_name_kana, $birthday, $home, $email, $sos, $gender,
                                    $hire_date, $retirement_date, $department_id, $position_id);
        //更新完了画面
        $this->load->view('/admin/member_done');
    } 
    /**
     * 社員情報削除画面
     */
    public function member_delete()
    {
        $member_id = $this->input->get('member_id');
        $this->Member_model->delete($member_id);
        $this->load->view('/admin/member_delete');
    }
    /**
     * 1990-01-01の形式になっているかのバリデーション
     * @param type $str
     * @return boolean
     */
    public function birth_check(string $str)
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
    /**
     * 存在する部署、役職IDか確かめるバリデーション
     * @param type $number
     * @return boolean
     */
    public function id_check(int $key)
    {
        $check = preg_match("/^[1-7]$/", $key);
        if ($check == true)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('id_check', '正しい%s を記入して下さい');
            return false;
        }
    }
    /**
     * カタカナになっているかチェック
     * @param string $katakana
     * @return boolean
     */
    public function katakana_check(string $katakana)
    {
        $check = preg_match("/^[ァ-ヾ]+$/u", $katakana);
        if ($check == true)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('katakana_check', 'カタカナで記入して下さい');
            return false;
        }
    }
}
    
