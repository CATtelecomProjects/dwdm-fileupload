<?php
// Title Menu from function.php
$tbl = new dataTable();
$tbl->id = $_GET['setPage'];
$tbl->title = title_menu($_GET['setPage']);
//$tbl->menu = MENU_ACTION;
$tbl->module = $_GET['setModule'];
$tbl->page = $_GET['setPage'];
$tbl->order = 4;
$tbl->orderType="desc";
$tbl->openTable();


// หาค่ากลุ่มผู้ใช้งาน  
$sql_usergroup = "SELECT * FROM tbl_user_group ORDER BY group_name";
$rs_usergroup = $db->GetAll($sql_usergroup);

//ถ้ามีการเลือกให้ where ตามค่าที่เลือก ถ้าไม่ ให้เอาค่า group_id มา where
$get_group = $_GET['group_id'] ? " ".$_GET['group_id'] : $rs_usergroup[0]['group_id'];


// List User 
/* $sql_list = "SELECT user_id ,username, passwords, emp_code, first_name, last_name, email, gender, telephone, prefix_id, position_id
				FROM tbl_users ";*/
				
// เงื่อนไขการแสดง
if($_GET['group_id'] && $_GET['group_id'] <> "All"){
	$str_query	= "WHERE b.group_id = $get_group";
}else{
	$str_query = "";
}
$sql_list = "SELECT
						  a.user_id,
						  a.username,
						  a.password,
						  a.first_name,
						  a.updatetime
				FROM tbl_users a
				  LEFT JOIN tbl_user_auth b
					ON a.user_id = b.user_id 
				$str_query
				GROUP BY a.user_id
				ORDER BY a.updatetime DESC";				
$rs_list = $db->GetAll($sql_list);

?>
<script type="text/javascript" src="./includes/SpryAssets/SpryValidationConfirm.js"></script>
<link rel="stylesheet" type="text/css" href="./includes/SpryAssets/SpryValidationConfirm.css" />
<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td align="left" valign="middle">กลุ่มผู้ใช้งาน :
      <label>
        <select name="group_id" id="group_id">
        <option value="All">แสดงทั้งหมด</option>
          <?php					  
					  genOptionSelect($rs_usergroup,'group_id','group_name',$_GET['group_id']);
		  ?>          
        </select>
      </label></td>
    <td align="right" valign="top"><?=MENU_ACTION?></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="display" id="<?=$tbl->id;?>">
  <thead>
    <tr>
      <th width="9%"  class="header_height">จัดการ</th>
      <th width="23%">ชื่อผู้ใช้งาน</th>
      <th width="18%">รหัสผ่าน</th>
      <th width="28%">รายละเอียดผู้ใช้งาน</th>
      <th width="22%">วันที่ปรับปรุงแก้ไข</th>
    </tr>
  </thead>
  <tbody>
    <?php for($i=0;$i<count($rs_list);$i++){ ?>
    <tr>
      <td align="center"><label>
          <input type="radio" name="selID" id="selID_<?=$rs_list[$i]['user_id']?>" value="<?=$rs_list[$i]['user_id']?>" <?=$i==0?'checked':''?>/>
        </label></td>
      <td><?=$rs_list[$i]['username']?></td>
      <td><?=base64_decode($rs_list[$i]['password'])?></td>
      <td><?=$rs_list[$i]['first_name']?></td>
      <td align="center"><?=showdateTimeThai($rs_list[$i]['updatetime']);?></td>
    </tr>
    <?php } // End for ?>
  </tbody>
</table>
<?php 
	$tbl->closeTable(); 
?>
<div id="dialog-form-<?=$_GET['setPage'];?>" title="<?=$tbl->title?>" style="display:block"></div>
<div id="dialog-confirm" title="Comfirm!!">ยืนยันการลบข้อมูล ?</div>
<input type="hidden" name="hidRadio" id="hidRadio" value="<?=$rs_list[0]['user_id']?>" />
