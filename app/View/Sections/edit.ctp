<div class="sections form">
<?php echo $this->Form->create('Section'); ?>
	<fieldset>
		<legend><?php echo __('Edit Section'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('house_id');
                echo $this->Form->input('representative_id');
		echo $this->Form->input('title');
		echo $this->Form->input('code', array('required' => false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Section.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Section.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sections'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Houses'), array('controller' => 'houses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New House'), array('controller' => 'houses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Coupons'), array('controller' => 'coupons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coupon'), array('controller' => 'coupons', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Outlets'), array('controller' => 'outlets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outlet'), array('controller' => 'outlets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales'), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale'), array('controller' => 'sales', 'action' => 'add')); ?> </li>
	</ul>
</div>
<script>
    $(document).ready(function(){
        
        $("#SectionHouseId").change(function(){
            get_rep_list();
        });
       function get_rep_list(){
           $.ajax({
                url:'/sections/ajax_rep_list',
                type:'post',
                data:'house_id='+$("#SectionHouseId").val(),
                success:function(res){
                    var options = $.parseJSON(res);
                    var representatives = '';

                    if( typeof(options['error']) != "undefined" ){
                        alert(options['error']);
                    }else{
                        $.each(options, function(ind, val){
                            representatives += '<option value="'+ind+'">'+val+'</option>';
                        });
                        $("#SectionRepresentativeId").html(representatives);
                    }
                }
            });
       }
    });
</script>
