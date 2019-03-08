<?php
class Migration_Add_comments extends CI_Migration {

    public function __construct()
    {   
        parent::__construct();
    }

    // アップデート処理
    public function up()
    {   
        $sql = "CREATE TABLE comments(id int unsigned NOT NULL AUTO_INCREMENT,
                admin_id int unsigned NOT NULL,
                objective_id int unsigned NOT NULL comment '目標ID',
                comments text NOT NULL,
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
        $this->dbforge->drop_table('comments');
    }
}
