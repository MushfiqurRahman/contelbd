<div class="outlets form">
<?php echo $this->Form->create('Outlet'); ?>
	<fieldset>
		<legend><?php echo __('Edit Outlet'); ?></legend>
	<?php
		echo $this->Form->input('id');		
		echo $this->Form->input('house_id');
                echo $this->Form->input('section_id');
		echo $this->Form->input('title', array('label' => 'Outlet name'));
		echo $this->Form->input('outlet_retailer_name');
		echo $this->Form->input('phone_no', array('label' => 'Retailer Phone no'));
		echo $this->Form->input('code', array('label' => 'Outlet Code'));
		echo $this->Form->input('address', array('label' => 'Outlet Address'));
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
<script>
$(document).ready(function(){
   var options;
   
   $("#OutletHouseId").change( function(){
       options = get_section_list( $(this).val() ); 
       $("#OutletSectionId").html(options);       
   });
   
   function get_section_list( house_id ){
       var sections = '';
       $.ajax({
          url:"<?php echo Configure::read('base_url');?>sections/ajax_section_list",
          type:"post",
          async: false,
          cache: false,
          data:"house_id="+house_id,
          success:function( response ){
              
              var opts = $.parseJSON(response);
              
              if( typeof(opts['error'])=='undefined' ){
                  $.each(opts, function(ind, val){                      
                    sections += '<option value="'+ind+'">'+val+'</option>';
                  });
              }else{
                  alert(opts['error']);
              }
          }          
       });    
       return sections;
   }
});
</script>