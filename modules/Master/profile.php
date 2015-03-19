<?php

// Title Menu from function.php
$title = title_menu($_GET['setPage']);


$user_id = $_SESSION['sess_user_id'];

if(!$_SESSION['sess_user_id']) return;

// แสดงรายละเอียด
$sql_profile = "SELECT
						 *
						 
						FROM tbl_users 
						WHERE user_id =  $user_id";
							
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
<script type="text/javascript" src="./includes/SpryAssets/SpryValidationConfirm.js"></script>
<link rel="stylesheet" type="text/css" href="./includes/SpryAssets/SpryValidationConfirm.css" />

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
                          <input name="username" type="text" class="ui-state-disabled" id="username" value="<?=$rs_profile['username']?>" size="20" readonly="readonly" />
                          <input type="hidden" name="user_id" id="user_id" value="<?=$user_id?>" /></td>
                          <td width="52%" rowspan="2" valign="top">กลุ่มผู้ใช้งาน :
                            <ul type="square">
                              <?php
							// แสดงกลุ่มผู้ใช้งาน
							for($i=0;$i<count($rs_user_group);$i++){						
									echo "<li>".$rs_user_group[$i]['group_name']."</li>";
							}
							?>
                          </ul></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>รหัสผ่านเดิม :<br />
                            <span id="spryconfirm2">
                            <label for="old_password"></label>
                            <input name="old_password" type="password" id="old_password" tabindex="2" size="20" />
                          <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span>
                          <input type="text"  name="hid_old_password" id="hid_old_password"  value="<?=base64_decode($rs_profile['password'])?>" style="display:none"/></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>รหัสผ่านใหม่ :<br />
                            <span id="sprytextfield2">
                            <label>
                              <input name="new_passwords" type="password" id="new_passwords" size="20"/>
                            </label>
                            <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span></span></td>
                          <td valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>ยืนยันรหัสผ่าน  :<br />
                            <span id="spryconfirm1">
                            <label for="repasswords"></label>
                            <input name="repasswords" type="password" id="repasswords" size="20"/>
                            <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span></td>
                          <td rowspan="2" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>รายละเอียดผู้ใช้งาน  :<br />
                          <input name="first_name" type="text"  id="first_name" value="<?=$rs_profile['first_name']?>" size="30"/></td>
                          <td rowspan="2" valign="top">&nbsp;</td>
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
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"], minChars:6});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "new_passwords", {validateOn:["blur"]});
var spryconfirm2 = new Spry.Widget.ValidationConfirm("spryconfirm2", "hid_old_password", {validateOn:["blur"]});
</script> 