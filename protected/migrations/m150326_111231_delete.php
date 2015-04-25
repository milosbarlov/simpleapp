<?php

class m150326_111231_delete extends CDbMigration
{
	public function up()
	{
            $this->dropTable('Message');
	}

	public function down()
	{
		echo "m150326_111231_delete does not support migration down.\n";
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