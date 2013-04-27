<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span style="text-align:center; font-size:18px; color:#fff;">Target vs Achivement</span>
    </div>
</div>

   
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>Query Panel</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-panel-content">
            <div>
                <?php //pr($this->data);?>
                <?php echo $this->Form->create('Campaign', array('type' => 'post', 'action' => 'target_vs_achieve'));?>
                <div style="display:inline-block;width:100%"> <!-- 1st row start -->
                    <div style="float:left;width:20%">
                            <label>Campaign Name</label>
                    </div>
                    <div style="float:left;width:72%">
                        <?php echo $this->Form->input('id', array('type' => 'select', 'label' => false, 
                            'options' => $campaigns, 'empty' => 'All Campaign', 'id' => 'ms_code', 'style' => 'width:100%'));?>                           

                    </div>
                </div> <!-- Inner Row End -->						


                <div style="display:inline-block;width:100%; margin-top:10px; margin-bottom:10px;"> <!-- 3rd row start -->
                        <hr />
                    <div style="float:left;width:20%"><label>Start Date</label></div>
                    <div style="float:left;width:30%">
                            <input size="30" class="mws-textinput" name="data[Campaign][from]" onFocus="this.value=''" onClick="showCalendarControl(this);" type="text" value="<?php echo isset($this->data['from_date']) ? $this->data['from_date'] : '';?>" />
                    </div>

                    <div style="float:left;width:20%"><label>End Date</label></div>
                    <div style="float:left;width:30%">
                            <input size="30" class="mws-textinput" name="data[Campaign][to]" onFocus="this.value=''" onClick="showCalendarControl(this);" type="text" value="<?php echo isset($this->data['till_date']) ? $this->data['till_date'] : '';?>" />
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
        <span>Till Data Achivement</span>
    </div>
    <div class="mws-panel-body">
        <div class="mws-panel-content">
            <div id="reportbr_content" style="clear:both">
                <div id="table_reportbr_content">
                    <div class="cluster_details">
                        <table class="mws-table">
                            <tr class="mws">
                                <td><div class="br_h"><span class="title"><strong>Region</strong></span></div></td>
                                <td><span class="data">Dhaka</span></td>
				<td><div class="br_h"><span class="title"><strong>Total MVP</strong></span></div></td>
                                <td><span class="data">15</span></td>
                            </tr>
                            <tr>
                                <td><div class="br_h"><span class="title"><strong>Area</strong></span></div></td>
                                <td><span class="data">Dhaka South</span></td>
                                <td><div class="br_h"><span class="title"><strong>Total VP</strong></span></div></td>
                                <td><span class="data">20</span></td>
                            </tr>
                            <tr>
                                <td><div class="br_h"><span class="title"><strong>House</strong></span></div></td>
                                <td><span class="data">SPS</span></td>
                                <td><div class="br_h"><span class="title"><strong>Total P</strong></span></div></td>
                                <td><span class="data">45</span></td>
                            </tr>
                            <tr>
                                <td><div class="br_h"><span class="title"><strong>Base Period</strong></span></div></td>
                                <td><span class="data">16-02-13 to 17-02-13</span></td>
                                <td><div class="br_h"><span class="title"><strong></strong></span></div></td>
                                <td><span class="data"></span></td>
                            </tr>
                        </table> 
                        <br /><hr />
				
			<table class="mws-table" style="font-size:11px;">
                            <thead>
                                <tr class="mws">
                                    <th>Region</th>
                                    <th>Area</th>
                                    <th>House</th>
                                    <th>TLP Name</th>
                                    <th>B&amp;H</th>
                                    <th>JPGL</th>
                                    <th>Star</th>
                                    <th>Star L</th>
                                    <th>Capstan</th>
                                    <th>Derby</th>
                                    <th>Pilot</th>
                                    <th>Bristol</th>
                                    <th>Hollywood</th>
                                </tr>
                            </thead>
                            <?php
                                foreach( $sales as $sls ){
                                    echo '<tr class="gradeX"><td>'.$sls['Outlet']['House']['Area']['Region']['title'].'</td><td>'.
                                        $sls['Outlet']['House']['Area']['title'].'</td><td>'.$sls['Outlet']['House']['title'].
                                        '</td><td>'.$sls['Outlet']['title'].'</td><td>'.$sls[0]['total_b1'].'%</td><td>'.$sls[0]['total_b2'].
                                        '%</td><td>'.$sls[0]['total_b3'].'%</td><td>'.$sls[0]['total_b4'].'%</td><td>'.$sls[0]['total_b5'].
                                        '%</td><td>'.$sls[0]['total_b6'].'%</td><td>'.$sls[0]['total_b7'].'%</td><td>'.$sls[0]['total_b8'].
                                        '<td>'.$sls[0]['total_b9'].'%</td></tr>';
                                }
                            ?>
                        </table>
                    <br/>
                    <form id="frmExport" method="post" action="<?php echo Configure::read('base_url').'campaigns/export_achievement';?>">
                        
                        
                        
                        <input type="hidden" name="data[Campaign][id]" value="<?php echo isset($this->request->params['named']['id'])?$this->request->params['named']['id']:'';?>" />
                        <input type="hidden" name="data[Campaign][from]" value="<?php echo isset($this->request->params['named']['from'])?$this->request->params['named']['from']:0;?>" />
                        <input type="hidden" name="data[Campaign][to]" value="<?php echo isset($this->request->params['named']['to'])?$this->request->params['named']['to']:time();?>" />
                        
                        <input class="mws-button blue" value="Export to Excel" type="submit"/>
                    </form>
                    
                </div>
            </div>
            <div id="chart_reportbr_content1" style="font-size:11px"></div>
        </div>
        <div id="paging_block_ms">
            <p>
                <?php
                    echo $this->Paginator->counter(array(
                    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                    ));
                ?>	
            </p>
            <?php
                echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => '', 'class' => 'pagi_link'));
                echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
            ?>
        </div>
    </div>    
    </div>
</div>
<div>
    <? //pr($this->request->params);?>
    
</div>
