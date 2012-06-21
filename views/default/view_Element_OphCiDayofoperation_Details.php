
<h4 class="elementTypeName"><?php  echo $element->elementType->name ?></h4>

<table class="subtleWhite normalText">
	<tbody>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('medical_history_changed_id'))?>:</td>
			<td><span class="big"><?php echo $element->medical_history_changed ? $element->medical_history_changed->name : 'None'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('inr_level'))?>:</td>
			<td><span class="big"><?php echo $element->inr_level?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('preop_checklist'))?>:</td>
			<td><span class="big"><?php echo $element->preop_checklist ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('cjd_checklist'))?>:</td>
			<td><span class="big"><?php echo $element->cjd_checklist ? 'Yes' : 'No'?></span></td>
		</tr>
	</tbody>
</table>
