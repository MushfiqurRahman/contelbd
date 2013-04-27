<div class="outlets view">
<h2><?php  echo __('Outlet'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($outlet['Outlet']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Section'); ?></dt>
		<dd>
			<?php echo $this->Html->link($outlet['Section']['title'], array('controller' => 'sections', 'action' => 'view', $outlet['Section']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('House'); ?></dt>
		<dd>
			<?php echo $this->Html->link($outlet['House']['title'], array('controller' => 'houses', 'action' => 'view', $outlet['House']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($outlet['Outlet']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($outlet['Outlet']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Outlet'), array('action' => 'edit', $outlet['Outlet']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Outlet'), array('action' => 'delete', $outlet['Outlet']['id']), null, __('Are you sure you want to delete # %s?', $outlet['Outlet']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlet'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Coupons'); ?></h3>
	<?php if (!empty($outlet['Coupon'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Representative Id'); ?></th>
		<th><?php echo __('Outlet Id'); ?></th>
		<th><?php echo __('Section Id'); ?></th>
		<th><?php echo __('Total Score'); ?></th>
		<th><?php echo __('First Act Score'); ?></th>
		<th><?php echo __('Second Act Score'); ?></th>
		<th><?php echo __('Third Act Score'); ?></th>
		<th><?php echo __('Date Time'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($outlet['Coupon'] as $coupon): ?>
		<tr>
			<td><?php echo $coupon['id']; ?></td>
			<td><?php echo $coupon['representative_id']; ?></td>
			<td><?php echo $coupon['outlet_id']; ?></td>
			<td><?php echo $coupon['section_id']; ?></td>
			<td><?php echo $coupon['total_score']; ?></td>
			<td><?php echo $coupon['first_act_score']; ?></td>
			<td><?php echo $coupon['second_act_score']; ?></td>
			<td><?php echo $coupon['third_act_score']; ?></td>
			<td><?php echo $coupon['date_time']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'coupons', 'action' => 'view', $coupon['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'coupons', 'action' => 'edit', $coupon['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'coupons', 'action' => 'delete', $coupon['id']), null, __('Are you sure you want to delete # %s?', $coupon['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Coupon'), array('controller' => 'coupons', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Sales'); ?></h3>
	<?php if (!empty($outlet['Sale'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Representative Id'); ?></th>
		<th><?php echo __('Outlet Id'); ?></th>
		<th><?php echo __('Section Id'); ?></th>
		<th><?php echo __('Date Time'); ?></th>
		<th><?php echo __('Sls B1'); ?></th>
		<th><?php echo __('Sls B2'); ?></th>
		<th><?php echo __('Sls B3'); ?></th>
		<th><?php echo __('Sls B4'); ?></th>
		<th><?php echo __('Sls B5'); ?></th>
		<th><?php echo __('Sls B6'); ?></th>
		<th><?php echo __('Sls B7'); ?></th>
		<th><?php echo __('Sls B8'); ?></th>
		<th><?php echo __('Sls B9'); ?></th>
		<th><?php echo __('Sls B10'); ?></th>
		<th><?php echo __('Sls B11'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($outlet['Sale'] as $sale): ?>
		<tr>
			<td><?php echo $sale['id']; ?></td>
			<td><?php echo $sale['representative_id']; ?></td>
			<td><?php echo $sale['outlet_id']; ?></td>
			<td><?php echo $sale['section_id']; ?></td>
			<td><?php echo $sale['date_time']; ?></td>
			<td><?php echo $sale['sls_b1']; ?></td>
			<td><?php echo $sale['sls_b2']; ?></td>
			<td><?php echo $sale['sls_b3']; ?></td>
			<td><?php echo $sale['sls_b4']; ?></td>
			<td><?php echo $sale['sls_b5']; ?></td>
			<td><?php echo $sale['sls_b6']; ?></td>
			<td><?php echo $sale['sls_b7']; ?></td>
			<td><?php echo $sale['sls_b8']; ?></td>
			<td><?php echo $sale['sls_b9']; ?></td>
			<td><?php echo $sale['sls_b10']; ?></td>
			<td><?php echo $sale['sls_b11']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sales', 'action' => 'view', $sale['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sales', 'action' => 'edit', $sale['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sales', 'action' => 'delete', $sale['id']), null, __('Are you sure you want to delete # %s?', $sale['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sale'), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
