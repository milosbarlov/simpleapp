<?php

class m140815_074943_add_colum_content_tbl extends CDbMigration
{
	public function up()
	{
            $this->addColumn('content', 'for_index', 'int(1) default null');
	}

	public function down()
	{
		echo "m140815_074943_add_colum_content_tbl does not support migration down.\n";
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