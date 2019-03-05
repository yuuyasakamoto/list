<?php
class Migration_Add_departments extends CI_Migration {

    public function __construct()
    {   
        parent::__construct();
    }

    // アップデート処理
    public function up()
    {   
        $sql = "CREATE TABLE departments(id int unsigned NOT NULL AUTO_INCREMENT,
                department_name varchar(50) NOT NULL comment '部署名',
                deleted datetime NULL comment 'NULL = 削除されていない',
                created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                modified datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id))
                ";
        $this->db->query($sql);
    }
    // ロールバック処理
    public function down()
    {   
        $this->dbforge->drop_table('departments');
    }

}
