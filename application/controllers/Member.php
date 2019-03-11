<?php
class Member extends CI_Controller {
    
    /**
     * 社員一覧ページ
     */   
    public function index()
    {
        $members = $this->Member_model->findAll();
        foreach($members as $member){
            //$member->department_id(オブジェクト)を関数の引数に直接指定するとエラーになるので一度変数(id1,id2)に代入しました
            $id1 = $member->department_id;
            $id2 = $member->position_id;
            //役職IDと部署IDに紐づいた役職名と部署名を取得
            $department_name = $this->Department_model->findById($id1);
            $position_name = $this->Position_model->findById($id2);
            //役職IDと部署IDに役職名と部署名を代入
            $member->department_id=$department_name;
            $member->position_id=$position_name;
        }
        $data = ['members' => $members];
        $this->load->view('/member/index', $data);
    }
    /**
     * 社員情報登録ページ
     */
    public function add()
    {
        //postされた値のバリデーションチェック
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_rules('member_id', '社員ID', 'required');
        $this->form_validation->set_rules('first_name', '氏', 'required');
        $this->form_validation->set_rules('last_name', '名', 'required');
        $this->form_validation->set_rules('first_name_kana', '氏（カタカナ）', 'required');
        $this->form_validation->set_rules('last_name_kana', '名（カタカナ）', 'required');
        $this->form_validation->set_rules('gender', '性別', 'required');
        $this->form_validation->set_rules('birthday', '生年月日', 'required|callback_birth_check');
        $this->form_validation->set_rules('home', '住所', 'required');
        $this->form_validation->set_rules('hire_date', '入社日', 'required|callback_birth_check');
        $this->form_validation->set_rules('department_id', '部署ID', 'required|callback_id_check');
        $this->form_validation->set_rules('position_id', '役職ID', 'required|callback_id_check');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        $this->form_validation->set_rules('sos', '緊急連絡先番号', 'required|callback_sos_check');

        //バリデーションエラーが無かった時データベースに保存し社員一覧画面へ
        if ($this->form_validation->run() === true) {
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
            $this->Member_model->insert($member_id, $first_name, $last_name, $first_name_kana,
                                        $last_name_kana, $gender, $birthday, $home, $hire_date,
                                        $department_id, $position_id, $email, $password, $sos);
            redirect('/member/index');
        //バリデーションエラーが有る時入力フォームに戻る
        } else {
            $this->load->view('/member/add');
        }   
    }   
    /**
     * 社員情報更新画面
     */
    public function update()
    {   
        //入力されたのバリデーションチェック
        $this->form_validation->set_message('required', '%s は必須です。');
        $this->form_validation->set_rules('first_name', '氏', 'required');
        $this->form_validation->set_rules('last_name', '名', 'required');
        $this->form_validation->set_rules('first_name_kana', '氏（カタカナ）', 'required');
        $this->form_validation->set_rules('last_name_kana', '名（カタカナ）', 'required');
        $this->form_validation->set_rules('gender', '性別', 'required');
        $this->form_validation->set_rules('birthday', '生年月日', 'required|callback_birth_check');
        $this->form_validation->set_rules('home', '住所', 'required');
        $this->form_validation->set_rules('hire_date', '入社日', 'required|callback_birth_check');
        $this->form_validation->set_rules('department_id', '部署ID', 'required|callback_id_check');
        $this->form_validation->set_rules('position_id', '役職ID', 'required|callback_id_check');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        $this->form_validation->set_rules('sos', '緊急連絡先番号', 'required|callback_sos_check');
        
        //バリデーションエラーが無かった時正常にデータ編集し社員一覧画面へ
        if ($this->form_validation->run() === true) {
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
            $this->Member_model->update($member_id, $first_name, $last_name, $first_name_kana,
                                        $last_name_kana, $gender, $birthday, $home, $hire_date,
                                        $department_id, $position_id, $email, $password, $sos);
            redirect('/member/index');
        //バリデーションエラーなら再度編集画面に
        } else { 
            $member_id = $this->input->get('member_id');
            $query = $this->Member_model->select($member_id);
            $row['data'] = $query->row_array();
            $this->load->view('/member/update', $row);
        }  
    }
    /**
     * 社員情報削除画面
     */
    public function delete()
    {
        $member_id = $this->input->get('member_id');
        $this->Member_model->delete($member_id);
        $this->load->view('/member/delete');
    }
    /**
     * ログインに成功すれば目標作成画面へ
     */
    public function login()
    {
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        if ($this->form_validation->run() === true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            //canLogInメソッドでemailとpasswordが正しければtrue
            $member_id = $this->Member_model->canLogIn($email, $password);
            $user_name = $this->Member_model->getUserName($member_id);
            //正しければログイン
            if (false != $member_id) {
                $_SESSION['login'] = true;
                $_SESSION['member_id'] = $member_id;
                $_SESSION['user_name'] = $user_name;
                redirect('/objective/index');
            } else {
                redirect('/member/login?error=true');
            }   
        } else {
        $this->load->view('/member/login');
        }
    }
    /**
     * ログアウト
     */
    public function logout()
    {
        unset($_SESSION['login']);
        redirect('/member/index');
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
    /**
     * 存在する部署、役職IDか確かめるバリデーション
     * @param type $number
     * @return boolean
     */
    public function id_check($key)
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
}
