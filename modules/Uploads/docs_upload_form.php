<?php 
session_start();
require_once("../../includes/config.inc.php");

//show_get();

$user_id = $_SESSION['sess_user_id'];

if($_GET['doAction'] == "edit"){ 
	$docs_id = $_GET['docs_id'];
	$sql_edit = "SELECT *
					  FROM tbl_documents 
					WHERE	docs_id = '$docs_id'";
	$rs_edit = $db->GetRow($sql_edit);
	
	$filePath = "./".UPLOADS_DIR."/".$rs_edit['docs_cate_code']."/".$rs_edit['docs_years']."/".$rs_edit['docs_filename'];
	
	$docs_years = $rs_edit['docs_years'];
	
}else{
	if($_GET['docs_years'] <> ""){
		$docs_years =$_GET['docs_years']	;
	}else{
		$docs_years = (date('Y')+543)	;
	}
}

$docs_cate_code = $_GET['doAction'] == "new" ? $_GET['docs_cate_code'] : $rs_edit['docs_cate_code'];


?>
<script language="javascript">
$(function(){			
			
			//$(".tooltips").tipsy({gravity: 's'});
			
			$("img").css({'cursor':'pointer'});
			
			ajaxLoading();			
			
			//Button
				$('#btnReset ,#btnSave').button();
				
				 var options = { 
						url : './modules/Uploads/docs_upload_code.php',
						type : 'post',
						data : {doAction : '<?=$_GET['doAction']?>' , docs_id : '<?=$docs_id?>'},
						beforeSubmit: function(formData, jqForm, options){
						if (Spry) { // checks if Spry is used in your page
							var r = Spry.Widget.Form.validate(jqForm[0]); // validates the form
							/*if (!r)
								return r;
						}
					},*/
					check_file();
					
					if($("#docs_filename").val() != '' && r == true){
								
									return true;
								
							}else{
								r = false;
								return false;	
							}			
						}
					},
						success: function(data){	
						//alert(data);					
							//$('#divMsgDiag').html(data).fadeIn();
							$('#divMsgDiag').html('บันทึกข้อมูลเรียบร้อย !!').fadeIn();
						},// post-submit callback 
						 complete: function(){
							$('#divMsgDiag').fadeOut(2000);							
							//setTimeout("window.location.reload(true)",2000);
							setTimeout("window.location = '?setModule=Uploads&setPage=docs_upload&docs_cate_code='+$('#docs_cate_code').val()+'&docs_years='+$('#docs_years').val();",2000);		
							
						 }
					}; 
				 
					// bind to the form's submit event 
					$('#form_docs_uploads').submit(function() { 
					
						//var chkfile = $("#docs_filename").val();
						//if(chkfile != ""){
							$(this).ajaxSubmit(options); 
						return false; 
						//}
					}); 
	
	
	$("#img_delete").button({
				icons: {
					primary: 'ui-icon-trash'
				},		
				}).click(function(){
				if(confirm('ต้องการลบไฟล์ ใช่ หรือ ไม่ ?')){
					var iNum = $('#docs_id').val();	
					$.get('./modules/Uploads/docs_upload_code.php'	,		
							{ doAction : 'delete_file' , docs_id : iNum  },						
									function(data) {	
									
											//$('#sss').html(data);																					
										
											$.get('./modules/Uploads/docs_upload_form.php',		
											{ doAction : 'edit' , docs_id : iNum  },						
													function(data) {													
														$("#dialog-form-docs_upload").html(data);					
													}
											);	
											
													
									}
							)					
				
				}
			});
				
				
				
				
				
				function check_file(){
					var file_val = $("#docs_filename").val();
					if(file_val == ""){
						$("#file_validate").html("A value is required.");
						$("#docs_filename").css({'background-color':'#FF9F9F'});
					}else{
						$("#file_validate").hide();
						$("#docs_filename").css({'background-color':'#B8F5B1'});
					}
				}
		
		

});
</script>



<form action="" method="post" enctype="multipart/form-data" name="form_docs_uploads" id="form_docs_uploads">
  <table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td>&nbsp;</td>
      <td width="96%" valign="top">เอกสาร ปี พ.ศ. :<br>
        <label for="docs_years"></label>
        <label for="docs_years"></label>
        <span id="sprytextfield1">
        <input name="docs_years" type="text" id="docs_years" size="6" maxlength="4" value="<?=$docs_years;?>">
        <span class="textfieldRequiredMsg">A value is required.</span></span>
        <label for="docs_years_old"></label>
        <input type="hidden" name="docs_years_old" id="docs_years_old" value="<?=$rs_edit['docs_years'];?>"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td valign="top">หมวดหมู่เอกสาร :<br />
        <span id="spryselect1">
        <select name="docs_cate_code" id="docs_cate_code" class="input">
          <?php
		  $sql_docs_type = "SELECT
									  a.docs_cate_code,
									  a.docs_cate_name
									FROM tbl_docs_category a,
									  tbl_docs_auth b
									WHERE a.docs_cate_id = b.docs_cate_id
										AND b.group_id IN(SELECT
															group_id
														  FROM tbl_user_auth
														  WHERE user_id = $user_id)
									GROUP BY a.docs_cate_code, a.docs_cate_name
									ORDER BY a.docs_cate_name";
		  $rs_docs_type = $db->GetAll($sql_docs_type);
		  genOptionSelect($rs_docs_type,'docs_cate_code','docs_cate_name',$docs_cate_code);
		  ?>
        </select>
        <span class="selectRequiredMsg">Please select an item.</span></span>
        <input type="hidden" name="docs_cate_code_old" id="docs_cate_code_old" value="<?=$docs_cate_code;?>"></td>
    </tr>
   
 <?php
 	if($rs_edit['docs_filename'] ==""){ 
 
 ?>  
    <tr>
      <td>&nbsp;</td>
      <td>เลือกไฟล์ :<br />
        <label for="fileupload"></label>
        <input type="file" name="docs_filename" id="docs_filename" class="required" />
        <span style="color:#3C0; font-size:11px"><i>* ขนาดไฟล์ไม่เกิน <strong><?php echo ini_get( 'upload_max_filesize' ); ?></strong></i> </span>&nbsp;<span id="file_validate" style="color:#CC3333"></span></td>
    </tr>
    <?php }else{ ?>
    <tr>
      <td height="36">&nbsp;</td>
      <td><?=show_icon($rs_edit['docs_filename']);?> <a href="<?=$filePath;?>" target="_blank"><?=$rs_edit['docs_filename'];?></a> <!--<img src="./images/icons-delete.gif" id="img_delete" align="absmiddle" class="tooltips" title="ลบไฟล์">-->&nbsp;<span id="img_delete" class="tooltips" title="ลบไฟล์">ลบไฟล์</span>
      <input name="docs_filename" type="hidden" id="docs_filename" value="<?=$rs_edit['docs_filename']?>">
      <label for="is_exists"></label>
      <input name="is_exists" type="hidden" id="is_exists" value="1"></td>
    </tr>
    <?php
	}
	?>
    <tr>
      <td width="4%">&nbsp;</td>
      <td valign="top">รายะเอียดเพิ่มเติม :<br />
        <span id="sprytextarea1">
        <textarea name="docs_desc" cols="70" rows="4" id="docs_desc" placeholder="เช่น ความหมายของเอกสาร,หน่วยงานที่รับผิดชอบ,ที่มา,เบอร์ติดต่อ ฯลฯ"><?=$rs_edit['docs_desc']?></textarea>
      <span class="textareaRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td height="40">&nbsp;</td>
      <td valign="middle">เจ้าของเอกสาร :<br>
        <span id="sprytextfield3">
        <input name="docs_owner" type="text" id="docs_owner" value="<?=$rs_edit['docs_owner'];?>" size="60" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td height="40">&nbsp;</td>
      <td valign="middle">ชื่อผู้อัพโหลด :<br />
        <span id="sprytextfield2">
        <label>
          <input name="docs_uploadby" type="text" id="docs_uploadby" value="<?=$_GET['doAction'] == 'edit' ?   $rs_edit['docs_uploadby'] : $_SESSION['sess_name'];?>" size="60" style="background-color:#B8F5B1"  />
        </label>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    </tr>
    <tr>
      <td height="40">&nbsp;</td>
      <td valign="middle">สถานะการเอกสาร :<br>
        <label for="docs_publish"></label>
        <select name="docs_publish" id="docs_publish">
        
        
          <option value="Y" <?=$rs_edit['docs_publish'] =="Y" ? "selected" : "";	?>>เผยแพร่</option>
          <option value="N" <?=$rs_edit['docs_publish'] =="N" ? "selected" : "";	?>>ไม่เผยแพร่</option>
      </select></td>
    </tr>
    <tr>
      <td height="47">&nbsp;</td>
      <td valign="middle"><?=MENU_SUBMIT?>
        <label for="docs_id"></label>
      <input name="docs_id" type="hidden" id="docs_id" value="<?=$rs_edit['docs_id']?>"></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur", "change"]});
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {validateOn:["change", "blur"]});
//-->
</script> 
<div id="sss"></div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur", "change"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur", "change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur", "change"]});
</script>
