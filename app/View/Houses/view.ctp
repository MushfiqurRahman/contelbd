<div class="houses view">
<h2><?php  echo __('House'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($house['House']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Area'); ?></dt>
		<dd>
			<?php echo $this->Html->link($house['Area']['title'], array('controller' => 'areas', 'action' => 'view', $house['Area']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($house['House']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($house['House']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit House'), array('action' => 'edit', $house['House']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete House'), array('action' => 'delete', $house['House']['id']), null, __('Are you sure you want to delete # %s?', $house['House']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Houses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New House'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlets'), array('controller' => 'outlets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlet'), array('controller' => 'outlets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Representatives'), array('controller' => 'representatives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Representative'), array('controller' => 'representatives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sections'), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section'), array('controller' => 'sections', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Outlets'); ?></h3>
	<?php if (!empty($house['Outlet'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Section Id'); ?></th>
		<th><?php echo __('House Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($house['Outlet'] as $outlet): ?>
		<tr>
			<td><?php echo $outlet['id']; ?></td>
			<td><?php echo $outlet['section_id']; ?></td>
			<td><?php echo $outlet['house_id']; ?></td>
			<td><?php echo $outlet['title']; ?></td>
			<td><?php echo $outlet['code']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'outlets', 'action' => 'view', $outlet['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'outlets', 'action' => 'edit', $outlet['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'outlets', 'action' => 'delete', $outlet['id']), null, __('Are you sure you want to delete # %s?', $outlet['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Outlet'), array('controller' => 'outlets', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Representatives'); ?></h3>
	<?php if (!empty($house['Representative'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('House Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Mobile No'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($house['Representative'] as $representative): ?>
		<tr>
			<td><?php echo $representative['id']; ?></td>
			<td><?php echo $representative['house_id']; ?></td>
			<td><?php echo $representative['name']; ?></td>
			<td><?php echo $representative['mobile_no']; ?></td>
			<td><?php echo $representative['type']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'representatives', 'action' => 'view', $representative['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'representatives', 'action' => 'edit', $representative['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'representatives', 'action' => 'delete', $representative['id']), null, __('Are you sure you want to delete # %s?', $representative['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Representative'), array('controller' => 'representatives', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Sections'); ?></h3>
	<?php if (!empty($house['Section'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('House Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($house['Section'] as $section): ?>
		<tr>
			<td><?php echo $section['id']; ?></td>
			<td><?php echo $section['house_id']; ?></td>
			<td><?php echo $section['title']; ?></td>
			<td><?php echo $section['code']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sections', 'action' => 'view', $section['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sections', 'action' => 'edit', $section['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sections', 'action' => 'delete', $section['id']), null, __('Are you sure you want to delete # %s?', $section['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Section'), array('controller' => 'sections', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
