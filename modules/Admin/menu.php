<?php
// Title Menu from function.php
$tbl = new dataTable();
$tbl->id = $_GET['setPage'];
$tbl->title = title_menu($_GET['setPage']);
//$tbl->menu = MENU_ACTION;
$tbl->module = $_GET['setModule'];
$tbl->page = $_GET['setPage'];
$tbl->order = 1;

$tbl->openTable();

// หาค่ากลุ่มเมนู
$sql_mgroup = "SELECT * FROM tbl_menu_group ORDER BY mgroup_id";
$rs_mgroup = $db->GetAll($sql_mgroup);

//ถ้ามีการเลือกให้ where ตามค่าที่เลือก ถ้าไม่ ให้เอาค่า mgroup_id มา where
$get_mgroup = $_GET['mgroup_id'] ? " ".$_GET['mgroup_id'] : $rs_mgroup[0]['mgroup_id'];

// List Menu Group
$sql_list = "SELECT
					 a.menu_id,
					 a.menu_name_th,
					 a.menu_name_en,
					 a.menu_file,
					 a.mgroup_id,
					 a.menu_id,
					 a.menu_order,
					 a.icon_id,
					 b.icon_name
				FROM tbl_menu AS a
					 LEFT JOIN tbl_icons b
					   ON a.icon_id = b.icon_id
				WHERE a.mgroup_id = $get_mgroup
				ORDER BY a.menu_order  ";
$rs_list = $db->GetAll($sql_list);


?>

<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td align="left" valign="middle">กลุ่มเมนู :
      <label>
        <select name="mgroup_id" id="mgroup_id" class="input">
          <?php					  
					  genOptionSelect($rs_mgroup,'mgroup_id','menu_group_th',$_GET['mgroup_id']);
		  ?>
        </select>
      </label></td>
    <td align="right" valign="top"><?=MENU_ACTION?></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="display" id="<?=$tbl->id;?>">
  <thead>
    <tr>
      <th width="7%"  class="header_height">จัดการ</th>
      <th width="9%">ลำดับเมนู</th>
      <th width="33%">ชื่อเมนู (ไทย)</th>
      <th width="25%">ชื่อเมนู (อังกฤษ)</th>
      <th width="16%">ชื่อไฟล์เมนู</th>
      <th width="10%">ไอคอน</th>
    </tr>
  </thead>
  <tbody>
    <?php for($i=0;$i<count($rs_list);$i++){ ?>
    <tr>
      <td align="center"><input type="radio" name="selID" id="selID_<?=$rs_list[$i]['menu_id']?>" value="<?=$rs_list[$i]['menu_id']?>" <?=$i==0?'checked':''?>/></td>
      <td align="center"><?=$rs_list[$i]['menu_order']?></td>
      <td><?=$rs_list[$i]['menu_name_th']?></td>
      <td><?=$rs_list[$i]['menu_name_en']?></td>
      <td><?=$rs_list[$i]['menu_file']?></td>
      <td align="center"><img src='./images/menu_actions/<?=$rs_list[$i]['icon_name']?>'/></td>
    </tr>
    <?php } // End For ?>
  </tbody>
</table>
<?php 
	$tbl->closeTable(); 
?>
<div id="dialog-form-<?=$tbl->page;?>" title="<?=$tbl->title?>" style="display:none"></div>
<div id="dialog-confirm" title="Comfirm!!">ยืนยันการลบข้อมูล ?</div>
<input type="hidden" name="hidRadio" id="hidRadio" value="<?=$rs_list[0]['menu_id']?>" />
<div id="test"></div>