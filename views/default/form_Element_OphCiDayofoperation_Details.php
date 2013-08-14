<?php /**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
 ?>
<div class="element <?php echo $element->elementType->class_name?>"
	data-element-type-id="<?php echo $element->elementType->id ?>"
	data-element-type-class="<?php echo $element->elementType->class_name ?>"
	data-element-type-name="<?php echo $element->elementType->name ?>"
	data-element-display-order="<?php echo $element->elementType->display_order ?>">
	<h4 class="elementTypeName"><?php  echo $element->elementType->name; ?></h4>

    <div class="eventDetail" style="padding-left: 13.9em;">
        <?php echo CHtml::encode($element->getAttributeLabel('medical_history_changed'))?>
	</div>
	<div class="eventDetail" style="padding-left: 13.9em;">
		<?php echo $form->radioBoolean($element, 'medical_history_changed', array('nowrapper'=>1))?>
        <?php $showchange = $_POST ? $_POST["Element_OphCiDayofoperation_Details"]["medical_history_changed"] : $element->medical_history_changed;?>
        <div class="changelabel"<?php if(!$showchange) echo ' style="display:none"'; else echo ' style="display:inline-block"'?>>
            <?php echo CHtml::encode($element->getAttributeLabel('change'))?>
	        <?php echo $form->textField($element, 'change',array('nowrapper'=>1))?>
        </div>
	</div>
	<?php echo $form->textField($element, 'inr_level', array('size' => '10')); ?>
	<div class="eventDetail" style="padding-left: 13.9em;">
		<?php echo $form->checkBox($element, 'preop_checklist', array('nowrapper'=>true))?>
		<?php echo CHtml::encode($element->getAttributeLabel('preop_checklist'))?>
	</div>
	<div class="eventDetail" style="padding-left: 13.9em;">
		<?php echo $form->checkBox($element, 'cjd_checklist', array('nowrapper'=>true))?>
		<?php echo CHtml::encode($element->getAttributeLabel('cjd_checklist'))?>
	</div>
</div>
