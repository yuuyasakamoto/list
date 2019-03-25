<?php

class Objective_model extends CI_Model
{
        
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
        $query=$this->db->query("SELECT * FROM objectives WHERE member_id='$member_id' AND year='$year' AND quarter='$quarter'");
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
     * 目標の編集
     * @param int $year
     * @param string $quarter
     * @param string $objective
     * @param int $objective_id
     */
    public function update(int $year, string $quarter, string $objective, int $objective_id)

    {
        $sql = "UPDATE objectives SET year = ?, quarter = ?, objective =?,
                               modified = now()
                               WHERE id = ?";
        $this->db->query($sql, [$year, $quarter, $objective, $objective_id]);  
    }
    /**
     * 目標IDで目標内容を取得
     * @param type $member_id
     * @param type $created
     * @return type
     */
    public function getContent(int $objective_id)
    {
        $query = $this->db->query("SELECT * FROM objectives WHERE id='$objective_id'");
        return $query->row();
    }
    /**
     * 目標データの取得
     * @param int $member_id
     * @param int $year
     * @param string $quarter
     * @return type
     */
    public function select(int $member_id, int $year = null, string $quarter = null)
    {
        //年度と四半期の引数がnullの場合社員IDに紐づいた目標データを取得
        if ($year == null && $quarter == null)
        {
            $query = $this->db->query("SELECT * FROM objectives WHERE member_id='$member_id' ORDER BY year DESC");
            return $query->result();
        //社員IDと年度と四半期が一致するレコードを取得
        } else {
            $query = $this->db->query("SELECT * FROM objectives WHERE member_id='$member_id' AND year='$year' AND quarter='$quarter'");
            return $query->row(); 
        }
    }
}


