<div class="outlets form">
<?php echo $this->Form->create('Outlet'); ?>
	<fieldset>
		<legend><?php echo __('Edit Outlet'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('section_id');
		echo $this->Form->input('house_id');
		echo $this->Form->input('title');
		echo $this->Form->input('code');
                echo $this->Form->input('priority', array('type' => 'select', 'options' => 
                    array('MVP' => 'MVP','VP' => 'VP', 'P' => 'P'), 
                    'selected' => $this->request->data['Outlet']['priority'],
                    'empty' => 'Select value','label' => 'Priority Value'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Outlet.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Outlet.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Outlets'), array('action' => 'index')); ?></li>
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
