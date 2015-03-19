<?php 
require_once("../../includes/config.inc.php");
// Show Edit Value

if($_GET['doAction'] == "edit"){ 
	$docs_cate_code = $_GET['docs_cate_code'];
	$sql_edit = "SELECT * FROM tbl_docs_category WHERE docs_cate_id = $docs_cate_id";
	$rs_edit = $db->GetRow($sql_edit);
}
?>
<script language="javascript">
$(function(){			

			ajaxLoading();			
			
			//Button
				$('#btnReset ,#btnSave').button();
				
				 var options = { 
						url : './modules/Admin/docs_category_code.php',
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
						//$('#divMsgDiag').html(data).fadeIn();					
							$('#divMsgDiag').html('บันทึกข้อมูลเรียบร้อย !!').fadeIn();
						},// post-submit callback 
						 complete: function(){
							 $('#divMsgDiag').fadeOut(2000);							
							 setTimeout("window.location.reload(true)",2000);	
						 }
					}; 
				 
					// bind to the form's submit event 
					$('#form_docs_category').submit(function() { 
						$(this).ajaxSubmit(options); 
						return false; 
					}); 
					
					// ห้ามแก้ไขชื่อ
					if ($('#docs_cate_id').val() != ""){
						$('#docs_cate_code').attr('readonly', true);
						$("#docs_cate_code").css({'background-color':'#B8F5B1'});
					}
		
});
</script>

<form id="form_docs_category" name="form_docs_category" method="post" action="">
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="5%">&nbsp;</td>
      <td width="95%" valign="top">รหัสกลุ่มเอกสาร :<br />
        <span id="sprytextfield1">
        <label>
          <input name="docs_cate_code" type="text" id="docs_cate_code" size="20" value="<?=$rs_edit['docs_cate_code']?>" />
        </label>
        <span class="textfieldRequiredMsg">A value is required.</span></span> <span style="color:#3C0; font-size:11px"><i>*ระบบจะสร้าง Directory ตามชื่อนี้ </i></span>
        <label for="docs_cate_id"></label>
        <input type="hidden" name="docs_cate_id" id="docs_cate_id" value="<?=$rs_edit['docs_cate_id']?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>ชื่อกลุ่มเอกสาร :<br>
        <label for="docs_cate_name"></label>
        <span id="sprytextfield2">
        <input name="docs_cate_name" type="text" id="docs_cate_name" size="50"  value="<?=$rs_edit['docs_cate_name']?>" >
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
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
//-->
</script>