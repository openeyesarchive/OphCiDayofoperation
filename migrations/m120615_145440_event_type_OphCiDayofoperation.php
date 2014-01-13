<?php 
class m120615_145440_event_type_OphCiDayofoperation extends CDbMigration
{
	public function up() {

		// --- EVENT TYPE ENTRIES ---

		// create an event_type entry for this event type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('name=:name', array(':name'=>'Day of operation'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Clinical events'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphCiDayofoperation', 'name' => 'Day of operation','event_group_id' => $group['id']));
		}
		// select the event_type id for this event type name
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('name=:name', array(':name'=>'Day of operation'))->queryRow();

		// --- ELEMENT TYPE ENTRIES ---

				// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Details',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Details','class_name' => 'Element_OphCiDayofoperation_Details', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name', array(':name'=>'Details'))->queryRow();
				
				// element lookup table et_ophcidayofoperation_details_medical_history_changed
		$this->createTable('et_ophcidayofoperation_details_medical_history_changed', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) NOT NULL',
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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->insert('et_ophcidayofoperation_details_medical_history_changed',array('name'=>'Yes','display_order'=>1));
		$this->insert('et_ophcidayofoperation_details_medical_history_changed',array('name'=>'No','display_order'=>2));
							
				
		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophcidayofoperation_details', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'medical_history_changed_id' => 'int(10) unsigned NOT NULL', // Change in medical history since preoperative assessment
				'inr_level' => 'varchar(255) DEFAULT \'\'', // INR level
				'preop_checklist' => 'tinyint(1) unsigned NOT NULL', // Preoperative checklist completed and filed in the notes
				'cjd_checklist' => 'tinyint(1) unsigned NOT NULL', // CJD checklist completed and filed in the notes
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophcidayofoperation_details_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophcidayofoperation_details_cui_fk` (`created_user_id`)',
				'KEY `et_ophcidayofoperation_details_ev_fk` (`event_id`)',
				'KEY `et_ophcidayofoperation_details_medical_history_changed_fk` (`medical_history_changed_id`)',
				'CONSTRAINT `et_ophcidayofoperation_details_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcidayofoperation_details_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophcidayofoperation_details_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophcidayofoperation_details_medical_history_changed_fk` FOREIGN KEY (`medical_history_changed_id`) REFERENCES `et_ophcidayofoperation_details_medical_history_changed` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
	}

	public function down() {
		// --- drop any element related tables ---
		// --- drop element tables ---
				$this->dropTable('et_ophcidayofoperation_details');

		
				$this->dropTable('et_ophcidayofoperation_details_medical_history_changed');
		
		
		// --- delete event entries ---
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('name=:name', array(':name'=>'Day of operation'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		// --- delete entries from element_type ---
		$this->delete('element_type', 'event_type_id='.$event_type['id']);

		// --- delete entries from event_type ---
		$this->delete('event_type', 'id='.$event_type['id']);

		// echo "m000000_000001_event_type_OphCiDayofoperation does not support migration down.\n";
		// return false;
		echo "If you are removing this module you may also need to remove references to it in your configuration files\n";
		return true;
	}
}
?>
