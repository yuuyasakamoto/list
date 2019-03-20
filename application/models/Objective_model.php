<?php

    class Objective_model extends CI_Model{
        
        /**
         * 目標投稿機能
         * @param type $member_id
         * @param type $year
         * @param type $quarter
         * @param type $objective
         */
        public function insert(int $member_id, int $year, string $quarter, string $objective)
        {   
            //更新の場合data1
            $data1 = ['member_id' => $member_id, 'year' => $year, 'quarter' => $quarter, 'objective' => $objective, 'modified' => date("Y/m/d H:i:s")];
            //新規投稿の場合data2
            $data2 = ['member_id' => $member_id, 'year' => $year, 'quarter' => $quarter, 'objective' => $objective];
            $query=$this->db->query("SELECT * FROM objectives where member_id='$member_id' and year='$year' and quarter='$quarter'");
            //社員IDと年度と四半期が一致する目標があればデータ更新
            if ($query->row()) {
                $update = ['member_id' => $member_id, 'year' => $year, 'quarter' => $quarter];
                $this->db->where($update);
                $this->db->update('objectives', $data1);
            //存在しなければ通常の目標データ保存
            } else {
                $this->db->insert('objectives', $data2);
            }
        }
        /**
         * 目標データの取得
         * @param type $member_id
         * @param type $year
         * @param type $quarter
         * @return type
         */
        public function select(int $member_id, int $year, string $quarter)
        {
            $query = $this->db->query("SELECT * FROM objectives where member_id='$member_id' and year='$year' and quarter='$quarter'");
            return $query->row_array(); 
        }
        /**
         * 目標の編集機能
         * @param type $member_id
         * @param type $year
         * @param type $quarter
         * @param type $objective
         */
        public function update(int $year, string $quarter, string $objective, int $objective_id)
                           
        {
            $sql = "UPDATE objectives SET year = ?, quarter = ?, objective =?,
                                   modified = now()
                                   WHERE id = ?";
            $this->db->query($sql, [$year, $quarter, $objective, $objective_id]);  
        }
        /**
         * member_idの目標データ取得
         * @param type $member_id
         * @return type
         */
        public function getObjectives(int $member_id)
        {
            $query = $this->db->query("SELECT * FROM objectives where member_id='$member_id' ORDER BY year DESC");
            return $query->result();
        }
        /**
         * IDで目標内容を取得
         * @param type $member_id
         * @param type $created
         * @return type
         */
        public function getContents(int $objective_id)
        {
            $query = $this->db->query("SELECT * FROM objectives where id='$objective_id'");
            return $query->row_array();
        }
    }
    

