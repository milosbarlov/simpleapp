<?php

class m140814_081425_add_type_to_content extends CDbMigration
{
	public function up()
	{
            $this->addColumn('content', 'type', 'INT(1) NOT NULL');
	}

	public function down()
	{
		echo "m140814_081425_add_type_to_content does not support migration down.\n";
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