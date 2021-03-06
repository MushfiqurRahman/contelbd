<div class="subCategories view">
<h2><?php  echo __('Sub Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($subCategory['SubCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($subCategory['Category']['title'], array('controller' => 'categories', 'action' => 'view', $subCategory['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($subCategory['SubCategory']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($subCategory['SubCategory']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sub Category'), array('action' => 'edit', $subCategory['SubCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sub Category'), array('action' => 'delete', $subCategory['SubCategory']['id']), null, __('Are you sure you want to delete # %s?', $subCategory['SubCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sub Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
