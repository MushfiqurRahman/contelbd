<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-books-2">For Further Information</span>
                    </div>
                    <div class="mws-panel-body">
                    	<div class="mws-panel-content"><div>
			<div style="display:inline-block;width:100%">
						
                                                    <!-- 1st Feedback row start -->
                            <?php	
                            //echo $this->Form->create('Sale',array('type' => 'post', 'action' => 'index', 'class' => 'mws-form'));
                            echo $this->Form->create('Outlet',array('type' => 'post', 'action' => 'sales_report', 'class' => 'mws-form'));?>
                                <div style="width:20%">
                                        <label>Partner Sales</label>
                                </div>

                                <div style="width:100%; margin-top:10px">

                                    <?php	
                                        echo $this->Form->input('Region.id',array('type' => 'select', 'options' => $regions,
    'empty' => 'All Region', 'label' => false, 'class' => 'regionId', 'id' => 'first', 'style' => 'width:23%;float:left;', 'div' => false));
                                        echo $this->Form->input('Area.id', array('type' => 'select', 'options' => array(), 'empty' => 'All Area',
    'label' => false, 'id' => 'area_first', 'class' => 'areaId', 'style' => 'width:23%;float:left; margin-left:15px;','div' => false));

                                        echo $this->Form->input('House.id', array('type' => 'select', 'options' => array(), 'empty' => 'All House',
    'label' => false, 'id' => 'house_first', 'style' => 'width:23%;float:left; margin-left:15px; margin-right:20px;', 'div' => false));
                                        echo $this->Form->end(array('label' => 'Submit', 'class' => 'mws-button orange','style' => 'float:left; margin-top:-2px;'));
                                    ?>                                        
                <input type="reset" value="Reset" class="mws-button gray" style="float:left; margin-top:-2px;"/>
                                </div>
                                                    
                                                    
                                
<?php	echo $this->Form->create('Sale',array('type' => 'post', 'action' => 'calculate_base', 'class' => 'mws-form'));?>
                                                    <div style="width:20%">
                                        <label>Calculate Base</label>
                                </div>

                                <div style="width:100%; margin-top:10px">
 

	<?php	echo $this->Form->input('Region.id',array('type' => 'select', 'options' => $regions,
		'empty' => 'All Region', 'label' => false, 'class' => 'regionId', 'id' => 'second', 'style' => 'width:23%;float:left;', 'div' => false));
        echo $this->Form->input('Area.id', array('type' => 'select', 'options' => array(), 'empty' => 'All Area',
		'label' => false, 'id' => 'area_second', 'class' => 'areaId','style' => 'width:23%;float:left; margin-left:15px;', 'div' => false));
        echo $this->Form->input('House.id', array('type' => 'select', 'options' => array(), 'empty' => 'All House',
		'label' => false, 'id' => 'house_second', 'class' => 'houseId', 'style' => 'width:23%;float:left; margin-left:15px; margin-right:20px;', 'div' => false));
        echo $this->Form->end(array('label' => 'Submit', 'class' => 'mws-button orange','style' => 'float:left; margin-top:-2px;'));
        ?>
                                    <input type="reset" value="Reset" class="mws-button gray" style="float:left; margin-top:-2px;"/>
                                </div>



<?php	//echo $this->Form->create('Campaign',array('type' => 'post', 'action' => 'index', 'class' => 'mws-form'));?>
                                                    <?php   echo $this->Form->create('Campaign',array('type' => 'post', 'action' => 'target_vs_achieve', 'class' => 'mws-form'));?>
                                    <div style="width:20%">
                                        <label>Target Achievement</label>
                                </div>

                                <div style="width:100%; margin-top:10px">

	<?php
        echo $this->Form->input('Region.id',array('type' => 'select', 'options' => $regions,
		'empty' => 'All Region', 'label' => false, 'class' => 'regionId', 'id' => 'third', 'style' => 'width:23%;float:left;', 'div' => false));
	echo $this->Form->input('Area.id', array('type' => 'select', 'options' => array(), 'empty' => 'All Area',
		'label' => false, 'id' => 'area_third',  'class' => 'areaId','style' => 'width:23%;float:left; margin-left:15px;', 'div' => false));
        echo $this->Form->input('House.id', array('type' => 'select', 'options' => array(), 'empty' => 'All House',
		'label' => false, 'id' => 'house_third',  'style' => 'width:23%;float:left; margin-left:15px; margin-right:20px;','div' => false));
        echo $this->Form->end(array('label' => 'Submit', 'class' => 'mws-button orange','style' => 'float:left; margin-top:-2px;'));
        ?>
<input type="reset" value="Reset" class="mws-button gray" style="float:left; margin-top:-2px;"/>
                                </div>






<?php	echo $this->Form->create('Coupon',array('type' => 'post', 'action' => 'index', 'class' => 'mws-form'));?>

<div style="width:20%">
                                        <label>Coupon Point</label>
                                </div>

                                <div style="width:100%; margin-top:10px">

	<?php	echo $this->Form->input('Region.id',array('type' => 'select', 'options' => $regions,
		'empty' => 'All Region', 'label' => false, 'class' => 'regionId', 'id' => 'fourth',  'style' => 'width:23%;float:left;','div' => false));
        echo $this->Form->input('Area.id', array('type' => 'select', 'options' => array(), 'empty' => 'All Area',
		'label' => false, 'id' => 'area_fourth',  'class' => 'areaId', 'style' => 'width:23%;float:left; margin-left:15px;','div' => false));
        echo $this->Form->input('House.id', array('type' => 'select', 'options' => array(), 'empty' => 'All House',
		'label' => false, 'id' => 'house_fourth',  'style' => 'width:23%;float:left; margin-left:15px; margin-right:20px;','div' => false));
        echo $this->Form->end(array('label' => 'Submit', 'class' => 'mws-button orange','style' => 'float:left; margin-top:-2px;'));?></span>

<input type="reset" value="Reset" class="mws-button gray" style="float:left; margin-top:-2px;"/>
                                </div>
                              
                                
							<br/> <br />						
						</div> <!-- Inner Row End -->						
                    
							</div>
						</div>
					</div>
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