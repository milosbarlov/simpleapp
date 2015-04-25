<?php

class m150325_190227_language extends CDbMigration
{
	public function up()
	{
            $this->createTable('SourceMessage', array(
                'id'=>'integer',
                'category'=>'varchar(32)',
                'message'=>'text',
                'PRIMARY KEY(id)'
            ));
            
            $this->createTable('Message',array(
               'id'=>'integer',
                'language'=>'varchar(16)',
                'translation'=>'text',
                ' PRIMARY KEY (id, language)',
            ));
	}

	public function down()
	{
		echo "m150325_190227_language does not support migration down.\n";
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