<?php
@session_start();
include('./includes/config.inc.php');

if($_SESSION['sess_user_id']) pageback('index.php','');

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?=SITE_NAME;?>
</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="css/<?=THEMES?>/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<link type="text/css" href="css/main.css" rel="stylesheet" />
<link type="text/css" href="css/<?=THEMES?>/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="css/tipsy.css" type="text/css" />


<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<!--<script type="text/javascript" src="js/jquery.ui.datepicker-th.js"></script>-->

<script src="./includes/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="./includes/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="./images/favicon.ico" />
<script language="javascript">
/******************************************/		
// Ajax loading image
function ajaxLoading(){
		// Show loading image
				$('#ajaxloading')
				.ajaxStart(function() {
				$(this).show();
				})
				.ajaxStop(function() {
				$(this).hide();
				});
		}



$(function(){
	
	ajaxLoading();
	
	$("#username").tipsy({trigger: "hover",gravity: "w"});	
	$("#password").tipsy({trigger: "hover",gravity: "w"});	
/*	$("#btn_recode").tipsy({trigger: "hover",gravity: "w"});
	$("#txt_captcha").tipsy({trigger: "hover",gravity: "s"});		
*/	
	$("#usename").focus();
	
	// Button
	$("#btn_login,#btn_reset").button();
	$("#btn_login,#btn_reset").css("cursor","pointer");
	
	/*getCodeImage();
	
	$("#btn_recode").click(function(){
		getCodeImage();
	});*/
		
	
	/******************************************/
		// Dialog Login		
	//	$("#dialog-login").dialog("destroy");	
		$("#dialog-login").dialog({
			autoOpen: true,
			draggable: false,
			resizable: false,
			closeOnEscape: false,
			disabled:true,
			height: 250,
			width: 380,
			modal: true,
			show: 'highlight',
			hide: 'fade',
			closeOnEscape: false,
			 open: function(event, ui) {
				  $(this).closest('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
				},
			close: function() {
                    //window.location.reload(true);
              }
		});		
		
	
	
	
	$('#btn_reset').click(function(){
			$("#dialog-login").dialog("open");
			
	});
	
	
		
// From Submit Login
		 var options = { 
						url : 'checkuser.php',
						type : 'post',
						data : {doAction : 'Access' },
						beforeSubmit: function(formData, jqForm, options){
						if (Spry) { // checks if Spry is used in your page
							var r = Spry.Widget.Form.validate(jqForm[0]); // validates the form
							if (!r)
								return r;
						}
					},
						success: function(data){
							if(data == "1"){
								setTimeout("window.location='index.php';",0);	
							}else{
								//$('#divMsgDiag').html(data).fadeIn();
								$('#ErrorMsg').show('bounce');
								$('#ErrorMsg').hide('clip');	
								
							}

						}
					}; 
				 
					// bind to the form's submit event 
					$('#frm_login').submit(function() { 
						$(this).ajaxSubmit(options); 
						return false; 
					}); 
	
	
	
});


/*function getCodeImage(){
	$("#imgCode").remove();
	$("#secuecode").after("<img id='imgCode' src=\"captcha.php?"+Math.random()+"\"/> ");
	$("#btn_recode").css("cursor","pointer");
}*/
</script>
</head>
<body>
<div id="dialog-login" title="Sign In...">
  <form name="frm_login" id="frm_login" method="post" action="">
    <table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
      <tr>
        <td><table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
            <tr>
              <td width="12%" rowspan="4" align="center" valign="top"><img src="images/login.png" width="128" height="128"></td>
              <td><div class="ui-widget" style="display:none" id="ErrorMsg">
                  <div class="ui-state-highlight ui-corner-all" style="padding: .01em;">
                    <p> &nbsp;<span class="ui-icon ui-icon-alert" style="float: left"></span> <strong>  ชื่อ/รหัสผ่าน ไม่ถูกต้อง !!</strong></p>
                  </div>
                </div></td>
            </tr>
            <tr>
              <td width="88%">Username&nbsp;:<br />
                <span id="sprytextfield1">
                <input name="username" type="text" id="username" title="กรอกชื่อผู้ใช้งาน" value="" size="20"/>
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td>Password&nbsp;:<br />
                <span id="sprytextfield2">
                <input name="password" type="password" id="password"  title="กรอกรหัสผ่าน" value="" size="20"/>
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
            </tr>
            <tr>
              <td height="31"><input type="submit" name="Submit" id="btn_login" value=" Sign In " />
                <span id='ajaxloading'>Loading..</span> <br/>&nbsp;
                </td>
            </tr>
                 <tr>
                   <td height="45" colspan="2" align="center" valign="bottom"> <hr width="100%" style="border-style:solid 1px; border-color:#eee; opacity:.4" >
  <div id="footer" style="text-align:right; width:99%" class="font-small"><?=SITE_NAME." ".COPYRIGHT?></div></td>
                 </tr>
        </table></td>
      </tr>
    </table>
  </form>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
</script>
</body>
</html>