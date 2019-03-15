<?php

    class Objective_model extends CI_Model{
        
        /**
         * 目標投稿機能
         * @param type $member_id
         * @param type $year
         * @param type $quarter
         * @param type $objective
         */
        public function insert($member_id, $year, $quarter, $objective)
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
        public function select($member_id, $year, $quarter)
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
        public function update($member_id, $year, $quarter, $objective, $objective_id)
                           
        {
            $sql = "UPDATE objectives SET member_id = ?, year = ?, quarter = ?, objective =?,
                                   modified = now()
                                   WHERE id = ?";
            $this->db->query($sql, [ $member_id, $year, $quarter, $objective,
                                   $objective_id]);                      
        }
    }
    

