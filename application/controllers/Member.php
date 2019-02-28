<?php
class Member extends CI_Controller {
    
    /**
     * ログイン確認
     */
    public function __construct()
    {
        parent::__construct();
	if ($_SESSION['login'] != true) {
            redirect('/login/index');
        }	
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
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_rules('first_name', '氏', 'required');
        $this->form_validation->set_rules('last_name', '名', 'required');
        $this->form_validation->set_rules('birthday', '生年月日', 'required|callback_birth_check');
        $this->form_validation->set_rules('home', '出身地', 'required');
       
        //バリデーションエラーが無かった時正常にデータベースに反映
        if ($this->form_validation->run() === true) {
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $birthday = $this->input->post('birthday');
            $home = $this->input->post('home');
            $this->Member_model->insert($first_name, $last_name, $birthday, $home);
            redirect('/member/index');
        //バリデーションエラーが有る時入力フォームに戻る
        } else {
            $this->load->view('/member/add');
        }   
    }   
    /**
     * 社員情報更新画面
     */
    public function updata()
    {   
        //入力された値が空白かチェック
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_rules('first_name', '氏', 'required');
        $this->form_validation->set_rules('last_name', '名', 'required');
        $this->form_validation->set_rules('birthday', '生年月日', 'required|callback_birth_check');
        $this->form_validation->set_rules('home', '出身地', 'required');
        
        //バリデーションエラーが無かった時正常にデータベース編集
        if ($this->form_validation->run() === true) {
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $birthday = $this->input->post('birthday');
            $home = $this->input->post('home');
            $id = $this->input->post('id');
            $this->Member_model->updata($first_name, $last_name, $birthday, $home, $id);
            redirect('/member/index');
        //バリデーションエラーが有ったら編集フォームに戻る
        } else { 
            $id = $this->input->get('id');
            $query = $this->Member_model->select($id);
            $row['data'] = $query->row_array();
            $this->load->view('/member/updata', $row);       
        }   
    }
    /**
     * 社員情報削除画面
     */
    public function delete()
    {
        $id = $this->input->get('id');
        $this->Member_model->delete($id);
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
        $check = preg_match("/\d{4}\/\d{2}\/\d{2}/", $str);
        if ($check == true)
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('birth_check', '1990/01/01の形式で入力してください');
            return false;
        }
    }
}
