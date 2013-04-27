<div class="categories view">
<h2><?php  echo __('Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($category['Category']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($category['Category']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($category['Category']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Category'), array('action' => 'edit', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Category'), array('action' => 'delete', $category['Category']['id']), null, __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sale Details'), array('controller' => 'sale_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale Detail'), array('controller' => 'sale_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sub Categories'), array('controller' => 'sub_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sub Category'), array('controller' => 'sub_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Sale Details'); ?></h3>
	<?php if (!empty($category['SaleDetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Sale Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Sub Category Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($category['SaleDetail'] as $saleDetail): ?>
		<tr>
			<td><?php echo $saleDetail['id']; ?></td>
			<td><?php echo $saleDetail['sale_id']; ?></td>
			<td><?php echo $saleDetail['category_id']; ?></td>
			<td><?php echo $saleDetail['sub_category_id']; ?></td>
			<td><?php echo $saleDetail['quantity']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sale_details', 'action' => 'view', $saleDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sale_details', 'action' => 'edit', $saleDetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sale_details', 'action' => 'delete', $saleDetail['id']), null, __('Are you sure you want to delete # %s?', $saleDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sale Detail'), array('controller' => 'sale_details', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Sub Categories'); ?></h3>
	<?php if (!empty($category['SubCategory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Code'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($category['SubCategory'] as $subCategory): ?>
		<tr>
			<td><?php echo $subCategory['id']; ?></td>
			<td><?php echo $subCategory['category_id']; ?></td>
			<td><?php echo $subCategory['title']; ?></td>
			<td><?php echo $subCategory['code']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sub_categories', 'action' => 'view', $subCategory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sub_categories', 'action' => 'edit', $subCategory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sub_categories', 'action' => 'delete', $subCategory['id']), null, __('Are you sure you want to delete # %s?', $subCategory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sub Category'), array('controller' => 'sub_categories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
