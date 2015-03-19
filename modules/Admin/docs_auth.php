<?php
// Title Menu from function.php
$tbl = new dataTable();
//$tbl->paging= false;
$tbl->id = $_GET['setPage'];
$tbl->title = title_menu($_GET['setPage']);
//$tbl->menu = MENU_SAVE_ONLY;
$tbl->module = $_GET['setModule'];
$tbl->page = $_GET['setPage'];
$tbl->paging = false;
$tbl->pagingLength = '100';
$tbl->pagingEnd = '100';
$tbl->order = 1;
$tbl->openTable();

$db->debug = 0;

// หาค่ากลุ่มเมนู
$sql_group = "SELECT * FROM tbl_user_group ORDER BY group_id ";
$rs_group = $db->GetAll($sql_group);

//ถ้ามีการเลือกให้ where ตามค่าที่เลือก ถ้าไม่ ให้เอาค่า mgroup_id มา where
$get_mgroup = $_GET['group_id'] ? " ".$_GET['group_id'] : $rs_group[0]['group_id'];


// หาสิทธิ์การเข้าใ้ช้งานเมนูตามเงื่อนไข
 $sql_docs_auth = "SELECT * FROM tbl_docs_auth WHERE group_id = $get_mgroup";
$rs_docs_auth = $db->GetAll($sql_docs_auth);

for($a=0;$a<count($rs_docs_auth);$a++){
	$Arr_docs_auth[] = $rs_docs_auth[$a]['docs_cate_id'];
}
?>
<form name="form_docs_auth" id="form_docs_auth" method="post" />
<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td width="41%" align="left" valign="middle">กลุ่มผู้ใช้งาน :
      <label>
        <select name="group_id" id="group_id">
          <?php					  
					  genOptionSelect($rs_group,'group_id','group_name',$_GET['group_id']);
		  ?>
        </select>
      </label></td>
    <td width="24%" align="right" valign="bottom"><?=MENU_SAVE_ONLY?><span id="ajaxloading"> กำลังบันทึก...</span> </td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="display" id="<?=$tbl->id;?>">
  <thead>
    <tr>
      <th width="8%"  class="header_height">ลำดับ
      <th width="72%"  class="header_height">กลุ่มเอกสาร
      <th width="20%" align="center">        สิทธิ์การใช้งาน </th>
    </tr>
  </thead>
  <tbody>
  
  
  
    <?php
			// หาเมนูย่อย
			
			$sql_docs_cate =  "SELECT
												*
											FROM tbl_docs_category ORDER BY docs_cate_name 
											";
				$rs_docs_cate = $db->GetAll($sql_docs_cate);
				
				for($j=0;$j<count($rs_docs_cate);$j++){ // Loop Sub menu	
						$loop++;							
					
					// ตรวจสอบสถานะสิทธิ์การใช้งาน Checked
					$chk_docs_cate = $rs_docs_cate[$j]['docs_cate_id'];
					 if(@in_array($chk_docs_cate ,$Arr_docs_auth)){
						$chk_status = "checked";
					}else{
						$chk_status = "";
					}//  End ===
					
						
			?>                    
                  <tr>
                      <td align="center"><?=$loop?></td>
                      <td>&nbsp; <?=$rs_docs_cate[$j]['docs_cate_name']?></td>
                      <td align="center"><input type="checkbox" name="chk_docs[]" id="chk_menu" value="<?=$rs_docs_cate[$j]['docs_cate_id']?>" <?=$chk_status?> /></td>
    </tr>
    
    <?php 
				} // Emd loop เมนูย่อย
	$loop++;
 ?>
    
  </tbody>
</table>

<?php 
	$tbl->closeTable(); 
?>
<input type="hidden" name="doAction" id="doAction" />
</form>
<div id="divMsg"></div>