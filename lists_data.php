<?php
#############################
# Section : Includes Files
require_once("./includes/config.inc.php");
require_once("./includes/Class/ReadDir.Class.php");

$modules = $_GET['modules']; // TRIS , RISK

$docRoot = $_SERVER['DOCUMENT_ROOT']."/FTPROOT";

$arrConfig = array("WIRELESS"=>array("path"=>"/NUA/nua_wireless",
															"title"=>"Ticket Analysis Reports")
						);

$path = $arrConfig[$modules]['path'];
$title = $arrConfig[$modules]['title'];


$dir  = $docRoot.$path;

$pics = new ReadDir();
$pics ->dir = $dir;


$perCols = 1; // กำหนดการแสดงรูป

// Get year data
$y = $pics->get_year();

// set year
$pics->years = isset($_GET['years'])  ? $_GET['years'] : $y[0];

// list data in folder
$arrData= $pics->scanDir();

//show_array($arrData);

?>

<!DOCTYPE HTML>
<html lang="th-th">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	padding: 5px 5px 0 5px;
}
.gallery {
	padding: 5px;
}
/*a img {
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
}*/
.space {
	padding:7px;
}

.text-small {
	font-size:9px;	
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
      <?=$title?>
      &nbsp;</a></li>
  </ul>
  <div id="tabs-1">
   <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>เลือกปี :
          <select name="years" id="years" class="input">
            <?php
	//	foreach($y as $data){
	//		$sel = $data == $pics->years ? 'selected' : '';
	//		echo "<option value='$data' $sel>$data</option>";
	//	}
		
?>
          </select></td>
        <td align="right" valign="middle"><?php
	//	if(!isset($_GET['menu'])){
    //    		echo "<button>แสดงหน้าต่างใหม่</button>";
	//	} ?></td>
      </tr>
    </table>
    <hr>-->
    <?php
	if(empty($arrData)){ 
			echo "<div class='alCenter'><h5><img src='images/iconError.gif' align='absmiddle' > ยังไม่มีการอัพโหลดเอกสาร </h5></div>";
	}else{
		echo "<div  class='gallery' style='width:95%;'>";
		echo "<table border='0' cellpadding='2' cellspacing='0'>";
		$i=0;
			foreach($arrData as $data){

				$extension = strtolower(end(explode('.', $data)));
		
				$newDataLink = str_replace($dir,$path,$data);	
				$newData = str_replace($path."/","",$newDataLink);	
				
				$fileModify = date ("Y-m-d H:i:s", filemtime($data));
				
				$arrList[$fileModify]['link'] = $newDataLink;
				$arrList[$fileModify]['newData'] = $newData;
				$arrList[$fileModify]['time'] = $fileModify;
							
			}


			krsort($arrList);

			foreach($arrList as $data){
			//	if(in_array( $extension , $pics->img_ext)){ 
					 
					 if($i==0)  echo '<tr>';
					  $i++;
		  				 if($i<=$perCols){   
									echo "<td align='left'><span class='text-smasll'>".$data['time']." </span> -  ".show_icon($data['newData'])." <a href='../".iconv('TIS620','UTF-8',$data['link'])."' target='_blank'>".iconv('TIS620','UTF-8',$data['newData'])."</a> </td>";	
						   }else{
									echo "<td>&nbsp;</td>\n";  
						  }
						  
			  if ($i==$perCols){
				  $i=0;
				echo "  </tr>\n  ";
				
			//	  } #END if
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
