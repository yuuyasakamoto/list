<?php
class Migration_Add_objectives extends CI_Migration {

    public function __construct()
    {   
        parent::__construct();
    }

    // アップデート処理
    public function up()
    {   
        $sql = "CREATE TABLE objectives(id int unsigned NOT NULL AUTO_INCREMENT,
                member_id int unsigned NOT NULL,
                year year NOT NULL,
                quarter tinyint NOT NULL comment '第何四半期',
                title varchar(50) NOT NULL,
                objective text NOT NULL,
                deleted datetime NULL comment 'NULL = 削除されていない',
                created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                modified datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id)) DEFAULT CHARSET=utf8;
                ";
        $this->db->query($sql);

    }
    // ロールバック処理
    public function down()
    {   
        $this->dbforge->drop_table('objectives');
    }

}
