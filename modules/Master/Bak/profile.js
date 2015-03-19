// JavaScript Document
$(function(){

					ajaxLoading();			

			//Button
				$('#btnReset ,#btnSave').button();
			
				$('#doAction').val('Save');
					
					var options = { 					 
						url : './modules/Master/profile_code.php',
						data : {doAction : 'Save'} ,
						type : 'post',		
						beforeSubmit: function(formData, jqForm, options){
						if (Spry) { // checks if Spry is used in your page
							var r = Spry.Widget.Form.validate(jqForm[0]); // validates the form
							if (!r)
								return r;
						}
					},				
						success: function(data){
							//$('#divMsgDiag').html(data).fadeIn();							
							$('#divMsgDiag').html(' บันทึกข้อมูลเรียบร้อย !!').fadeIn();							
							//$('#msg').html(data).fadeIn();
						},// post-submit callback 
						 complete: function(){
							 $('#divMsgDiag').fadeOut(2000);
							//setTimeout("window.location.reload(true)",2000);						
						 }
					}; 
				 
					// bind to the form's submit event 
					$('#form_profiles').submit(function() { 
						$(this).ajaxSubmit(options); 
						return false; 
					}); 
					
});
				
				
			


