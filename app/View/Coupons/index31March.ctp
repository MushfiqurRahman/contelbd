<div class="coupons index">
    <?php echo $this->Form->create('Coupon',array('action' => 'get_report','type' => 'post'));?>
    <div>        
        
        
        <span >Region:<?php echo $titles['region_title'];?></span><br/>     
        <input type="hidden" name="data[Region][id]" value="<?php echo $data['Region']['id'];?>"/>
        
        <span>Area:<?php echo $titles['area_title'];?></span><br/>
        <input type="hidden" name="data[Area][id]" value="<?php echo $data['Area']['id'];?>"/>
        
        <span>House:<?php echo $titles['house_title'];?></span><br/>
        <input type="hidden" name="data[House][id]" value="<?php echo $data['House']['id'];?>"/>
        
        <span>Total Outlet:<?php echo $total_outlet;?></span><br/>        
    </div>
    
	<h2><?php   echo __('Coupons'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Region</th>
			<th>Area</th>
			<th>House</th>
			<th>TSA Name</th>
			<th>Section</th>
			<th>Outlet</th>
			<th>Total Point</th>
			<th>First Activity</th>
			<th>Second Activity</th>
                        <th>Third Activity</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($coupons as $coupon): ?>
	<tr>
		<td><?php echo h($coupon['Outlet']['House']['Area']['Region']['title']); ?>&nbsp;</td>
		<td>
			<?php echo h($coupon['Outlet']['House']['Area']['title']); ?>
		</td>
		<td>
			<?php echo h($coupon['Outlet']['House']['title']); ?>
		</td>
		<td>
			<?php echo h($coupon['Representative']['name']);?>
		</td>
		<td><?php echo h($coupon['Section']['title']); ?>&nbsp;</td>
		<td><?php echo h($coupon['Outlet']['title']); ?>&nbsp;</td>
                <td><?php echo h($coupon['Coupon']['total_score']); ?>&nbsp;</td>
                <td><?php echo h($coupon['Coupon']['first_act_score']); ?>&nbsp;</td>
		<td><?php echo h($coupon['Coupon']['second_act_score']); ?>&nbsp;</td>
		<td><?php echo h($coupon['Coupon']['third_act_score']); ?>&nbsp;</td>		
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $coupon['Coupon']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $coupon['Coupon']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $coupon['Coupon']['id']), null, __('Are you sure you want to delete # %s?', $coupon['Coupon']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php    
            $url_params = array();            
            $url_params['region_id'] = $data['Region']['id'];
            $url_params['area_id'] = $data['Area']['id'];
            $url_params['house_id'] = $data['House']['id'];

            $this->Paginator->options(array('url' => $url_params));

	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
        
        <?php           
            echo $this->Form->end('Export');
        ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Coupon'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Representatives'), array('controller' => 'representatives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Representative'), array('controller' => 'representatives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlets'), array('controller' => 'outlets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlet'), array('controller' => 'outlets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sections'), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section'), array('controller' => 'sections', 'action' => 'add')); ?> </li>
	</ul>
</div>
