<?php
// Title Menu from function.php
$title = title_menu($_GET['setPage']);

$sql = "SELECT * FROM tbl_configs";
$rs = $db->GetRow($sql);

?>
<script type="text/javascript" src="./modules/<?=$_GET['setModule']?>/<?=$_GET['setPage'];?>.js"></script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="ui-widget-content">
  <tr>
    <td>
          <table width="100%" border="0" cellspacing="1" cellpadding="2">
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
                        <form id="form_config" name="form_config" method="post" action="">
                          <table width="100%" border="0" cellspacing="1" cellpadding="1">
                            <tr>
                              <td>&nbsp;</td>
                              <td valign="top">&nbsp;</td>
                              <td valign="top">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="5%">&nbsp;</td>
                              <td width="9%" valign="top">ชื่อเว็บไซต์ :</td>
                              <td width="86%" valign="top"><span id="sprytextfield1">
                                <label>
                                  <input name="web_name" type="text" id="web_name" size="50" value="<?=$rs['website_name']?>" />
                          </label>
                                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>ภาษา :</td>
                              <td><label for="lang"></label>
                                <select name="lang" id="lang" class="input">
                                  <option value="th" <?=$rs['website_language'] == 'en' ? '' : 'selected';?>>ไทย</option>
                                  <option value="en" <?=$rs['website_language'] == 'en' ? 'selected' : '';?>>อังกฤษ</option>
                              </select></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>เลือกชุดตกแต่ง :</td>
                              <td><select name="theme" id="theme" class="input">
                              <?php
							  		  listComboBox($arr_theme , $rs['website_theme']);                              
							  ?>
                              </select></td>
                            </tr>
                            <tr>
                              <td height="49">&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><?=MENU_SUBMIT?></td>
                            </tr>
                          </table>
                        </form>
                      </div></td>
                  </tr>
                </table></td>
            </tr>
          </table>
        </td>
  </tr>
</table>
</td>
</tr>
</table>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
//-->
</script> 
