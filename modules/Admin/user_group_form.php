<?php 
require_once("../../includes/config.inc.php");
// Show Edit Value

if($_GET['doAction'] == "edit"){ 
	$group_id = $_GET['group_id'];
	$sql_edit = "SELECT * FROM tbl_user_group WHERE group_id = '$group_id';";
	$rs_edit = $db->GetRow($sql_edit);
}
?>
<script language="javascript">
$(function(){			

			ajaxLoading();			
			
			//Button
				$('#btnReset ,#btnSave').button();
				
				 var options = { 
						url : './modules/Admin/user_group_code.php',
						type : 'post',
						data : {doAction : '<?=$_GET['doAction']?>' , group_id : '<?=$group_id?>'},
						beforeSubmit: function(formData, jqForm, options){
						if (Spry) { // checks if Spry is used in your page
							var r = Spry.Widget.Form.validate(jqForm[0]); // validates the form
							if (!r)
								return r;
						}
					},
						success: function(data){	
						//alert(data);					
							$('#divMsgDiag').html('บันทึกข้อมูลเรียบร้อย !!').fadeIn();
						},// post-submit callback 
						 complete: function(){
							 $('#divMsgDiag').fadeOut(2000);							
							 setTimeout("window.location.reload(true)",2000);	
						 }
					}; 
				 
					// bind to the form's submit event 
					$('#form_user_group').submit(function() { 
						$(this).ajaxSubmit(options); 
						return false; 
					}); 
		
});
</script>


  <form id="form_user_group" name="form_user_group" method="post" action="">
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td width="5%">&nbsp;</td>
        <td width="95%" valign="top">ชื่อกลุ่มผู้ใช้งาน :<br />
          <span id="sprytextfield1">
          <label>
            <input name="group_name" type="text" id="group_name" size="40" value="<?=$rs_edit['group_name']?>" />
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
      </tr>
    </table>
  </form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
//-->
</script>