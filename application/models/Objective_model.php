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
    }
    

