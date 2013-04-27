<!-- Script By Hscripts.com -->
<link href="paging.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	function showLoader(){
	
		$('.search-background').fadeIn(200);
	}
	
	function hideLoader(){
	
		$('.search-background').fadeOut(200);
	};
	
	$("#paging_button li").click(function(){
		
		showLoader();
		$("#paging_button li").css({'background-color' : ''});
		$(this).css({'background-color' : '#006699'});

		$("#content").load("page.php?page=" + this.id, hideLoader);
		
		return false;
	});
	
	$("#1").css({'background-color' : '#006699'});
	showLoader();
	$("#content").load("page.php?page=1", hideLoader);
	
});
</script>

<?php
$per_page = 2;
include 'config.php';
$link=mysql_connect("$hostname","$username","$password")or 
die('Could not connect: ' . mysql_error());
if(mysql_select_db("$dbname",$link)) 
{
$count=mysql_query("select count(*) from $tablename");
while ($row2 = mysql_fetch_row($count)) 
{
   $total=$row2[0];
}
$pages = ceil($total/$per_page);
}
?>
<div align="center" id='content1'>
		<div class="search-background">
			<label><img src="loader.gif" alt="" /></label>
		</div>
		<div id="content">
		&nbsp;
		</div>
<table id="paging_button" align="center" style='margin-left: 375px;'>
<tr><td>
		<ul>
		<?php
		//Show page links
		for($i=1; $i<=$pages; $i++)
		{
			echo '<li id="'.$i.'">'.$i.'</li>';
		}?>
		</ul>
	</td></tr></table>
</div>
<div align=center style='font-size: 10px; color: #efefef;'>&copy;h</div>

<!-- Script By Hscripts.com -->