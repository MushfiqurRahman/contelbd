<div class="sales view">
<h2><?php  echo __('Sale'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Representative'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sale['Representative']['name'], array('controller' => 'representatives', 'action' => 'view', $sale['Representative']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Outlet'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sale['Outlet']['title'], array('controller' => 'outlets', 'action' => 'view', $sale['Outlet']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Section'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sale['Section']['title'], array('controller' => 'sections', 'action' => 'view', $sale['Section']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Time'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['date_time']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sls B1'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['sls_b1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sls B2'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['sls_b2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sls B3'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['sls_b3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sls B4'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['sls_b4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sls B5'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['sls_b5']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sls B6'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['sls_b6']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sls B7'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['sls_b7']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sls B8'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['sls_b8']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sls B9'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['sls_b9']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sls B10'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['sls_b10']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sls B11'); ?></dt>
		<dd>
			<?php echo h($sale['Sale']['sls_b11']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sale'), array('action' => 'edit', $sale['Sale']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sale'), array('action' => 'delete', $sale['Sale']['id']), null, __('Are you sure you want to delete # %s?', $sale['Sale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Representatives'), array('controller' => 'representatives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Representative'), array('controller' => 'representatives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlets'), array('controller' => 'outlets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlet'), array('controller' => 'outlets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sections'), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section'), array('controller' => 'sections', 'action' => 'add')); ?> </li>
	</ul>
</div>
