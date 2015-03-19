<?php
class dataTable{
	
	var $module;
	var $page;
	var $title;
	var $menu;
	var $id;
	var $order = 1;
	var $paging = true; // กำหนดค่ากำแสดง Paging true = แสดง / false = ซ่อน
	var $pagingLength = 10;  // กำหนดค่า Default ในการแสดงต่อหน้า
	var $pagingStart =0;		// กำหนดค่าเริ่มต้นการแสดง Pag
	var $pagingEnd =10;    // กำหนดค่าสิ้นสุดการแสดง
	var $orderType = 'asc';

	function openTemplate(){
		echo "<style type='text/css' title='currentStyle'>\n";
		echo "	@import './js/jquery.dataTables/css/table_jui.css';\n";
		echo "	@import './js/jquery.dataTables/css/table.css';\n";
		echo "	@import './js/jquery.dataTables/css/page.css';\n";
		echo "</style>\n";
		echo "<script type='text/javascript' language='javascript' src='./js/jquery.dataTables/jquery.dataTables.js'></script>\n";
		echo "<script type='text/javascript' src='./modules/".$this->module."/".$this->page.".js'></script>";
		echo "<script type='text/javascript'>";
		echo "$(function(){";			
		echo "	var oTable_".$this->id." = $('#".$this->id."').dataTable({";
		echo "				'bJQueryUI': true,";
		echo "				'bStateSave': false,";
		echo "				'sPaginationType': 'full_numbers',";
		echo "               'bPaginate': '".$this->paging."', ";
		echo "               'iDisplayLength' : ".$this->pagingLength." ,";
		echo "               'iDisplayStart': ".$this->pagingStart." ,";
		echo "               'iDisplayEnd' : ".$this->pagingEnd." ,";		
		echo "				'aaSorting': [[ ".$this->order.", '$this->orderType' ]]";
		echo "				});";
		echo "});";
		echo "</script>";
		echo "	<div id='container'>\n";
		echo "	<div class='pages_jui'>\n";		
} // End function";


	function openTable(){
		
			echo "<table width='100%' border='0' cellpadding='0' cellspacing='0' class='ui-widget-content' id='tbl_content'>";
			echo "  <tr>";
			echo "  <td><table width='100%' border='0' cellspacing='1' cellpadding='2'>";
			echo "  <tr>";
			echo "  <td width='100%' align='right'><table width='100%' border='0' cellspacing='0' cellpadding='0'>";
			echo "  <tr>";
			echo "  <td align='left' valign='middle' height='20'><div class='txt_header'> <b>".$this->title." </b></div></td>";
			echo "  <td align='right' valign='top'>".$this->menu."</td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "  <td colspan='2' align='left' valign='middle' style='height:3px'></td>";
			echo "  </tr>";
			echo "  <tr>";
			echo "  <td colspan='2' align='left' valign='middle'>";			
			$this->openTemplate();			
			echo "<div id='data_detail'>";
	} // End Function
			
	function closeTable(){		
			echo "     </div>";			
			$this->closeTemplate();			
			echo "</td>";
			echo "  </tr>";
			echo "</table></td>";
			echo "  </tr>";
			echo "</table></td>";
			echo "  </tr>";
			echo "</table>";
	} // End Function


	function closeTemplate(){		
	  	echo "</div>\n";
	  	echo "<div class='spacer'></div>\n";
		echo "</div>\n";	
	} // End function
	
}// End Class
?>