<div class="sales form">
<?php echo $this->Form->create('Sale'); ?>
	<fieldset>
		<legend><?php echo __('Add Sale'); ?></legend>
	<?php
		echo $this->Form->input('representative_id');
		echo $this->Form->input('outlet_id');
		echo $this->Form->input('section_id');
		echo $this->Form->input('date_time');
                echo $this->Form->input('sale_counter');
		echo $this->Form->input('sls_b1');
		echo $this->Form->input('sls_b2');
		echo $this->Form->input('sls_b3');
		echo $this->Form->input('sls_b4');
		echo $this->Form->input('sls_b5');
		echo $this->Form->input('sls_b6');
		echo $this->Form->input('sls_b7');
		echo $this->Form->input('sls_b8');
		echo $this->Form->input('sls_b9');
		echo $this->Form->input('sls_b10');
		echo $this->Form->input('sls_b11');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sales'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Representatives'), array('controller' => 'representatives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Representative'), array('controller' => 'representatives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlets'), array('controller' => 'outlets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlet'), array('controller' => 'outlets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sections'), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section'), array('controller' => 'sections', 'action' => 'add')); ?> </li>
	</ul>
</div>

<script>
    $(document).ready(function(){
        $("#SaleDateTime").datetimepicker();
    });
</script>
