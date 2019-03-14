<?php

    class Objective_model extends CI_Model{
        /**
         * postされた値をobjectivesテーブルに登録
         * @param type $member_id
         * @param type $year
         * @param type $quarter
         * @param type $objective
         */
        public function insert($member_id, $year, $quarter, $objective)
        {
            $data = ['member_id' => $member_id, 'year' => $year, 'quarter' => $quarter, 'objective' => $objective];
            $this->db->insert('objectives', $data);
        }
        /**
         * 社員IDと投稿時間で目標内容を取得
         * @param type $member_id
         * @param type $created
         * @return type
         */
        public function getContents($member_id, $created){
            $query = $this->db->query("SELECT objective FROM objectives where member_id='$member_id' and created='$created'");
            return $query->row()->objective;
        }
        /**
         * 目標の編集機能
         * @param type $member_id
         * @param type $year
         * @param type $quarter
         * @param type $objective
         */
        public function update($member_id, $year, $quarter, $objective, $objective_id)
                           
        {
            $sql = "UPDATE objectives SET member_id = ?, year = ?, quarter = ?, objective =?,
                                   modified = now()
                                   WHERE id = ?";
            $this->db->query($sql, [ $member_id, $year, $quarter, $objective,
                                   $objective_id]);                      
        }
    }
    

