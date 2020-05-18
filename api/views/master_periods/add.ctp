<div class="masterPeriods form">
<?php echo $this->Form->create('MasterPeriod');?>
	<fieldset>
		<legend><?php __('Add Master Period'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('alias');
		echo $this->Form->input('key');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Master Periods', true), array('action' => 'index'));?></li>
	</ul>
</div>