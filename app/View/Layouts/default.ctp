<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'ContelBD Mobile based reporting system');
?>
<!DOCTYPE html>
<html>
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Apple iOS and Android stuff (do not remove) -->
<meta name="apple-mobile-web-app-capable" content="no" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1" />


	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>

<?php
    echo $this->Html->css(array('reset','text', 'fonts/ptsans/stylesheet','fluid','mws.style',
        'icons/16x16','icons/24x24','icons/32x32', 'demo', 'jui/jquery.ui', 'mws.theme', 'CalendarControl',
        'paging', 'reportbr', 'ticker-style'));
    
    echo $this->Html->script(array('jquery-1.7.1.min','jquery.mousewheel-min','jquery-ui',
        'jquery.ui.touch-punch.min','mws','datatables/jquery.dataTables-min','CalendarControl',
        'jquery.ticker','site'));
?>
<!-- From Coder Header -->
<link rel="shortcut icon" href="<?php echo Configure::read('base_url').'img/favicon.ico';?>" />
</head>

<body>
    <div id="mws-wrapper">
        
        
        <?php echo $this->element('sidebar');?> 
        
        <div id="mws-container" class="clearfix">

            <div class="container">
                
                <?php echo $this->element('report_container');?>

                        <?php echo $this->Session->flash(); ?>

                        <?php echo $this->fetch('content'); ?>
                    <?php 
                        echo $this->Html->link('Home',array('controller' => 'pages', 'action' => 'display'));
                        echo ' | '.$this->Html->link('SS/SR/TSA', array('controller' => 'representatives','action' => 'index'));
                        echo ' | '.$this->Html->link('Brands', array('controller' => 'brands','action' => 'index'));
                        echo ' | '.$this->Html->link('Products', array('controller' => 'products','action' => 'index'));
                        echo ' | '.$this->Html->link('Regions', array('controller' => 'regions','action' => 'index'));
                        echo ' | '.$this->Html->link('Areas', array('controller' => 'areas','action' => 'index'));
                        echo ' | '.$this->Html->link('Houses', array('controller' => 'houses','action' => 'index'));
                        echo ' | '.$this->Html->link('Sections', array('controller' => 'sections','action' => 'index'));
                    ?>
                
            </div>


        </div>
                
                
        <div id="footer">               
        </div>
                
    </div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
