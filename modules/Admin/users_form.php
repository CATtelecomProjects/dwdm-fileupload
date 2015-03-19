<?php 
require_once("../../includes/config.inc.php");
// Show Edit Value

if($_GET['doAction'] == "edit"){ 
	$user_id = $_GET['user_id'];
	$sql_edit = "SELECT  user_id ,username, password, first_name, last_name FROM tbl_users WHERE user_id = '$user_id';";
	$rs_edit = $db->GetRow($sql_edit);
}

?>
<script language="javascript">
$(function(){			

				ajaxLoading();
			
			//Button
				$('#btnReset ,#btnSave').button();
						
				 var options = { 
						url : './modules/Admin/users_code.php',
						type : 'post',
						data : {doAction : '<?=$_GET['doAction']?>' , user_id : '<?=$user_id?>'},
						beforeSubmit: function(formData, jqForm, options){
						if (Spry) { // checks if Spry is used in your page
							var r = Spry.Widget.Form.validate(jqForm[0]); // validates the form
							if (!r)
								return r;
						}
					},
						success: function(data){	
						//alert(data);					
							$('#divMsgDiag').html(data).fadeIn();
							$('#divMsgDiag').html('บันทึกข้อมูลเรียบร้อย !!').fadeIn();
						},// post-submit callback 
						 complete: function(){
							$('#divMsgDiag').fadeOut(2000);							
							setTimeout("window.location.reload(true)",2000);	
						 }
					}; 
				 
					// bind to the form's submit event 
					$('#form_users').submit(function() { 
						$(this).ajaxSubmit(options); 
						return false; 
					}); 
		
});
</script>



<form id="form_users" name="form_users" method="post" action="">
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="4%">&nbsp;</td>
      <td width="54%" valign="top">Username :<br />
        <span id="sprytextfield1">
        <label>
          <input name="username" type="text" id="username" size="20" value="<?=$rs_edit['username']?>" />
        </label>
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td width="42%" rowspan="4" valign="top">กลุ่มผู้ใช้งาน :<br />
        <select name="user_group[]" size="4" multiple="multiple" id="user_group">
          <?php
			// ถ้าเลือกแก้ไขให้ slect group_id ใน tbl_user_auth
			  if($_GET['doAction']=='edit'){
				$sql_group = "SELECT  a.group_id,  a.group_name, b.group_id   AS group_id_chk,  b.user_id
									FROM tbl_user_group a
										 LEFT JOIN tbl_user_auth b
										   ON a.group_id = b.group_id
											 AND b.user_id = $user_id 
									ORDER BY a.group_name";
				$rs_group = $db->GetAll($sql_group);
				 for($i=0;$i<count($rs_group);$i++){
					 $group_id = $rs_group[$i]['group_id'];
					 	$sel = $group_id ==  $rs_group[$i]['group_id_chk'] ? 'selected' : '';
					 
						echo "<option value='$group_id' $sel>".$rs_group[$i]['group_name']."</option>\n";
				 }
				
			  }else{
					  $sql_group = "SELECT * FROM tbl_user_group ORDER BY group_name";
					  $rs_group = $db->GetAll($sql_group);
					  genOptionSelect($rs_group,'group_id','group_name');
			  }
			  ?>
        </select>
        <br />
      <span class="font-small">*กด Ctrl เพื่อเลือกค่าเป็นช่วงข้อมูล</span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Password :<br />
        <span id="sprytextfield2">
        <label>
          <input name="password" type="password" id="password" size="20" value="<?=base64_decode($rs_edit['password'])?>"/>
        </label>
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Confirm Password  :<br />
        <span id="spryconfirm1">
        <label for="repasswords"></label>
        <input name="repasswords" type="password" id="repasswords" size="20" value="<?=base64_decode($rs_edit['password'])?>"/>
        <span class="confirmRequiredMsg">A value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>ชื่อผู้ใช้งาน  :<br />
        <span id="sprytextfield5">
        <label>
          <input name="first_name" type="text" id="first_name" size="40" value="<?=$rs_edit['first_name']?>"/>
        </label>
        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="top">&nbsp;</td>
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
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"], minChars:6});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "password", {validateOn:["blur"]});
</script> 