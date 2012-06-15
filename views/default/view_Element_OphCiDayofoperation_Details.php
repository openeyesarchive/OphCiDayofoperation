
<h4 class="elementTypeName"><?php  echo $element->elementType->name ?></h4>

<div class="view">

			<div class="view">
				<b><?php  echo CHtml::encode($element->getAttributeLabel('medical_history_changed_id')); ?>:</b>
				<?php  echo $element->medical_history_changed ? $element->medical_history_changed->name : 'None'?>				<br />
			</div>
								<div class="view">
				<b><?php  echo CHtml::encode($element->getAttributeLabel('inr_level')); ?>:</b>
				<?php  echo $element->inr_level ?>				<br />
			</div>
								<div class="view">
				<b><?php  echo CHtml::encode($element->getAttributeLabel('preop_checklist')); ?>:</b>
				<?php  echo $element->preop_checklist ? 'Yes' : 'No' ?>				<br />
			</div>
								<div class="view">
				<b><?php  echo CHtml::encode($element->getAttributeLabel('cjd_checklist')); ?>:</b>
				<?php  echo $element->cjd_checklist ? 'Yes' : 'No' ?>				<br />
			</div>
					</div>

