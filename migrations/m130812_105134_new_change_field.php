<?php

class m130812_105134_new_change_field extends CDbMigration
{
	public function up()
	{
	    return $this->addColumn('et_ophcidayofoperation_details', 'change', 'VARCHAR(1000) ');
	}

	public function down()
	{
		 return $this->dropColumn('et_ophcidayofoperation_details', 'change');
	}


}