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
                comments text(1000) NOT NULL,
                title varcher(50) NOT NULL,
                objective text(1000) NOT NULL,
                deleted datetime NULL comment 'NULL = 削除されていない',
                created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                modified datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id))
                ";
    }
    // ロールバック処理
    public function down()
    {  
        $this->dbforge->drop_table('comments');
    }
}
