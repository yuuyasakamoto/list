<?php

class Comment extends CI_Controller {
    
    /**
     * コメント一覧機能
     */
    public function index() {
        $result = $this->Comment_model->findAll();
        $data = ['comments' => $result];
        $this->load->view('/comment/index', $data);
    }
    /**
     * コメント入力機能
     */
    public function add() {
        $this->load->view('/comment/add');
    }
    /**
     * Postされたタイトルとコメントをデータに反映させる
     */
    public function insert()
    {
        $title = $this->input->post('title');
        $comment = $this->input->post('comment');
        redirect('/comment/index');
    }
}