<?php
// Title Menu from function.php
$tbl = new dataTable();
$tbl->id = $_GET['setPage'];
$tbl->title = title_menu($_GET['setPage']);
$tbl->menu = MENU_ACTION;
$tbl->module = $_GET['setModule'];
$tbl->page = $_GET['setPage'];
$tbl->order = 3;
$tbl->orderType="desc";
$tbl->openTable();

// List User Group
$sql_list = "SELECT *
				FROM tbl_docs_category ORDER BY docs_cate_updatetime DESC ";
$rs_list = $db->GetAll($sql_list);

?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="display" id="<?=$tbl->id;?>">
  <thead>
    <tr>
      <th width="4%"  class="header_height">จัดการ</th>
      <th width="13%" align="center">รหัสกลุ่มเอกสาร</th>
      <th width="65%" align="center">ชื่อกลุ่มเอกสาร</th>
      <th width="18%" align="center">วันที่ปรับปรุงแก้ไข</th>
    </tr>
  </thead>
  <tbody>
         <?php for($i=0;$i<count($rs_list);$i++){ ?>
            <tr>
              <td align="center"> <input type="radio" name="selID" id="selID_<?=$rs_list[$i]['docs_cate_id']?>" value="<?=$rs_list[$i]['docs_cate_id']?>" <?=$i==0?'checked':''?>/></td>
              <td align="center"><?=$rs_list[$i]['docs_cate_code']?></td>
              <td><?=$rs_list[$i]['docs_cate_name']?></td>
              <td align="center"><?=showdateTimeThai($rs_list[$i]['docs_cate_updatetime']);?></td>
            </tr>
            <?php } // End For ?>
           </tbody>
</table>
<?php 
	$tbl->closeTable(); 
?>
<div id="dialog-form-<?=$_GET['setPage'];?>" title="<?=$tbl->title?>" style="display:none"></div>
<div id="dialog-confirm" title="Comfirm!!">ยืนยันการลบข้อมูล ?</div>
<input type="hidden" name="hidRadio" id="hidRadio" value="<?=$rs_list[0]['docs_cate_id']?>" />
