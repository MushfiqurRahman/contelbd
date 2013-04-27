<h2><?php echo $target_details[0]['title']; ?></h2>

<table>
    <tr>
        <th>Region</th><th>Area</th><th>House</th><th>Outlet</th><th>B1</th><th>B2</th><th>B3</th><th>B4</th>
        <th>B5</th><th>B6</th><th>B7</th><th>B8</th><th>B9</th><th>B10</th><th>B11</th></tr>

<?php
    foreach( $target_details as $td ){
        echo '<tr><td>'.$td['region'].'</td><td>'.$td['area'].'</td><td>'.$td['house'].'</td><td>'.$td['outlet'].
                '</td><td>'.$td['target_b1'].'</td><td>'.$td['target_b2'].'</td><td>'.$td['target_b3'].'</td><td>'.
                $td['target_b4'].'</td><td>'.$td['target_b5'].'</td><td>'.$td['target_b6'].'</td><td>'.$td['target_b7'].
                '</td><td>'.$td['target_b8'].'</td><td>'.$td['target_b9'].'</td><td>'.$td['target_b10'].'</td><td>'.
                $td['target_b11'].'</td></tr>';
    }
?>
</table>

<?php echo $this->Form->create('Campaign',array('action' => 'target_report', 'type' => 'post'));
echo $this->Form->input('campaign_id', array('type' => 'hidden', 'value' => $this->request->params['pass'][0]));
echo $this->Form->end('Export');
?>