<div class="campaigns form">
<?php echo $this->Form->create('Campaign'); ?>
	<fieldset>
		<legend><?php echo __('Add Campaign'); ?></legend>
	<?php        
            echo $this->Form->create('Campaing', array('type' => 'post','action' => 'add'));
            echo $this->Form->input('Campaign.title', array('type' => 'text', 'label' => 'Name'));
            echo $this->Form->input('Campaign.start_date', array('type' => 'text', 'label' => 'Start Date'));
            echo $this->Form->input('Campaign.end_date', array('type' => 'text', 'label' => 'End Date'));
            echo $this->Form->input('Campaign.trgt_b1',array('type' => 'text', 'label' => 'B1 Target', 'required' => false, 'div' => false));
            echo $this->Form->input('Campaign.trgt_b2',array('type' => 'text', 'label' => 'B2 Target', 'required' => false, 'div' => false));
            echo $this->Form->input('Campaign.trgt_b3',array('type' => 'text', 'label' => 'B3 Target', 'required' => false, 'div' => false));
            echo $this->Form->input('Campaign.trgt_b4',array('type' => 'text', 'label' => 'B4 Target', 'required' => false, 'div' => false));
            echo $this->Form->input('Campaign.trgt_b5',array('type' => 'text', 'label' => 'B5 Target', 'required' => false, 'div' => false));
            echo $this->Form->input('Campaign.trgt_b6',array('type' => 'text', 'label' => 'B6 Target', 'required' => false, 'div' => false));
            echo $this->Form->input('Campaign.trgt_b7',array('type' => 'text', 'label' => 'B7 Target', 'required' => false, 'div' => false));
            echo $this->Form->input('Campaign.trgt_b8',array('type' => 'text', 'label' => 'B8 Target', 'required' => false, 'div' => false));
            echo $this->Form->input('Campaign.trgt_b9',array('type' => 'text', 'label' => 'B9 Target', 'required' => false, 'div' => false));
            echo $this->Form->input('Campaign.trgt_b10',array('type' => 'text', 'label' => 'B10 Target', 'required' => false, 'div' => false));
            echo $this->Form->input('Campaign.trgt_b11',array('type' => 'text', 'label' => 'B11 Target', 'required' => false, 'div' => false));            
	?>
                
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Campaigns'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
	</ul>
</div>

<script type="text/javascript">
    $(document).ready(function(){
       $("#CampaignStartDate").datetimepicker();
       $("#CampaignEndDate").datetimepicker();
    });
</script>
