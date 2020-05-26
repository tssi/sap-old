<div class="students index">
	<h2><?php __('Students');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('sno');?></th>
			<th><?php echo $this->Paginator->sort('lrn');?></th>
			<th><?php echo $this->Paginator->sort('year_level_id');?></th>
			<th><?php echo $this->Paginator->sort('section_id');?></th>
			<th><?php echo $this->Paginator->sort('first_name');?></th>
			<th><?php echo $this->Paginator->sort('middle_name');?></th>
			<th><?php echo $this->Paginator->sort('last_name');?></th>
			<th><?php echo $this->Paginator->sort('prefix');?></th>
			<th><?php echo $this->Paginator->sort('suffix');?></th>
			<th><?php echo $this->Paginator->sort('gender');?></th>
			<th><?php echo $this->Paginator->sort('birthday');?></th>
			<th><?php echo $this->Paginator->sort('nationality');?></th>
			<th><?php echo $this->Paginator->sort('religion');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($students as $student):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $student['Student']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($student['User']['id'], array('controller' => 'users', 'action' => 'view', $student['User']['id'])); ?>
		</td>
		<td><?php echo $student['Student']['sno']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['lrn']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['year_level_id']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['section_id']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['first_name']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['middle_name']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['last_name']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['prefix']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['suffix']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['gender']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['birthday']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['nationality']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['religion']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['status']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['created']; ?>&nbsp;</td>
		<td><?php echo $student['Student']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $student['Student']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $student['Student']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $student['Student']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $student['Student']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Student', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>