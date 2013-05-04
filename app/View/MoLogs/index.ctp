<?php
    if( !empty($mo_logs) ){?>
      <table><tr><th>ID</th><th>MSISDN</th><th>SMS</th><th>Keyword</th><th>Date & Time</th><th>Action</th></tr>
      <?php
        foreach($mo_logs as $ml){
            echo '<tr><td>'.$ml['MoLog']['id'].'</td><td>'.$ml['MoLog']['msisdn'].'</td><td>'.$ml['MoLog']['sms'].
                    '</td><td>'.$ml['MoLog']['keyword'].'</td><td>'.$ml['MoLog']['datetime'].'</td><td>';
            
            echo $this->Html->link('Delete',array('controller' => 'MoLogs','action'=>'delete','id' =>$ml['MoLog']['id']),
                    array('Are you sure you want to delete the log?'));
                    
        }
      ?>
    <?php    
    }
    ?>