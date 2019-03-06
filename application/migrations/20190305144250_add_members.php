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
                first_name_kana varchar(50) NOT NULL,
                gender enum('male', 'female') NOT NULL,
                birth date NOT NULL,
                home varchar(50) NOT NULL,
                hire_date date NOT NULL comment '入社日',
                retirement_date date NULL comment 'NULL = 退職していない',
                department_id int unsigned NOT NULL comment '部署ID',
                position_id int unsigned NOT NULL comment '役職ID',
                email varchar(20) NOT NULL,
                password varchar(50) NOT NULL,
                sos varchar(50) NOT NULL comment '緊急連絡先',
                deleted datetime NULL comment 'NULL = 削除していない',
                created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                modified datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id))
                ";
    }
    // ロールバック処理
    public function down()
    {   
        $this->dbforge->drop_table('members');
    }

}
