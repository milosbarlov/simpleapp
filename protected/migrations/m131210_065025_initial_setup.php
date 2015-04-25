<?php

class m131210_065025_initial_setup extends CDbMigration
{
	public function up()
	{
            $this->addColumn('user', 'password', 'varchar(32) not null');
            
            $model = new User;
            $model->id = 1;
            $model->username = 'admin';
            $model->first_name = 'Dragan';
            $model->last_name = 'Zivkovic';
            $model->password = md5('123');
            $model->re_password = $model->password;
            $model->email = 'dragan.zivkovic.ts@gmail.com';
            $model->save();
            
            $headMenu = new Menu();
            $headMenu->id = MenuItem::HEADER_MANU;
            $headMenu->title = 'Header Menu';
            $headMenu->created_by = 1;
            $headMenu->create_time = time();
            $headMenu->updated_by = 1;
            $headMenu->update_time = time();
            $headMenu->status = 1;
            $headMenu->save();
            
            $footer = new Menu();
            $footer->id = MenuItem::FOOTER_MANU;
            $footer->title = 'Footer Menu';
            $footer->created_by = 1;
            $footer->create_time = time();
            $footer->updated_by = 1;
            $footer->update_time = time();
            $footer->status = 1;
            $footer->save();
	}

	public function down()
	{
		echo "m131210_065025_initial_setup does not support migration down.\n";
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