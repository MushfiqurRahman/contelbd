<div class="coupons view">
<h2><?php  echo __('Coupon'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($coupon['Coupon']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Representative'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coupon['Representative']['name'], array('controller' => 'representatives', 'action' => 'view', $coupon['Representative']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Outlet'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coupon['Outlet']['title'], array('controller' => 'outlets', 'action' => 'view', $coupon['Outlet']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Section'); ?></dt>
		<dd>
			<?php echo $this->Html->link($coupon['Section']['title'], array('controller' => 'sections', 'action' => 'view', $coupon['Section']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Score'); ?></dt>
		<dd>
			<?php echo h($coupon['Coupon']['total_score']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Act Score'); ?></dt>
		<dd>
			<?php echo h($coupon['Coupon']['first_act_score']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Second Act Score'); ?></dt>
		<dd>
			<?php echo h($coupon['Coupon']['second_act_score']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Third Act Score'); ?></dt>
		<dd>
			<?php echo h($coupon['Coupon']['third_act_score']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Time'); ?></dt>
		<dd>
			<?php echo h($coupon['Coupon']['date_time']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Coupon'), array('action' => 'edit', $coupon['Coupon']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Coupon'), array('action' => 'delete', $coupon['Coupon']['id']), null, __('Are you sure you want to delete # %s?', $coupon['Coupon']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Coupons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coupon'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Representatives'), array('controller' => 'representatives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Representative'), array('controller' => 'representatives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlets'), array('controller' => 'outlets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlet'), array('controller' => 'outlets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sections'), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section'), array('controller' => 'sections', 'action' => 'add')); ?> </li>
	</ul>
</div>
