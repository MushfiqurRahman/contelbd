<?php
pr($this->request->params);
pr($this->passedArgs);
pr($_GET);
?>
<div class="sales index">
    <div>
        <?php echo $this->Form->create('Sale',array('type' => 'GET', 'controller' => 'sales', 'action' => 'index'));?>
        <span >Region:<?php echo $titles['region_title'];?></span><br/>
<!--        <input type="hidden" name="data[Region][id]" value="<?php echo $data['Region']['id'];?>"/>-->
        <input type="hidden" name="region_id" value="<?php echo $_GET['region_id'];?>"/>
        
        <span>Area:<?php echo $titles['area_title'];?></span><br/>
<!--        <input type="hidden" name="data[Area][id]" value="<?php echo $data['Area']['id'];?>"/>-->
        <input type="hidden" name="area_id" value="<?php echo $_GET['area_id'];?>"/>
        
        <span>House:<?php echo $titles['house_title'];?></span><br/>
<!--        <input type="hidden" name="data[House][id]" value="<?php echo $data['House']['id'];?>"/>-->
        <input type="hidden" name="house_id" value="<?php echo $_GET['house_id'];?>"/>
        
        <span>Total Outlet:<?php echo count($outlets);?></span><br/>        
    </div>
    
    <div style="margin-top:20px;">
    	<?php
//    		echo $this->Form->input('Representative.id', array('type' => 'select', 
//    			'options' => $representatives,'empty' => 'All', 'label' => 'SR Representative', 'id' => 'repId'));
//    		
//    		echo $this->Form->input('Section.id', array('type' => 'select', 'empty' => 'All', 
//                    'label' => 'Section', 'options' => $sections, 'id' => 'secId'));
//    		echo $this->Form->input('Outlet.id', array('type' => 'select', 'empty' => 'All', 
//                    'label' => 'Outlet', 'options' => $outlets, 'id' => 'outletId'));    		
        
        echo $this->Form->input('representative_id', array('type' => 'select', 
    			'options' => $representatives,'empty' => 'All', 'label' => 'SR Representative', 
            'id' => 'repId', 'selected' => $_GET['representative_id']));
    		
    		echo $this->Form->input('section_id', array('type' => 'select', 'empty' => 'All', 
                    'label' => 'Section', 'options' => $sections, 'id' => 'secId', 'selected' => 'selection_id'));
    		echo $this->Form->input('outlet_id', array('type' => 'select', 'empty' => 'All', 
                    'label' => 'Outlet', 'options' => $outlets, 'id' => 'outletId', 'selected' => $_GET['outlet_id']));    		
    	?>
    	<label>From Date</label>
    	<input type="text" name="from_date" id="fromDate" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : '';?>" size="40" />
    	<labee>Till Date</label>
    	<input type="text" name="till_date" id ="tillDate" value="<?php echo isset($_GET['till_date']) ? $_GET['till_date'] : '';?>" size="40" />
    	
    	<input type="submit" id="btn_sales" value="Submit"/>        
    	
    </div>
    
    <?php
    
//    $url_params = array();
//    if( isset($data['Representative']['id']) ){
//        $url_params['representative_id'] = $data['Representative']['id'];
//    }
//    if( isset($data['Section']['id']) ){
//        $url_params['section_id'] = $data['Section']['id'];
//    }
//    if( isset($data['Outlet']['id']) ){
//        $url_params['outlet_id'] = $data['Outlet']['id'];
//    }
//    if( isset($data['from_date']) ){
//        $url_params['from_date'] = $data['from_date'];
//    }
//    if( isset($data['till_date']) ){
//        $url_params['till_date'] = $data['till_date'];
//    }
//    $url_params['region_id'] = $data['Region']['id'];
//    $url_params['area_id'] = $data['Area']['id'];
//    $url_params['house_id'] = $data['House']['id'];
//
//
//    $this->Paginator->options(array('url' => $url_params));
    ?>
    
    <h2><?php //pr($sales);exit;
        echo __('Sales'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Region</th>
			<th>Area</th>
			<th>House</th>
			<th>Section</th>
			<th>Outlet</th>
			<th>SR</th>
			<th>B1</th>
			<th>B2</th>
			<th>B3</th>
			<th>B4</th>
			<th>B5</th>
			<th>B6</th>
			<th>B7</th>
			<th>B8</th>
			<th>B9</th>
			<th>B10</th>
                        <th>B11</th>
                        <th>Date</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($sales as $sale): ?>
	<tr>
		<td><?php echo $sale['Outlet']['House']['Area']['Region']['title']; ?>&nbsp;</td>
		<td>
			<?php echo $sale['Outlet']['House']['Area']['title']; ?>
		</td>
		<td>
			<?php echo $sale['Outlet']['House']['title']; ?>
		</td>
		<td>
			<?php echo $sale['Section']['title'];?>
		</td>
		<td><?php echo $sale['Outlet']['title']; ?></td>
		<td><?php echo $sale['Representative']['name']; ?></td>
		<td><?php echo $sale['Sale']['sls_b1']; ?></td>
                <td><?php echo $sale['Sale']['sls_b2']; ?></td>
		<td><?php echo $sale['Sale']['sls_b3']; ?></td>
		<td><?php echo $sale['Sale']['sls_b4']; ?></td>
		<td><?php echo $sale['Sale']['sls_b5']; ?></td>
		<td><?php echo $sale['Sale']['sls_b6']; ?></td>
		<td><?php echo $sale['Sale']['sls_b7']; ?></td>
		<td><?php echo $sale['Sale']['sls_b8']; ?></td>
		<td><?php echo $sale['Sale']['sls_b9']; ?></td>
		<td><?php echo $sale['Sale']['sls_b10']; ?></td>
		<td><?php echo $sale['Sale']['sls_b11']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sale['Sale']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sale['Sale']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sale['Sale']['id']), null, __('Are you sure you want to delete # %s?', $sale['Sale']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
        
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
        
        <input type="submit" name="export_sale_report" id="export_sale_report" value="Export" />
</div>

<?php //echo $this->Js->writeBuffer(); ?>

<script>
	var base_url = '<?php echo Configure::read('base_url');?>';
        var house_id = '<?php echo $house_id;?>';
        
	$(document).ready(function(){
            
            $("#export_sale_report").click(function(){                
               $("#SaleIndexForm").attr('action', base_url+'sales/get_report');
               $("#SaleIndexForm").submit();
            });
            
            $("#btn_sales").click( function(){
                $("#SaleIndexForm").attr('action', base_url+'sales/index');
                $("#SaleIndexForm").submit();
            })
            
		$('#repId').change(function(){
                    representative_id = $(this).val();
			$.ajax({
                            url: base_url+'sections/ajax_section_list',
                            type: 'post',
                            data: 'representative_id='+$(this).val(),
                            success: function(response){
                                    var sections = $.parseJSON(response);

                                    $('#secId').html('<select name="data[Section][id]" id="secId"><option value="">All</option></select>');
                                    $.each(sections, function(ind,val){
                                            $('#secId').append('<option value="'+ind+'">'+val+'</option>');						
                                    });
                            }
                        });
		});

		$('#secId').change(function(){
			$.ajax({
                            url: base_url+'outlets/ajax_outlet_list',
                            type: 'post',
                            data: 'house_id='+house_id+'&section_id='+$(this).val(),
                            success: function(response){
                            var outlets = $.parseJSON(response);

                            $('#outletId').html('<select name="data[Outlet][id]" id="outletId"><option value="">All</option></select>');
                            $.each(outlets, function(ind,val){
                                    $('#outletId').append('<option value="'+ind+'">'+val+'</option>');						
                            });
                        }
                    });
		});
                
                $("#fromDate").datetimepicker();
		$("#tillDate").datetimepicker();
	});
</script>
