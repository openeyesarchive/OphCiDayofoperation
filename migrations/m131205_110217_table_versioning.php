<?php

class m131205_110217_table_versioning extends CDbMigration
{
	public function up()
	{
		$this->execute("
CREATE TABLE `et_ophcidayofoperation_details_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`medical_history_changed_id` int(10) unsigned NOT NULL,
	`inr_level` varchar(255) COLLATE utf8_bin DEFAULT '',
	`preop_checklist` tinyint(1) unsigned NOT NULL,
	`cjd_checklist` tinyint(1) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophcidayofoperation_details_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophcidayofoperation_details_cui_fk` (`created_user_id`),
	KEY `acv_et_ophcidayofoperation_details_ev_fk` (`event_id`),
	KEY `acv_et_ophcidayofoperation_details_medical_history_changed_fk` (`medical_history_changed_id`),
	CONSTRAINT `acv_et_ophcidayofoperation_details_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophcidayofoperation_details_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophcidayofoperation_details_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_et_ophcidayofoperation_details_medical_history_changed_fk` FOREIGN KEY (`medical_history_changed_id`) REFERENCES `et_ophcidayofoperation_details_medical_history_changed` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophcidayofoperation_details_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophcidayofoperation_details_version');

		$this->createIndex('et_ophcidayofoperation_details_aid_fk','et_ophcidayofoperation_details_version','id');
		$this->addForeignKey('et_ophcidayofoperation_details_aid_fk','et_ophcidayofoperation_details_version','id','et_ophcidayofoperation_details','id');

		$this->addColumn('et_ophcidayofoperation_details_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophcidayofoperation_details_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophcidayofoperation_details_version','version_id');
		$this->alterColumn('et_ophcidayofoperation_details_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophcidayofoperation_details_medical_history_changed_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) COLLATE utf8_bin NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_phcidayofoperation_details_medical_history_changed_lmui_fk` (`last_modified_user_id`),
	KEY `acv_phcidayofoperation_details_medical_history_changed_cui_fk` (`created_user_id`),
	CONSTRAINT `acv_phcidayofoperation_details_medical_history_changed_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_phcidayofoperation_details_medical_history_changed_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin
		");

		$this->alterColumn('et_ophcidayofoperation_details_medical_history_changed_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophcidayofoperation_details_medical_history_changed_version');

		$this->createIndex('et_ophcidayofoperation_details_medical_history_changed_aid_fk','et_ophcidayofoperation_details_medical_history_changed_version','id');
		$this->addForeignKey('et_ophcidayofoperation_details_medical_history_changed_aid_fk','et_ophcidayofoperation_details_medical_history_changed_version','id','et_ophcidayofoperation_details_medical_history_changed','id');

		$this->addColumn('et_ophcidayofoperation_details_medical_history_changed_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophcidayofoperation_details_medical_history_changed_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophcidayofoperation_details_medical_history_changed_version','version_id');
		$this->alterColumn('et_ophcidayofoperation_details_medical_history_changed_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

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

		$this->dropTable('et_ophcidayofoperation_details_version');
		$this->dropTable('et_ophcidayofoperation_details_medical_history_changed_version');
	}
}
