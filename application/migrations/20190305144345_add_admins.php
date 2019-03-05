<?php
class Migration_Add_admins extends CI_Migration {

    public function __construct()
    {   
        parent::__construct();
    }

    // アップデート処理
    public function up()
    {   
        $sql = "CREATE TABLE admins(id int unsigned NOT NULL AUTO_INCREMENT,
                email varchar(50) unsigned NOT NULL,
                password varchar(50) unsigned NOT NULL,
                name varcher(50) NOT NULL,
                deleted datetime NULL comment 'NULL = 削除されていない',
                created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                modified datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id))
                ";
    }
    // ロールバック処理
    public function down()
    {   
        //$this->dbforge->drop_table('admins');
    }

}
