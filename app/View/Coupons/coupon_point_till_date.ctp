
<?php //pr($coupons);?>
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span style="text-align:center; font-size:18px; color:#fff;">Coupon Point Till Date</span>
    </div>
</div>

<?php echo $this->Form->create('Coupon',array('action' => 'get_report_till_date','type' => 'post'));?>

<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>Query Panel</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-panel-content">
            <div>
                
                <div style="display:inline-block;width:100%; margin-top:10px; margin-bottom:10px;"> <!-- 3rd row start -->
                        <hr />
                    <div style="float:left;width:20%"><label>Start Date</label></div>
                    <div style="float:left;width:30%">
                            <input size="30" class="mws-textinput" name="from_date" onFocus="this.value=''" onClick="showCalendarControl(this);" type="text" value="<?php echo isset($this->data['from_date']) ? $this->data['from_date'] : '';?>" />
                    </div>

                    <div style="float:left;width:20%"><label>End Date</label></div>
                    <div style="float:left;width:30%">
                            <input size="30" class="mws-textinput" name="till_date" onFocus="this.value=''" onClick="showCalendarControl(this);" type="text" value="<?php echo isset($this->data['till_date']) ? $this->data['till_date'] : '';?>" />
                    </div>			
                </div> <!-- 3rd row end -->
						
						
                <div style="margin:0 auto;width:100%;text-align:center">
                        <table><tr>
                        <td><input class="mws-button blue" value="Search" type="submit" id="search"/></td>
                        </tr></table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>Till Date Earned Point</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-panel-content">           
            
            <div id="reportbr_content" style="clear:both">
                <div id="table_reportbr_content">                    
                    
                <div class="cluster_details">    
                    
                    <table class="mws-table">
                        <tr class="mws">
                            <td><div class="br_h"><span class="title"><strong>Region</strong></span></div></td>
                            <td><span class="data"><?php echo $titles['region_title'];?></span>
                                <input type="hidden" name="data[Region][id]" value="<?php echo $data['Region']['id'];?>"/>
                            </td>
                            <td><div class="br_h"><span class="title"><strong>Total MVP</strong></span></td>
                            <td><span class="data"><?php echo isset($outlet_by_priority['MVP']) ? $outlet_by_priority['MVP'] : 0;?></span></div></td>
                        </tr>
                        <tr>
                            <td><div class="br_h"><span class="title"><strong>Area</strong></span></div></td>
                            <td><span class="data"><?php echo $titles['area_title'];?></span>
                                <input type="hidden" name="data[Area][id]" value="<?php echo $data['Area']['id'];?>"/>
                            </td>
                            <td><div class="br_h"><span class="title"><strong>Total VP</strong></span></td>
                            <td><span class="data"><?php echo isset($outlet_by_priority['VP']) ? $outlet_by_priority['VP'] : 0;?></span></div></td>
                        </tr>
                        <tr>
                            <td><div class="br_h"><span class="title"><strong>House</strong></span></div></td>
                            <td><span class="data"><?php echo $titles['house_title'];?></span>
                                <input type="hidden" name="data[House][id]" value="<?php echo $data['House']['id'];?>"/>
                            </td>
                            <td><div class="br_h"><span class="title"><strong>Total P</strong></span></td>
                            <td><span class="data"><?php echo isset($outlet_by_priority['P']) ? $outlet_by_priority['P'] : 0;?></span></div></td>
                        </tr>
                        
                        <tr>
                            <td><div class="br_h"><span class="title"><strong>Base Period</strong></span></td>
                            <td><span class="data">Upto Today</span></div></td>
                            <td><div class="br_h"><span class="title"><strong> </strong></span></td><td><span class="data"></span></div></td>
                        </tr>                        
                    </table>                                       
                    <br /><hr />
                    
                    <table class="mws-table" style="font-size:11px;">
	
	<tr class="mws">
			<th>Region</th>
			<th>Area</th>
			<th>House</th>
			<th>TSA Name</th>
			<th>Section</th>
                        <th>TLP Name</th>
                        <th>Till Date Total Earned Points</th>
                        <th>Till date Point Earned for KPI 1</th>
                        <th>Till date Point Earned for KPI 2</th>
                        <th>Till date Point Earned for KPI 3</th>                        
                        <th>Till date Redeemed Points</th>
                        <th>Point Balance</th>
	</tr>
	<?php 
            foreach ($coupons as $coupon): 
                $total_pt = $coupon[0]['f_total']+$coupon[0]['sec_total']+$coupon[0]['third_total'];
        ?>
	<tr class="gradeX">
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
                <td><?php echo h($total_pt); ?>&nbsp;</td>                
                <td><?php echo h($coupon[0]['f_total']); ?>&nbsp;</td>
		<td><?php echo h($coupon[0]['sec_total']); ?>&nbsp;</td>
		<td><?php echo h($coupon[0]['third_total']); ?>&nbsp;</td>
                <td><?php echo h($total_pt - $coupon[0]['total']); ?>&nbsp;</td>
                <td><?php echo h($coupon[0]['total']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
        <br />
        
	<input class="mws-button blue" value="Export to Excel" type="submit"/>
        <?php 
            echo $this->Form->end();
            
            echo $this->Form->create('Coupon',array('action' => 'index', 'type' => 'post'));
            echo $this->Form->input('Region.id',array('type' =>'hidden','value' => $data['Region']['id']));
            echo $this->Form->input('Area.id',array('type' =>'hidden','value' => $data['Area']['id']));
            echo $this->Form->input('House.id',array('type' =>'hidden','value' => $data['House']['id']));            
        ?>
        <input class="mws-button orange" value="Back" type="submit"/>
        </div>
    </div>
    <div id="chart_reportbr_content1" style="font-size:11px"></div>
</div>
            
<?php 
    $url_params = array();
    if( isset($this->data['from_date']) ){
        $url_params['from_date'] = is_numeric($this->data['from_date']) ? $this->data['from_date'] : strtotime($this->data['from_date']);
    }
    if( isset($this->data['till_date']) ){
        $url_params['till_date'] = is_numeric($this->data['till_date']) ? $this->data['till_date'] : strtotime($this->data['till_date']);
    }
    
    $this->Paginator->options(array('url' => $url_params));

    echo $this->Paginator->counter(array(
    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
    ));
?>
            
<div id="paging_block_ms">
    <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
        </div>
    </div>
</div>
<script>
	var base_url = '<?php echo Configure::read('base_url');?>';
        
	$(document).ready(function(){                      
            $("#search").click(function(e){                
                e.preventDefault();
               $("#CouponGetReportTillDateForm").attr('action', base_url+'coupons/coupon_point_till_date');
               $("#CouponGetReportTillDateForm").submit();
            });            
        });
</script>