<div class="outlets index">
	<h2><?php echo __('Outlets'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('section_id'); ?></th>
			<th><?php echo $this->Paginator->sort('house_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('outlet_retailer_name'); ?></th>
			<th><?php echo $this->Paginator->sort('phone_no'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('priority'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($outlets as $outlet): ?>
	<tr>
		<td><?php echo h($outlet['Outlet']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($outlet['Section']['title'], array('controller' => 'sections', 'action' => 'view', $outlet['Section']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($outlet['House']['title'], array('controller' => 'houses', 'action' => 'view', $outlet['House']['id'])); ?>
		</td>
		<td><?php echo h($outlet['Outlet']['title']); ?>&nbsp;</td>
		<td><?php echo h($outlet['Outlet']['outlet_retailer_name']); ?>&nbsp;</td>
		<td><?php echo h($outlet['Outlet']['phone_no']); ?>&nbsp;</td>		
		<td><?php echo h($outlet['Outlet']['code']); ?>&nbsp;</td>
		<td><?php echo h($outlet['Outlet']['priority']); ?>&nbsp;</td>
		<td><?php echo h($outlet['Outlet']['address']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $outlet['Outlet']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $outlet['Outlet']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $outlet['Outlet']['id']), null, __('Are you sure you want to delete # %s?', $outlet['Outlet']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Outlet'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sections'), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section'), array('controller' => 'sections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Houses'), array('controller' => 'houses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New House'), array('controller' => 'houses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Coupons'), array('controller' => 'coupons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coupon'), array('controller' => 'coupons', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales'), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale'), array('controller' => 'sales', 'action' => 'add')); ?> </li>
	</ul>
</div>
