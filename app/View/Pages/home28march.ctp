<?php	echo $this->Form->create('Sale',array('type' => 'post', 'action' => 'index'));?>
<span class="home_form_elem">
	<?php	echo $this->Form->input('Region.id',array('type' => 'select', 'options' => $regions,
		'empty' => 'All', 'label' => 'Region', 'class' => 'regionId', 'id' => 'first', 'div' => false));?>
</span>
<span class="home_form_elem">
	<?php	echo $this->Form->input('Area.id', array('type' => 'select', 'options' => array(), 'empty' => 'All',
		'label' => 'Area', 'id' => 'area_first', 'class' => 'areaId', 'div' => false));?>
</span>
<span class="home_form_elem">
	<?php	echo $this->Form->input('House.id', array('type' => 'select', 'options' => array(), 'empty' => 'All',
		'label' => 'House', 'id' => 'house_first', 'div' => false));?>
</span>
<span class="home_form_elem"><?php	echo $this->Form->end('Sales Report');?></span> 





<?php	echo $this->Form->create('Sale',array('type' => 'post', 'action' => 'calculate_base'));?>
<span class="home_form_elem">
	<?php	echo $this->Form->input('Region.id',array('type' => 'select', 'options' => $regions,
		'empty' => 'All', 'label' => 'Region', 'class' => 'regionId', 'id' => 'second', 'div' => false));?>
</span>
<span class="home_form_elem">
	<?php	echo $this->Form->input('Area.id', array('type' => 'select', 'options' => array(), 'empty' => 'All',
		'label' => 'Area', 'id' => 'area_second', 'class' => 'areaId', 'div' => false));?>
</span>
<span class="home_form_elem">
	<?php	echo $this->Form->input('House.id', array('type' => 'select', 'options' => array(), 'empty' => 'All',
		'label' => 'House', 'id' => 'house_second', 'class' => 'houseId', 'div' => false));?>
</span>
<span class="home_form_elem"><?php	echo $this->Form->end('Calculate Base');?></span>



<?php	echo $this->Form->create('Campaign',array('type' => 'post', 'action' => 'index'));?>
<span class="home_form_elem">
	<?php	echo $this->Form->input('Region.id',array('type' => 'select', 'options' => $regions,
		'empty' => 'All', 'label' => 'Region', 'class' => 'regionId', 'id' => 'third', 'div' => false));?>
</span>
<span class="home_form_elem">
	<?php	echo $this->Form->input('Area.id', array('type' => 'select', 'options' => array(), 'empty' => 'All',
		'label' => 'Area', 'id' => 'area_third',  'class' => 'areaId', 'div' => false));?>
</span>
<span class="home_form_elem">
	<?php	echo $this->Form->input('House.id', array('type' => 'select', 'options' => array(), 'empty' => 'All',
		'label' => 'House', 'id' => 'house_third', 'div' => false));?>
</span>
<span class="home_form_elem"><?php	echo $this->Form->end('Campaign Report');?></span>






<?php	echo $this->Form->create('Coupon',array('type' => 'post', 'action' => 'index'));?>
<span class="home_form_elem">
	<?php	echo $this->Form->input('Region.id',array('type' => 'select', 'options' => $regions,
		'empty' => 'All', 'label' => 'Region', 'class' => 'regionId', 'id' => 'fourth', 'div' => false));?>
</span>
<span class="home_form_elem">
	<?php	echo $this->Form->input('Area.id', array('type' => 'select', 'options' => array(), 'empty' => 'All',
		'label' => 'Area', 'id' => 'area_fourth',  'class' => 'areaId', 'div' => false));?>
</span>
<span class="home_form_elem">
	<?php	echo $this->Form->input('House.id', array('type' => 'select', 'options' => array(), 'empty' => 'All',
		'label' => 'House', 'id' => 'house_fourth', 'div' => false));?>
</span>
<span class="home_form_elem"><?php	echo $this->Form->end('Coupon Report');?></span>


<div style="float:left;">

<ul>
	<li><?php echo $this->Html->link('Regions', array('controller' => 'regions', 'action' => 'index'));?></li>
	<li><?php echo $this->Html->link('Areas', array('controller' => 'areas', 'action' => 'index'));?></li>
	<li><?php echo $this->Html->link('Houses', array('controller' => 'houses', 'action' => 'index'));?></li>
	<li><?php echo $this->Html->link('Sections', array('controller' => 'sections', 'action' => 'index'));?></li>
	<li><?php echo $this->Html->link('Outlets', array('controller' => 'outlets', 'action' => 'index'));?></li>
	<li><?php echo $this->Html->link('Representatives', array('controller' => 'representatives', 'action' => 'index'));?></li>
	<li><?php echo $this->Html->link('Campaigns', array('controller' => 'campaigns', 'action' => 'index'));?></li>	
        <li><?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index'));?></li>	
        <li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'));?></li>	
        
</ul>
</div>

<script>
	var base_url = '<?php echo Configure::read('base_url');?>';
	$(document).ready(function(){		
		$(".regionId").change(function(e){			
			find_areas( $(this).val(), $(this).attr('id') );	
		});
                
                $(".areaId").change(function(){                    
                    find_houses( $(this).val(), $(this).attr('id') );	
                });
		
		function find_areas( regionId, elementId ){
			$.ajax({
				url: base_url+'areas/ajax_area_list',
				type: 'post',
				data: 'region_id='+regionId,
				success: function(response){					
					var areas = $.parseJSON(response);
					var areaId = 'area_'+elementId;	
                                        $("#area_"+elementId).html('<select name="data[Area][id]" id="area_'+elementId+'"><option value="">All</option></select>');
                                        $("#house_"+elementId).html('<select name="data[House][id]" id="house_'+elementId+'"><option value="">All</option></select>');
					$.each(areas, function(ind,val){
						$('#area_'+elementId).append('<option value="'+ind+'">'+val+'</option>');						
					});
				}
			});
		}
                
                function find_houses( areaId, elementId ){                    
                    $.ajax({
                            url: base_url+'houses/ajax_house_list',
                            type: 'post',
                            data: 'area_id='+areaId,
                            success: function(response){
                                    var houses = $.parseJSON(response);
                                    var houseId = 'house_'+elementId.substring(5,elementId.length);	
                                    $("#"+houseId).html('<select name="data[House][id]" id="'+houseId+'"><option value="">All</option></select>');
                                    $.each(houses, function(ind,val){
                                            $('#'+houseId).append('<option value="'+ind+'">'+val+'</option>');						
                                    });
                            }
                    });                
                }
	});
</script>
