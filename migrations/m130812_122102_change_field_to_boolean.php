<?php

class m130812_122102_change_field_to_bolean extends CDbMigration
{
	public function up()
	{
        $this->dropForeignKey('et_ophcidayofoperation_details_medical_history_changed_fk','et_ophcidayofoperation_details');
        $this->dropIndex('et_ophcidayofoperation_details_medical_history_changed_fk','et_ophcidayofoperation_details');
        $this->dropTable('et_ophcidayofoperation_details_medical_history_changed');
	    $this->AlterColumn('et_ophcidayofoperation_details','medical_history_changed_id','tinyint(1) unsigned');
	    $this->renameColumn('et_ophcidayofoperation_details','medical_history_changed_id','medical_history_changed');
	}

	public function down()
	{
	    $this->renameColumn('et_ophcidayofoperation_details','medical_history_changed','medical_history_changed_id');
	    $this->AlterColumn('et_ophcidayofoperation_details','medical_history_changed_id','int(10) unsigned not null');
	    
        $this->createTable('et_ophcidayofoperation_details_medical_history_changed', array(
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
            'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
            'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
            'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
            'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
            'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
            'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
            'PRIMARY KEY (`id`)',
            'KEY `et_ophcidayofoperation_details_medical_history_changed_lmui_fk` (`last_modified_user_id`)',
            'KEY `et_ophcidayofoperation_details_medical_history_changed_cui_fk` (`created_user_id`)',
            'CONSTRAINT `et_ophcidayofoperation_details_medical_history_changed_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
            'CONSTRAINT `et_ophcidayofoperation_details_medical_history_changed_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
        ), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

        $this->insert('et_ophcidayofoperation_details_medical_history_changed',array('name'=>'Yes','display_order'=>1));
        $this->insert('et_ophcidayofoperation_details_medical_history_changed',array('name'=>'No','display_order'=>2));

	    $this->addForeignKey('et_ophcidayofoperation_details_medical_history_changed_fk', 'et_ophcidayofoperation_details', 'medical_history_changed_id', 'et_ophcidayofoperation_details_medical_history_changed', 'id');
	}
}