<?php
$tbl = new dataTable();
$tbl->id = $_GET['setPage'];
$tbl->title = title_menu($_GET['setPage']);
$tbl->menu = MENU_ACTION;
$tbl->module = $_GET['setModule'];
$tbl->page = $_GET['setPage'];
$tbl->order = 1;

$tbl->openTable();

// List Menu Group
$sql_list = "SELECT
						 a.mgroup_id,
						 a.menu_group_th,
						 a.menu_group_en,
						 a.menu_path,
						 a.icon_id,
						 a.menu_order,
						 b.icon_name
					FROM tbl_menu_group a
						 LEFT JOIN tbl_icons b
						   ON a.icon_id = b.icon_id
					ORDER BY a.menu_order ";
$rs_list = $db->GetAll($sql_list);


?>

<table width='100%' border='0' cellpadding='0' cellspacing='0' class='display' id='<?=$tbl->id;?>'>
  <thead>
    <tr>
      <th width='8%' class="header_height">จัดการ</th>
      <th width='11%'>ลำดับเมนู</th>
      <th width='26%'>ชื่อกลุ่มเมนู (ไทย)</th>
      <th width='25%'>ชื่อกลุ่มเมนู (อังกฤษ)</th>
      <th width='19%'>Path ที่อยู่โปรแกรม</th>
      <th width='11%'>ไอคอน</th>
    </tr>
  </thead>
  <tbody>
    <?php for($i=0;$i<count($rs_list);$i++){ ?>
    <tr>
      <td align='center'><input type="radio" name="selID" id="selID_<?=$rs_list[$i]['mgroup_id']?>" value="<?=$rs_list[$i]['mgroup_id']?>" <?=$i==0?'checked':''?>/></td>
      <td align='center'><?=$rs_list[$i]['menu_order']?></td>
      <td><?=$rs_list[$i]['menu_group_th']?></td>
      <td><?=$rs_list[$i]['menu_group_en']?></td>
      <td><?=$rs_list[$i]['menu_path']?></td>
      <td align='center'><img src='./images/menu_actions/<?=$rs_list[$i]['icon_name']?>'/></td>
    </tr>
       <?php }  // End For ?>

  </tbody>
</table>
<?php 
	$tbl->closeTable(); 
?>
<div id="dialog-form-<?=$tbl->page;?>" title="<?=$tbl->title?>" style="display:none"></div>
<div id="dialog-confirm" title="Comfirm!!">ยืนยันการลบข้อมูล ?</div>
<input type="hidden" name="hidRadio" id="hidRadio" value="<?=$rs_list[0]['mgroup_id']?>" />