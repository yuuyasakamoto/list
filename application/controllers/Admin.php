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
            redirect('/login/admin?admin_error=true');
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
        $this->form_validation->set_message('valid_email', 'Emailの形式で記入してください');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|is_unique[admins.email]|valid_email');
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
        $this->form_validation->set_message('valid_email', 'Emailの形式で記入してください');
        $this->form_validation->set_message('min_length', '固定電話もしくは携帯番号を入力してください');
        $this->form_validation->set_message('max_length', '固定電話もしくは携帯番号を入力してください');
        $this->form_validation->set_rules('member_id', '社員ID', 'required|is_unique[members.member_id]');
        $this->form_validation->set_rules('first_name', '氏', 'required');
        $this->form_validation->set_rules('last_name', '名', 'required');
        $this->form_validation->set_rules('first_name_kana', '氏（カタカナ）', 'required|callback_katakana_check');
        $this->form_validation->set_rules('last_name_kana', '名（カタカナ）', 'required|callback_katakana_check');
        $this->form_validation->set_rules('gender', '性別', 'required');
        $this->form_validation->set_rules('year', '年', 'required');
        $this->form_validation->set_rules('month', '月', 'required');
        $this->form_validation->set_rules('day', '日', 'required');
        $this->form_validation->set_rules('hire_year', '入社年', 'required');
        $this->form_validation->set_rules('hire_month', '入社月', 'required');
        $this->form_validation->set_rules('hire_day', '入社日', 'required');
        $this->form_validation->set_rules('home', '住所', 'required');
        $this->form_validation->set_rules('department_id', '部署名の選択', 'required');
        $this->form_validation->set_rules('position_id', '役職名の選択', 'required');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|is_unique[members.email]|valid_email');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        $this->form_validation->set_rules('sos', '緊急連絡先番号', 'required|min_length[10]|max_length[11]');
        //バリデーションエラーが無かった時登録確認画面へ
        if ($this->form_validation->run() === true) {
            $data['member_id'] = $this->input->post('member_id');
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['first_name_kana'] = $this->input->post('first_name_kana');
            $data['last_name_kana'] = $this->input->post('last_name_kana');
            $data['gender'] = $this->input->post('gender');
            //生年月日の作成
            $year = $this->input->post('year');
            $month = $this->input->post('month');
            $day = $this->input->post('day');
            $data['birthday'] = $year.$month.$day;
            $data['home'] = $this->input->post('home');
            //入社日の作成
            $hire_year = $this->input->post('hire_year');
            $hire_month = $this->input->post('hire_month');
            $hire_day = $this->input->post('hire_day');
            $data['hire_date'] = $hire_year.$hire_month.$hire_day;
            $data['department_id'] = $this->input->post('department_id');
            //投稿されたIDをもとに部署名取得
            $data['department_name'] = $this->Department_model->findById($data['department_id']);
            $data['position_id'] = $this->input->post('position_id');
            //投稿されたIDをもとに役職名取得
            $data['position_name'] = $this->Position_model->findById($data['position_id']);
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['sos'] = $this->input->post('sos');
            $this->load->view('/admin/member_confirmation', $data);
        //バリデーションエラーが有る時入力フォームに戻る
        } else {
            $data['departments'] = $this->Department_model->findDepartmentAll();
            $data['positions'] = $this->Position_model->findPositionAll();
            $this->load->view('/admin/member_add', $data);
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
        $this->form_validation->set_message('valid_email', 'Emailの形式で記入してください');
        $this->form_validation->set_message('min_length', '固定電話もしくは携帯番号を入力してください');
        $this->form_validation->set_message('max_length', '固定電話もしくは携帯番号を入力してください');
        $this->form_validation->set_rules('first_name', '氏', 'required');
        $this->form_validation->set_rules('last_name', '名', 'required');
        $this->form_validation->set_rules('first_name_kana', '氏（カタカナ）', 'required|callback_katakana_check');
        $this->form_validation->set_rules('last_name_kana', '名（カタカナ）', 'required|callback_katakana_check');
        $this->form_validation->set_rules('gender', '性別', 'required');
        $this->form_validation->set_rules('year', '年', 'required');
        $this->form_validation->set_rules('month', '月', 'required');
        $this->form_validation->set_rules('day', '日', 'required');
        $this->form_validation->set_rules('hire_year', '入社年', 'required');
        $this->form_validation->set_rules('hire_month', '入社月', 'required');
        $this->form_validation->set_rules('hire_day', '入社日', 'required');
        $this->form_validation->set_rules('home', '住所', 'required');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|valid_email');
        $this->form_validation->set_rules('sos', '緊急連絡先番号', 'required|min_length[10]|max_length[11]'); 
        //退職日のバリデーションチェック
        $year = $this->input->post('retirement_year');
        $month = $this->input->post('retirement_month');
        $day = $this->input->post('retirement_day');
        $_POST['retirement'] = $year.$month.$day;
        $this->form_validation->set_rules('retirement', '退職日', 'callback_retirement_date_check');
        //バリデーションエラーが無かった時確認画面へ
        if ($this->form_validation->run() === true) {
            $data['member_id'] = $this->input->post('member_id');
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['first_name_kana'] = $this->input->post('first_name_kana');
            $data['last_name_kana'] = $this->input->post('last_name_kana');
            $data['gender'] = $this->input->post('gender');
            //生年月日の作成
            $year = $this->input->post('year');
            $month = $this->input->post('month');
            $day = $this->input->post('day');
            $data['birthday'] = $year.$month.$day;
            //入社日の作成
            $hire_year = $this->input->post('hire_year');
            $hire_month = $this->input->post('hire_month');
            $hire_day = $this->input->post('hire_day');
            $data['hire_date'] = $hire_year.$hire_month.$hire_day;
            $data['home'] = $this->input->post('home');
            $data['retirement_date'] = $_POST['retirement'];
            $data['department_id'] = $this->input->post('department_id');
            //投稿されたIDをもとに部署名取得
            $data['department_name'] = $this->Department_model->findById($data['department_id']);
            $data['position_id'] = $this->input->post('position_id');
            //投稿されたIDをもとに役職名取得
            $data['position_name'] = $this->Position_model->findById($data['position_id']);
            $data['email'] = $this->input->post('email');
            $data['sos'] = $this->input->post('sos');
            $this->load->view('/admin/member_update_confirmation', $data);
        //バリデーションエラーなら再度編集画面に
        } else { 
            $member_id = $this->input->get('member_id');
            $member = $this->Member_model->select($member_id);
            $data['member'] = $member;
            $data['departments'] = $this->Department_model->findDepartmentAll();
            $data['positions'] = $this->Position_model->findPositionAll();
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
    
    /**
     * 退職日のチェック（0000-00-00の形式か未記入か）
     * @param string $retirement_date
     * @return boolean
     */
    public function retirement_date_check(string $retirement_date)
    {
        $check = preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $retirement_date);
        if ($check == true || $retirement_date == "") {
            return true;
        } else {
            $this->form_validation->set_message('retirement_date_check', '退職日が正しくありません');
            return false;
        }
    }
}
    
