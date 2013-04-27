<?php echo $this->Form->create('Sale',array('controller' => 'sales', 'action' => 'calculate_base'));?>
    
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>Query Panel</span>
        </div>
        <div class="mws-panel-body">
            <div class="mws-panel-content">                
                <div>
                    <div style="display:inline-block;width:100%"> <!-- 1st row start -->
                        <div style="float:left;width:20%">
                                <label>Region</label>
                        </div>
                        <div style="float:left;width:72%">                                
                            <?php echo $titles['region_title'];?>
                            <input type="hidden" name="data[Region][id]" value="<?php echo $this->data['Region']['id'];?>"/>
                        </div>
                    </div>
                    
                    <div style="display:inline-block;width:100%"> <!-- 1st row start -->
                        <div style="float:left;width:20%">
                                <label>Area</label>
                        </div>
                        <div style="float:left;width:72%">                                
                            <?php echo $titles['area_title'];?>
                            <input type="hidden" name="data[Area][id]" value="<?php echo $this->data['Area']['id'];?>"/>
                        </div>
                    </div>
                    
                    <div style="display:inline-block;width:100%"> <!-- 1st row start -->
                        <div style="float:left;width:20%">
                                <label>House</label>
                        </div>
                        <div style="float:left;width:72%">                                
                            <?php echo $titles['house_title'];?>
                            <input type="hidden" name="data[House][id]" value="<?php echo $this->data['House']['id'];?>"/>
                        </div>
                    </div>
                    
                    <div style="display:inline-block;width:100%"> <!-- 1st row start -->
                        <div style="float:left;width:20%">
                                <label>Total Outlet</label>
                        </div>
                        <div style="float:left;width:72%">                                
                            <?php echo $total_outlet;?>
                        </div>
                    </div>


                    <div style="display:inline-block;width:100%; margin-top:10px; margin-bottom:10px;"> <!-- 3rd row start -->
                        <p style="font-weight:bold;">Select Date Range for ADS Calculation</p>
                        <hr />
                    <div style="float:left;width:20%"><label>Start Date</label></div>
                        <div style="float:left;width:30%">
                                <input size="30" class="mws-textinput" name="from_date" id="fromDate" onFocus="this.value=''" onClick="showCalendarControl(this);" type="text" value="<?php echo isset($this->data['from_date']) ? $this->data['from_date'] : '';?>" />
                        </div>

                        <div style="float:left;width:20%"><label>End Date</label></div>
                        <div style="float:left;width:30%">
                                <input size="30" class="mws-textinput" name="till_date" id="tillDate" onFocus="this.value=''" onClick="showCalendarControl(this);" type="text" value="<?php echo isset($this->data['till_date']) ? $this->data['till_date'] : '';?>" />
                        </div>			
                    </div> <!-- 3rd row end -->


                    <div style="margin:0 auto;width:100%;text-align:center">
                        <table><tr>
                        <td><input class="mws-button blue" value="Search" type="submit" id="btn_sales" /></td>
                        </tr></table>
                    </div>
    </div>
    </div>
    </div>
    </div>
    
    <?php
    
    //url for Set Target button
    $set_target_url = Configure::read('base_url').'campaigns/add/region_id='.$this->data['Region']['id'].
                    '/area_id='.$this->data['Area']['id'].'/house_id='.$this->data['House']['id'];
    
    $url_params = array();    
    $url_params['region_id'] = $this->data['Region']['id'];
    $url_params['area_id'] = $this->data['Area']['id'];
    $url_params['house_id'] = $this->data['House']['id'];
    
    if( isset($this->data['from_date']) ){
        $url_params['from_date'] = is_numeric($this->data['from_date']) ? $this->data['from_date'] : strtotime($this->data['from_date']);
    }
    if( isset($this->data['till_date']) ){
        $url_params['till_date'] = is_numeric($this->data['till_date']) ? $this->data['till_date'] : strtotime($this->data['till_date']);
    }
    
//    if( isset($this->data['from_date']) ){
//        $url_params['from_date'] = $this->data['from_date'];
//        $set_target_url .= '/from_date='. strtotime($this->data['from_date']);    
//    }else{
//        $url_params['from_date'] = null;
//        $set_target_url .= '/from_date=';
//    }
//    if( isset($this->data['till_date']) ){
//        $url_params['till_date'] = $this->data['till_date'];
//        $set_target_url .= '/till_date='. strtotime($this->data['till_date']);
//    }else{
//        $url_params['till_date'] = null;
//        $set_target_url .= '/till_date=';
//    }

    $this->Paginator->options(array('url' => $url_params));
    
    
    ?>
    
    
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>Calculation Base</span>
        </div>
        <div class="mws-panel-body">
            <div class="mws-panel-content">
                <div id="reportbr_content" style="clear:both">
                    <div id="table_reportbr_content">
                        <div class="cluster_details">    
    
	<table class="mws-table">
            <tr class="mws">
                <td><div class="br_h"><span class="title"><strong>Region</strong></span></td>
                <td><span class="data"><?php echo $titles['region_title'];?></span></div></td>
                <td><div class="br_h"><span class="title">
                            <strong>Total MVP</strong></span></td>
                            <td><span class="data"><?php echo isset($outlet_by_priority['MVP']) ? $outlet_by_priority['MVP'] : 0;?></span></div></td>
            </tr>
            <tr>
                <td><div class="br_h"><span class="title"><strong>Area</strong></span></td>
                <td><span class="data"><?php echo $titles['area_title'];?></span></div></td>
                <td><div class="br_h"><span class="title"><strong>Total VP</strong></span></td>
                <td><span class="data"><?php echo isset($outlet_by_priority['VP']) ? $outlet_by_priority['VP'] : 0;?></span></div></td>
            </tr>
            <tr>
                <td><div class="br_h"><span class="title"><strong>House</strong></span></td>
                <td><span class="data"><?php echo $titles['house_title'];?></span></div></td>
                <td><div class="br_h"><span class="title"><strong>Total P</strong></span></td>
                <td><span class="data"><?php echo isset($outlet_by_priority['P']) ? $outlet_by_priority['P'] : 0;?></span></div></td>
            </tr>
            <tr>
                <td><div class="br_h"><span class="title"><strong>Base Period</strong></span></td>
                <td><span class="data"></span></div></td>
                <td><div class="br_h"><span class="title"><strong> </strong></span></td><td><span class="data"></span></div></td>
            </tr>
        </table> <br /><hr />
        
        <table class="mws-table" style="font-size:11px;">
            <tr class="mws">
                                
                                
			<th>Region</th>
			<th>Area</th>
			<th>House</th>
			<th>Section</th>
			<th>Outlet</th>
			<th>SR</th>
			<th>B1 Base</th>
			<th>B2 Base</th>
			<th>B3 Base</th>
			<th>B4 Base</th>
			<th>B5 Base</th>
			<th>B6 Base</th>
			<th>B7 Base</th>
			<th>B8 Base</th>
			<th>B9 Base</th>
			<th>B10 Base</th>
                        <th>B11 Base</th>
                        <th>Date</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php 
        //pr($sales);
        foreach ($sales as $sale): ?>
	<tr class="gradeX">
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
		<td><?php echo $sale[0]['base_b1']; ?></td>
                <td><?php echo $sale[0]['base_b2']; ?></td>
		<td><?php echo $sale[0]['base_b3']; ?></td>
		<td><?php echo $sale[0]['base_b4']; ?></td>
		<td><?php echo $sale[0]['base_b5']; ?></td>
		<td><?php echo $sale[0]['base_b6']; ?></td>
		<td><?php echo $sale[0]['base_b7']; ?></td>
		<td><?php echo $sale[0]['base_b8']; ?></td>
		<td><?php echo $sale[0]['base_b9']; ?></td>
		<td><?php echo $sale[0]['base_b10']; ?></td>
		<td><?php echo $sale[0]['base_b11']; ?></td>
                <td><?php echo $sale['Sale']['date_time'];?></td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $sale['Sale']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $sale['Sale']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sale['Sale']['id']), null, __('Are you sure you want to delete # %s?', $sale['Sale']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
        
        </br>
        <input type="submit" class="mws-button blue" value="Export to Excel" name="export_calculated_base" id="export_calculated_base"/> 
        <a href="<?php echo $set_target_url;?>"><input type="button" value="Set Target" class="mws-button orange" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
</div>

<?php //echo $this->Js->writeBuffer(); ?>

<script>
	var base_url = '<?php echo Configure::read('base_url');?>';
        
	$(document).ready(function(){
            
            $("#export_calculated_base").click(function(){                
               $("#SaleCalculateBaseForm").attr('action', base_url+'sales/export_calculated_base');
               $("#SaleCalculateBaseForm").submit();
            });
            
            $("#btn_sales").click( function(){
                $("#SaleCalculateBaseForm").attr('action', base_url+'sales/calculate_base');
                $("#SaleCalculateBaseForm").submit();
            })          
                
            $("#fromDate").datetimepicker();
            $("#tillDate").datetimepicker();
	});
</script>
