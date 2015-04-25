<?php

class m150326_111601_newTable extends CDbMigration
{
	public function up()
	{
            $this->createTable('Message', array(
               'id'=>'integer',
                'language'=>'varchar(16)',
                'translation'=>'text',
                'PRIMARY KEY (id, language)',
                'CONSTRAINT FK_Message_SourceMessage FOREIGN KEY (id)
         REFERENCES SourceMessage (id) ON DELETE CASCADE ON UPDATE RESTRICT',
            ));
	}

	public function down()
	{
		echo "m150326_111601_newTable does not support migration down.\n";
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