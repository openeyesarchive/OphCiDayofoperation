<?php

class m131206_150634_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophcidayofoperation_details','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcidayofoperation_details_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcidayofoperation_details_medical_history_changed','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophcidayofoperation_details_medical_history_changed_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophcidayofoperation_details','deleted');
		$this->dropColumn('et_ophcidayofoperation_details_version','deleted');
		$this->dropColumn('et_ophcidayofoperation_details_medical_history_changed','deleted');
		$this->dropColumn('et_ophcidayofoperation_details_medical_history_changed_version','deleted');
	}
}
