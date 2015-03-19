<?php
#############################
# Section : Includes Files
require_once("./includes/config.inc.php");
require_once("./includes/Class/ReadDir.Class.php");

$cate = $_GET['cate']; // TRIS , RISK

if($cate == "RISKORG"){
	$cate_name = "RISK MAP : Organization"; 
}else if($cate == "RISKDIV"){
	$cate_name = "RISK MAP : Division"; 
}


$dir  = UPLOADS_DIR.'/'.$cate;

$pics = new ReadDir();
$pics ->dir = $dir;


$perCols = 2; // กำหนดการแสดงรูป

// Get year data
$y = $pics->get_year();

// set year
$pics->years = isset($_GET['years'])  ? $_GET['years'] : $y[0];

// list data in folder
$arrData= $pics->scan_Dir();

?>

<!DOCTYPE HTML>
<html lang="th-th">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="HandheldFriendly" content="true" />
<meta name="apple-mobile-web-app-capable" content="YES" />
<title>
<?=SITE_NAME;?>
</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="css/<?=THEMES?>/jquery-ui.min.js"></script>
<link type="text/css" href="css/main.css" rel="stylesheet" />
<link type="text/css" href="css/<?=THEMES?>/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="css/tipsy.css" type="text/css" />


<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<!--<script type="text/javascript" src="js/jquery.ui.datepicker-th.js"></script>-->
<script type="text/javascript" src="js/main_index.js"></script>

<link rel="stylesheet" href="js/lightbox/colorbox.css" />
<script src="js/lightbox/jquery.colorbox.js"></script>
<link rel="shortcut icon" href="./images/favicon.ico" />
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
		
			$('#years').change(function(){
					var menu  = $('#menu').val();
					if(menu == '1'){
						window.location = '?menu=1&cate='+$('#cate').val()+'&years='+$('#years').val();
					}else{
						window.location = '?cate='+$('#cate').val()+'&years='+$('#years').val();
					}
			});
			
			$(".show_pics").colorbox({rel:'show_pics'});
			
			$( "#tabs" ).tabs();	
			
			$( "button:first" ).button({
			  icons: {
				primary: "ui-icon-newwin"
			  }
			}).click(function(){
				fullscreen('pictures_list.php?menu=1&cate='+$('#cate').val()+'&years='+$('#years').val());
			});
			
			
		function fullscreen(url) {
				var w = $(document).width(); //retrieve current window width
				var h = $(document).height(); //retrieve current window height
			  features = "width="+w+",height="+h;
			  features += ",left=0,top=0,screenX=0,screenY=0,menubar=0,resizable=1,scrollbars=1,status=0,titlebar=0,location=0,toolbar=0";
			
				window.open(url, "", features);		
}
			
	});
</script>
</head>
<body class="main">
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">&nbsp;
      <?=$cate_name;?>
      &nbsp;</a></li>
  </ul>
  <div id="tabs-1">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>เลือกปี :
          <select name="years" id="years" class="input">
            <?php
		foreach($y as $data){
			$sel = $data == $pics->years ? 'selected' : '';
			echo "<option value='$data' $sel>$data</option>";
		}
		
?>
          </select></td>
        <td align="right" valign="middle"><?php
		if(!isset($_GET['menu'])){
        		echo "<button>แสดงหน้าต่างใหม่</button>";
		} ?></td>
      </tr>
    </table>
    <hr>
    <?php
	if(empty($arrData)){ 
			echo "<div class='alCenter'><h3><img src='images/iconError.gif' align='absmiddle' > Not found </h3></div>";
	}else{
		echo "<div align='center' class='gallery' style='width:100%;'>";
		echo "<table border='0' cellpadding='3' cellspacing='4'>";
		$i=0;
			foreach($arrData as $img){
		
				$extension = strtolower(end(explode('.', $img)));
		
				if(in_array( $extension , $pics->img_ext)){ 
					 
					 if($i==0)  echo '<tr>';
					  $i++;
		  				 if($i<=$perCols){   
									echo "<td><a href='./$img' class='show_pics' ><img src='$img' width='450' height='280'></a></td>";	
						   }else{
									echo "<td>&nbsp;</td>\n";  
						  }
						  
			  if ($i==$perCols){
				  $i=0;
				echo "  </tr>\n  ";
				
				  } #END if
				}
				
			}
			echo "</table>\n";
		echo "</div>";
	}
	
?>
  </div>
</div>
<br/>
<input type="hidden" name="cate" id="cate" value="<?=$_GET['cate']?>">
<input type="hidden" name="menu" id="menu" value="<?=$_GET['menu']?>">
</body>
</html>
