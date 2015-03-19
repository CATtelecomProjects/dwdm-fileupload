<?php
// Title Menu from function.php
$tbl = new dataTable();
$tbl->id = $_GET['setPage'];
$tbl->title = title_menu($_GET['setPage']);
$tbl->menu = MENU_ACTION;
$tbl->module = $_GET['setModule'];
$tbl->page = $_GET['setPage'];
$tbl->order = 2;

$tbl->openTable();

// List User Group
$sql_list = "SELECT *
				FROM tbl_user_group ORDER BY group_name ";
$rs_list = $db->GetAll($sql_list);

?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="display" id="<?=$tbl->id;?>">
  <thead>
    <tr>
      <th width="5%"  class="header_height">จัดการ</th>
      <th width="13%" align="center">รหัสกลุ่มผู้ใช้งาน</th>
      <th width="82%" align="center">ชื่อกลุ่มผู้ใช้งาน</th>
    </tr>
  </thead>
  <tbody>
         <?php for($i=0;$i<count($rs_list);$i++){ ?>
            <tr>
              <td align="center"> <input type="radio" name="selID" id="selID_<?=$rs_list[$i]['group_id']?>" value="<?=$rs_list[$i]['group_id']?>" <?=$i==0?'checked':''?>/></td>
              <td align="center"><?=$rs_list[$i]['group_id']?></td>
              <td><?=$rs_list[$i]['group_name']?></td>
            </tr>
            <?php } // End For ?>
           </tbody>
</table>
<?php 
	$tbl->closeTable(); 
?>
<div id="dialog-form-<?=$_GET['setPage'];?>" title="<?=$tbl->title?>" style="display:none"></div>
<div id="dialog-confirm" title="Comfirm!!">ยืนยันการลบข้อมูล ?</div>
<input type="hidden" name="hidRadio" id="hidRadio" value="<?=$rs_list[0]['group_id']?>" />
