<?php
#############################
# Section : Includes Files
require_once("../../includes/config.inc.php");
require_once("../../includes/Class/ReadDir.Class.php");

$dir  = "images";

$pics = new ReadDir();
$pics ->dir = $dir;

$perCols = 3; // กำหนดการแสดงรูป

// list data in folder
$arrData= $pics->scanDir();


$title = "Subnetwork Configurations";

?>

<!DOCTYPE HTML>
<html lang="th-th">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="HandheldFriendly" content="true" />
<meta name="apple-mobile-web-app-capable" content="YES" />
<title>
<?=$title;?>
</title>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../css/<?=THEMES?>/jquery-ui.min.js"></script>
<link type="text/css" href="../../css/main.css" rel="stylesheet" />
<link type="text/css" href="../../css/<?=THEMES?>/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="../../css/tipsy.css" type="text/css" />
<script type="text/javascript" src="../../js/jquery.tipsy.js"></script>
<!--<script type="text/javascript" src="js/jquery.ui.datepicker-th.js"></script>-->
<script type="text/javascript" src="../../js/main_index.js"></script>
<link rel="stylesheet" href="../../js/lightbox/colorbox.css" />
<script src="../../js/lightbox/jquery.colorbox.js"></script>
<style type="text/css">
body {
	font-family:Tahoma, Geneva, sans-serif;
	font-size:12px;
	background-color:#FFF;
}
.main {
	padding: 5px 10px 0 10px;
}
.gallery {
	padding: 5px;
}
a img {
	-moz-border-radius-topleft: 5px;
	-moz-border-radius-topright: 5px;
	border-top-right-radius: 5px;
	border-top-left-radius: 5px;
	border-radius: 5px;
	-moz-border-radius: 5px;
	box-shadow: 0 0 5px #888;
	-moz-box-shadow: 0 0 5px #888;
	-webkit-box-shadow: 0 0 5px #888;
	padding:8px;
	background-color:#FFF;
	border-color:#FFF;
}
.space {
	padding:7px;
}
</style>
<script type="text/javascript">
	$(function(){
		
			$(".btnData").button().click(function(){
					$("#showImage").attr({ src : "./images/"+$(this).text()});
					$("#showImage").attr({ title : "./images/"+$(this).text()});
					$("#labelImage").text($(this).text());
			});
			
			$("#labelImage").text($(".btnData:eq( 0 )").text());
			
			
			$(".show_pics").colorbox({rel:'show_pics'});
			
			$( "#tabs" ).tabs();	
			
			
	
	});
</script>
</head>
<body class="main">
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">&nbsp;
      <?=$title;?>
      &nbsp;</a></li>
  </ul>
  <div id="tabs-1"><br>
  <label class="ui-state-highlight">&nbsp;*เลือก Subnetwork ที่ต้องการดู&nbsp; </label>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <?php
   	echo "<table border='0' cellpadding='3' cellspacing='4' width='100%'>";
		$i=0;
			foreach($arrData as $data){
		
			$newData = str_replace("images/","",$data);	
			$newData1 = str_replace(".jpg","",$newData);		
					 
					 if($i==0)  echo "<tr'>";
					
					  $i++;
		  				 if($i<=$perCols){   
									echo "<td><div id='$newData' class='btnData'>".$newData1."</div></td>";	
						   }else{
									echo "<td>&nbsp;</td>\n";  
						  }
						  
			  if ($i==$perCols){
				  $i=0;
				echo "  </tr>\n  ";
				
			
				}else{
					$labelDefault  = "";
				}
				
			}
			echo "</table>\n";
            
            ?>
        <td width="47%" align="right" valign="middle"></td>
      </tr>
    </table>
    <hr>
    <br>
    <div id="divImage" align="center"><a href='images/ALC_P34_STM64 RING.jpg' class='_show_pics' title="ALC_P34_STM64 RING.jpg" ><img src="images/ALC_P34_STM64 RING.jpg" id="showImage"></a>
      <h4><div id="labelImage"><?=str_replace(".jpg","",$labelDefault); ?></div></h4>
    </div>
  </div>
</div>
<br/>
<input type="hidden" name="cate" id="cate" value="<?=$_GET['cate']?>">
<input type="hidden" name="menu" id="menu" value="<?=$_GET['menu']?>">
</body>
</html>
