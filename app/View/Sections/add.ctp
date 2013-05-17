<div class="sections form">
<?php echo $this->Form->create('Section'); ?>
	<fieldset>
		<legend><?php echo __('Add Section'); ?></legend>
	<?php
		echo $this->Form->input('house_id');
                echo $this->Form->input('ss_id',array('label' => 'Select SS'));
                echo $this->Form->input('sr_id',array('label' => 'Select SR'));
                echo $this->Form->input('tsa_id',array('label' => 'TSA'));        
		echo $this->Form->input('title');
		//echo $this->Form->input('code', array('required' => false));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
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
        get_rep_list('ss');
        get_rep_list('sr');
        get_rep_list('tsa');
        
        $("#SectionHouseId").change(function(){
            get_rep_list('ss');
            get_rep_list('sr');
            get_rep_list('tsa');
        });
        
        $("#SectionSsId").change(function(){
            get_rep_list('sr');
        });
        
       function get_rep_list( rep_type ){
           var dTa = 'house_id='+$("#SectionHouseId").val()+'&rep_type='+rep_type;
           if( rep_type=='sr' ){
               dTa+='&ss_id='+$("#SectionSsId").val();
           }
           
           $.ajax({
                url:'/sections/ajax_rep_list',
                type:'post',
                async: false,
                cache: false,
                data:dTa,
                success:function(res){
                    var options = $.parseJSON(res);
                    var representatives = '';

                    if( typeof(options['error']) != "undefined" ){
                        alert(options['error']);
                    }else{
                        $.each(options, function(ind, val){
                            representatives += '<option value="'+ind+'">'+val+'</option>';
                        });
                        if( rep_type=='ss' ){
                            $("#SectionSsId").html(representatives);
                        }else if( rep_type=='sr' ){
                            $("#SectionSrId").html(representatives);
                        }else{
                            $("#SectionTsaId").html(representatives);
                        }                        
                    }
                }
            });
       }
    });
</script>