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
                <?php echo $this->Form->create('Campaign', array('type' => 'post', 'action' => 'target_vs_achieve'));?>
                <div style="display:inline-block;width:100%"> <!-- 1st row start -->
                    <div style="float:left;width:20%">
                            <label>Campaign Name</label>
                    </div>
                    <div style="float:left;width:72%">
                        <?php echo $this->Form->input('id', array('type' => 'select', 'label' => false, 
                            'options' => $campaigns, 'id' => 'ms_code', 'style' => 'width:100%'));?>                           

                    </div>
                </div> <!-- Inner Row End -->						


                <div style="display:inline-block;width:100%; margin-top:10px; margin-bottom:10px;"> <!-- 3rd row start -->
                        <hr />
                    <div style="float:left;width:20%"><label>Start Date</label></div>
                    <div style="float:left;width:30%">
                            <input size="30" class="mws-textinput" name="data[Campaign][from]" onFocus="this.value=''" onClick="showCalendarControl(this);" type="text" value="" />
                    </div>

                    <div style="float:left;width:20%"><label>End Date</label></div>
                    <div style="float:left;width:30%">
                            <input size="30" class="mws-textinput" name="data[Campaign][to]" onFocus="this.value=''" onClick="showCalendarControl(this);" type="text" value="" />
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
	

<script>
</script>

