    <?php 
    echo $this->Form->create('Sale',array('controller' => 'sales', 'action' => 'index'));?>
    
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>Query Panel</span>
        </div>
        <div class="mws-panel-body">
            <div class="mws-panel-content">
                
                <div>
                    <div style="display:inline-block;width:100%;"> <!-- 1st row start -->
                        <div style="float:left;width:20%;">
                                <label>House</label>
                        </div>
                        <div style="float:left;width:72%;">
                                <?php 
                                echo $this->Form->input('House.id', array('type' => 'select', 
                                'options' => $houses,'empty' => 'All', 'label' => false, 'style' => 'width:100%'));
                                ?>

                        </div>
                    </div>

                    <div style="display:inline-block;width:100%;"> <!-- 1st row start -->
                        <div style="float:left;width:20%;">
                                <label>Value Priority</label>
                        </div>
                        <div style="float:left;width:72%;">
                                <?php 
                                echo $this->Form->input('Outlet.priority', array('type' => 'select', 
                                    'options' => array('MVP' => 'MVP', 'VP' => 'VP', 'P' => 'P'),
                                    'empty' => 'All', 'label' => false, 'style' => 'width:100%'));
                                ?>

                        </div>
                    </div>
                    

                    <div style="display:inline-block;width:100%; margin-top:10px; margin-bottom:10px;"> <!-- 3rd row start -->
                        <div style="float:left;width:20%"><label>Start Date</label></div>
                        <div style="float:left;width:30%">
                            <input size="30" class="mws-textinput"  name="from_date"  onFocus="this.value=''" onClick="showCalendarControl(this);" type="text"  value="<?php echo isset($this->data['from_date']) ? $this->data['from_date'] : '';?>" />
                        </div>

                        <div style="float:left;width:20%"><label>End Date</label></div>
                        <div style="float:left;width:30%">
                                <input size="30" class="mws-textinput" name="till_date" onFocus="this.value=''" onClick="showCalendarControl(this);" type="text" value="<?php echo isset($this->data['till_date']) ? $this->data['till_date'] : '';?>" />
                        </div>			
                    </div> <!-- 3rd row end -->
                    <hr />
                    <input type="submit" id="btn_sales"  class="mws-button blue" value="Submit"/>
                </div>
        </div>
        </div>
    </div>
    
    <?php    
    $url_params = array();

    if( isset($this->data['from_date']) ){
        $url_params['from_date'] = is_numeric($this->data['from_date']) ? $this->data['from_date'] : strtotime($this->data['from_date']);
    }
    if( isset($this->data['till_date']) ){
        $url_params['till_date'] = is_numeric($this->data['till_date']) ? $this->data['till_date'] : strtotime($this->data['till_date']);
    }
    $url_params['region_id'] = $this->data['Region']['id'];
    $url_params['area_id'] = $this->data['Area']['id'];
    $url_params['house_id'] = $this->data['House']['id'];


    $this->Paginator->options(array('url' => $url_params));
    
    //pr($this->data);
    ?>
    
    
    
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>Partner STT</span>
        </div>
        <div class="mws-panel-body">
            <div class="mws-panel-content">
                <div id="reportbr_content" style="clear:both">
                    <div id="table_reportbr_content">
                        <div class="cluster_details">                            
                            
                            <table class="mws-table">
                                <tr class="mws">
                                    <td>
                                        <div class="br_h"> <span class = "title" ><strong>Region</strong></span></td><td><span class="data"><?php echo $titles['region_title'];?></span></div>
                                        <input type="hidden" name="data[Region][id]" value="<?php echo $this->data['Region']['id'];?>"/>        
                                    </td>
                                    <td><div class="br_h"><span class="title"><strong>Total MVP</strong></span></td>
                                    <td><span class="data"><?php echo isset($outlet_by_priority['MVP']) ? $outlet_by_priority['MVP'] : 0;?></span></div></td>
                                </tr>
                                <tr>
                                    <td><div class="br_h"><span class="title"><strong>Area</strong></span></td>
                                    <td><span class="data"><?php echo $titles['area_title'];?></span></div></td>
                                    <input type="hidden" name="data[Area][id]" value="<?php echo $this->data['Area']['id'];?>"/>        
                                    <td><div class="br_h"><span class="title"><strong>Total VP</strong></span></td>
                                    <td><span class="data"><?php echo isset($outlet_by_priority['VP']) ? $outlet_by_priority['VP'] : 0;?></span></div></td>
                                </tr>
                                <tr>
                                    <td><div class="br_h"><span class="title"><strong>House</strong></span></td><td><span class="data"><?php echo $titles['house_title'];?></span></div></td>
                                    <td><div class="br_h"><span class="title"><strong>Total P</strong></span></td>
                                    <td><span class="data"><?php echo isset($outlet_by_priority['P']) ? $outlet_by_priority['P'] : 0;?></span></div></td>
                                    <input type="hidden" name="data[House][id]" id="hdn_house_id" value="<?php echo $this->data['House']['id'];?>"/>
                                </tr>
                            </table> <br /><hr />
	<table  class="mws-table" style="font-size:11px;">
	<tr class="mws">
            <th>Region</th>
            <th>Area</th>
            <th>House</th>
            <th>Section</th>
            <th>TLP Name</th>
            <th>Representative</th>
            <?php
                foreach( $productsList as $pd ){
                    echo '<th>'.$pd.'</th>';
                }
            ?>
            <th>Date &amp; Time</th>            
	</tr>
	<?php         //pr($sales);
        foreach ($sales as $sale): ?>
	<tr class="gradeA">
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
		<?php
                    foreach($productsList as $k => $pl){
                        $found = false;
                        foreach( $sale['SaleDetail'] as $sD ){
                            if( $k==$sD['product_id']){
                                echo '<td>'.$sD['quantity'].'</td>';
                                $found = true;
                                break;
                            }
                        }
                        if( !$found ){
                            echo '<td>0</td>';
                        }
                    }
                    ?>
                    
                <td><?php echo $sale['Sale']['date']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>
            </div>
                        <br/>
	<p>
	<?php
        
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => '&nbsp;|&nbsp;'));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>   
        <br />
        
        <input type="submit" name="export_sale_report" id="export_sale_report" class="mws-button blue" value="Export to Excel" />
                </div>
            </div>
        </div>
    </div>
</div>

<?php //echo $this->Js->writeBuffer(); ?>

<script>
	var base_url = '<?php echo Configure::read('base_url');?>';
        
	$(document).ready(function(){
            
            $("#export_sale_report").click(function(){                
               $("#SaleIndexForm").attr('action', base_url+'sales/get_report');
               $("#SaleIndexForm").submit();
            });
            
            $("#btn_sales").click( function(){
                $("#SaleIndexForm").attr('action', base_url+'sales/index');
                $("#SaleIndexForm").submit();
            });           
                
            $("#HouseId").change(function(){
               $("#hdn_house_id").val($(this).val());
            });
	});
</script>
