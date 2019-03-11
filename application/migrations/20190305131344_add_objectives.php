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
                quarter set('第1四半期', '第2四半期', '第3四半期', '第4四半期') NOT NULL comment '第何四半期',
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
