<?php

class m131209_203900_initial_db_structure extends CDbMigration
{
	public function up()
	{
            $this->createTable('content', array(
                'id'=>'int(10) unsigned not null auto_increment',
                'parent_id'=>'int(10) unsigned default null',
                'title'=>'varchar(64) not null',
                'excerpt'=>'varchar(255) not null',
                'content'=>'mediumtext not null',
                'created_by'=>'int(10) not null',
                'create_time'=>'int(10) not null',
                'updated_by'=>'int(10) not null',
                'update_time'=>'int(10) not null',
                'status'=>'tinyint(1) not null',
                'PRIMARY KEY (`id`)',
            ));
            
            $this->createTable('seo', array(
                'id'=>'int(10) unsigned not null auto_increment',
                'model_name'=>'varchar(64) not null',
                'model_id'=>'int(10) unsigned not null',
                'url'=>'varchar(255) not null',
                'view'=>'varchar(64) default null',
                'status'=>'tinyint(1) not null',
                'PRIMARY KEY (`id`)',
            ));
            
            $this->createTable('menu', array(
                'id'=>'int(10) unsigned not null auto_increment',
                'title'=>'varchar(64) not null',
                'description'=>'varchar(255) default null',
                'created_by'=>'int(10) not null',
                'create_time'=>'int(10) not null',
                'updated_by'=>'int(10) not null',
                'update_time'=>'int(10) not null',
                'status'=>'tinyint(1) not null',
                'PRIMARY KEY (`id`)'
            ));
            
            $this->createTable('menu_item', array(
                'id'=>'int(10) unsigned not null auto_increment',
                'menu_id'=>'int(10) unsigned not null',
                'model_name'=>'varchar(64) not null',
                'model_id'=>'int(10) unsigned not null',
                'list_order'=>'tinyint(2) not null',
                'created_by'=>'int(10) not null',
                'create_time'=>'int(10) not null',
                'updated_by'=>'int(10) not null',
                'update_time'=>'int(10) not null',
                'status'=>'tinyint(1) not null',
                'PRIMARY KEY (`id`)'
            ));
            
            $this->createTable('user', array(
                'id'=>'int(10) unsigned not null auto_increment',
                'username'=>'varchar(64) not null',
                'first_name'=>'varchar(64) not null',
                'last_name'=>'varchar(64) not null',
                'email'=>'varchar(64) not null',
                'PRIMARY KEY (`id`)'
            ));
	}

	public function down()
	{
		echo "m131209_203900_initial_db_structure does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}