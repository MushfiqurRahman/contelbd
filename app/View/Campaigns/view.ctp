<div class="campaigns view">
<h2><?php  echo __('Campaign'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Area'); ?></dt>
		<dd>
			<?php echo $this->Html->link($campaign['Area']['title'], array('controller' => 'areas', 'action' => 'view', $campaign['Area']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trgt B1'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['trgt_b1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trgt B2'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['trgt_b2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trgt B3'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['trgt_b3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trgt B4'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['trgt_b4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trgt B5'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['trgt_b5']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trgt B6'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['trgt_b6']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trgt B7'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['trgt_b7']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trgt B8'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['trgt_b8']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trgt B9'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['trgt_b9']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trgt B10'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['trgt_b10']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Trgt B11'); ?></dt>
		<dd>
			<?php echo h($campaign['Campaign']['trgt_b11']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Campaign'), array('action' => 'edit', $campaign['Campaign']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Campaign'), array('action' => 'delete', $campaign['Campaign']['id']), null, __('Are you sure you want to delete # %s?', $campaign['Campaign']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Campaigns'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campaign'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
	</ul>
</div>
