<?php
class Member extends CI_Controller {
    
    /**
     * ログイン確認
     */
    public function __construct()
    {
        parent::__construct();
	//if ($_SESSION['login'] != true) {
            //redirect('/login/index');
        //}	
    }

    /**
     * 社員一覧ページ
     */   
    public function index()
    {
        $result = $this->Member_model->findAll();
        $data = ['members' => $result];
        $this->load->view('/member/index', $data);
    }
    /**
     * 社員情報登録ページ
     */
    public function add()
    {
        //postされた値が空白かどうかのバリデーションチェック
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

        //バリデーションエラーが無かった時正常にデータベースに反映
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
        //入力された値が空白かチェック
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
        
        //バリデーションエラーが無かった時正常にデータベース編集
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
        //バリデーションにかかったら編集画面に
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
     * ログアウト
     */
    public function logout()
    {
        unset($_SESSION['login']);
        redirect('/user/index');
    }
    /**
     * 生年月日の独自バリデーション
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
     * 緊急連絡先のバリデーション
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
     * IDのバリデーション（IDが存在するか確かめる）
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
