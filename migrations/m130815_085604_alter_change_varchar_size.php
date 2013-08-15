<?php

class m130815_085604_alter_change_varchar_size extends CDbMigration
{
	public function up()
	{
        return $this->alterColumn('et_ophcidayofoperation_details', 'change', 'VARCHAR(128) ');
	}

	public function down()
	{
        return $this->alterColumn('et_ophcidayofoperation_details', 'change', 'VARCHAR(1000) ');
	}
}