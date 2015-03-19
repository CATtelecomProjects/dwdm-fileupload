<?php

// Title Menu from function.php
$title = title_menu($_GET['setPage']);


$user_id = $_SESSION['sess_user_id'];

if(!$_SESSION['sess_user_id']) return;

// แสดงรายละเอียด
$sql_profile = "SELECT
									 a.*,
									 b.position_name
								FROM tbl_users a
									 LEFT JOIN tbl_positions b
									   ON a.position_id = b.position_id
								WHERE user_id = $user_id";
$rs_profile = $db->GetRow($sql_profile);

// หาค่ากลุ่มผู้ใช้งาน
if(!$rs_profile) return;

$sql_user_gruop = "SELECT
								 b.*
							FROM tbl_user_auth a,
								 tbl_user_group b
							WHERE a.group_id = b.group_id
								   AND a.user_id = $user_id ";

$rs_user_group =$db->GetAll($sql_user_gruop);


// หาค่าไซต์งานที่สังกัด
if(!$rs_profile) return;
$sql_user_site = "SELECT
								 b.site_id,
								 b.site_name
							FROM tbl_user_on_site a,
								 tbl_sites b
							WHERE a.site_id = b.site_id
								   AND a.user_id = $user_id ";

$rs_user_site =$db->GetAll($sql_user_site)

?>
<script type="text/javascript" src="SpryAssets/SpryValidationConfirm.js"></script>
<link rel="stylesheet" type="text/css" href="./SpryAssets/SpryValidationConfirm.css" />

<script type="text/javascript" src="./modules/<?=$_GET['setModule']?>/<?=$_GET['setPage'];?>.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="ui-widget-content">
  <tr>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr>
          <td width="100%" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr class="ui-widget-header">
                <td height="22" align="left" valign="middle"><!--<a href="#">-->
                  
                  <div class="txt_header"> <b>&nbsp;
                    <?=$title;?>
                    </b></div>
                  
                  <!--</a>--></td>
                <td align="right" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="left" valign="middle"><div id="dialog-form-<?=$_GET['setPage'];?>">
                    <form id="form_profiles" name="form_profiles" method="post" action="">
                      <table width="100%" border="0" cellspacing="1" cellpadding="1">
                        <tr>
                          <td>&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                          <td valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="5%">&nbsp;</td>
                          <td width="43%" valign="top">ชื่อผู้ใช้งาน :<br />
                            <span id="sprytextfield1">
                            <label>
                              <input name="username" type="text" id="username" size="20" value="<?=$rs_profile['username']?>" />
                            </label>
                            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                          <td width="52%" valign="top">ตำแหน่งงาน :<br />
                          <ul type="square">
                              <li><?=$rs_profile['position_name']?> </li>
                          </ul>
                          </td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>รหัสผ่าน :<br />
                            <span id="sprytextfield2">
                            <label>
                              <input name="passwords" type="password" id="passwords" size="20" value="<?=base64_decode($rs_profile['passwords'])?>"/>
                            </label>
                            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span></span></td>
                          <td valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>ยืนยันรหัสผ่าน  :<br />
                            <span id="spryconfirm1">
                            <label for="repasswords"></label>
                            <input name="repasswords" type="password" id="repasswords" size="20" value="<?=base64_decode($rs_profile['passwords'])?>"/>
                            <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span></td>
                          <td rowspan="4" valign="top">กลุ่มผู้ใช้งาน :
                          <ul type="square">
							<?
							// แสดงกลุ่มผู้ใช้งาน
							for($i=0;$i<count($rs_user_group);$i++){						
									echo "<li>".$rs_user_group[$i]['group_name']."</li>";
							}
							?>
                          </ul></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>รหัสพนักงาน :<br />
                            <span id="sprytextfield4">
                            <label>
                              <input name="emp_code" type="text" id="emp_code" size="12" value="<?=$rs_profile['emp_code']?>"/>
                            </label>
                            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>เพศ  :
                            <input name="gender" type="radio" id="gender" value="M" <?=$rs_profile['gender']=='M'?'checked':''?> checked />
                            <label for="gender">ชาย
                              <input type="radio" name="gender" id="gender" value="F" <?=$rs_profile['gender']=='F'?'checked':''?>  />
                              หญิง</label></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>คำนำหน้า  :
                            <label for="prefix_id"></label>
                            <br />
                            <select name="prefix_id" id="prefix_id" class="input">
                              <?php
			  $sql_prefix= "SELECT * FROM tbl_prefix ORDER BY prefix_name";
			  $rs_prefix = $db->GetAll($sql_prefix);
			  genOptionSelect($rs_prefix,'prefix_id','prefix_name',$rs_profile['prefix_id']);
			  ?>
                            </select></td>
                          <td rowspan="6" valign="top">สังกัดไซต์งาน :<br />
                            <ul type="square">
							<?
							// แสดงค่ากลุ่มผู้ใช้งาน
							for($i=0;$i<count($rs_user_site);$i++){						
									echo "<li>".$rs_user_site[$i]['site_name']."</li>";
							}
							?>
                          </ul></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>ชื่อ  :<br />
                            <span id="sprytextfield5">
                            <label>
                              <input name="first_name" type="text" id="first_name" size="30" value="<?=$rs_profile['first_name']?>"/>
                            </label>
                            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>นามสกุล  :<br />
                            <span id="sprytextfield6">
                            <label>
                              <input name="last_name" type="text" id="last_name" size="30" value="<?=$rs_profile['last_name']?>" />
                            </label>
                            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>อีเมล์ :<br />
                            <span id="sprytextfield7">
                            <label>
                              <input name="email" type="text" id="email" size="30" value="<?=$rs_profile['email']?>"/>
                            </label>
                            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>เบอร์โทร  :<br />
                            <span id="sprytextfield3">
                            <label>
                              <input name="telephone" type="text" id="telephone" size="30" value="<?=$rs_profile['telephone']?>"  />
                            </label>
                            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td><?=MENU_SUBMIT?></td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                    </form>
                  </div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</td>
</tr>
</table>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"], minChars:6});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "passwords", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "email", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
</script> 