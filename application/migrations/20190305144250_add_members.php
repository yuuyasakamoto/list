<?php
class Migration_Add_members extends CI_Migration {

    public function __construct()
    {   
        parent::__construct();
    }

    // アップデート処理
    public function up()
    {   
        $sql = "CREATE TABLE members(id int unsigned NOT NULL AUTO_INCREMENT,
                member_id int unsigned NOT NULL,
                first_name varchar(50) NOT NULL,
                last_name varchar(50) NOT NULL,
                first_name_kana varchar(50) NOT NULL,
                last_name_kana varchar(50) NOT NULL,
                gender set('男', '女') NOT NULL,
                birthday date NOT NULL,
                home varchar(50) NOT NULL,
                hire_date date NOT NULL comment '入社日',
                retirement_date date NULL comment 'NULL = 退職していない',
                department_id int unsigned NOT NULL comment '部署ID',
                position_id int unsigned NOT NULL comment '役職ID',
                email varchar(20) NOT NULL,
                password varchar(50) NOT NULL,
                sos int unsigned NOT NULL comment '緊急連絡先番号',
                deleted datetime NULL comment 'NULL = 削除していない',
                created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                modified datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
                UNIQUE KEY `member_id` (`member_id`)) DEFAULT CHARSET=utf8;
                ";
        $this->db->query($sql);
    }
    // ロールバック処理
    public function down()
    {   
        $this->dbforge->drop_table('members');
    }

}
