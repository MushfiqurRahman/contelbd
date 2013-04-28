<div class="products view">
<h2><?php  echo __('Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Brand'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['Brand']['title'], array('controller' => 'brands', 'action' => 'view', $product['Brand']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($product['Product']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Code'); ?></dt>
		<dd>
			<?php echo h($product['Product']['code']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product'), array('action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Brands'), array('controller' => 'brands', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Brand'), array('controller' => 'brands', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sale Details'), array('controller' => 'sale_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale Detail'), array('controller' => 'sale_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Sale Details'); ?></h3>
	<?php if (!empty($product['SaleDetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Sale Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($product['SaleDetail'] as $saleDetail): ?>
		<tr>
			<td><?php echo $saleDetail['id']; ?></td>
			<td><?php echo $saleDetail['sale_id']; ?></td>
			<td><?php echo $saleDetail['product_id']; ?></td>
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
