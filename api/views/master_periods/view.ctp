<div class="masterPeriods view">
<h2><?php  __('Master Period');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterPeriod['MasterPeriod']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterPeriod['MasterPeriod']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterPeriod['MasterPeriod']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterPeriod['MasterPeriod']['alias']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Key'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterPeriod['MasterPeriod']['key']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterPeriod['MasterPeriod']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $masterPeriod['MasterPeriod']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Master Period', true), array('action' => 'edit', $masterPeriod['MasterPeriod']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Master Period', true), array('action' => 'delete', $masterPeriod['MasterPeriod']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $masterPeriod['MasterPeriod']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Master Periods', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Master Period', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
