// JavaScript Document
$(function(){
			
				
				
				// กำหนดค่าตอนเลือก Radio เพื่อส่งค่าไปแก้ไข / ลบ
		 		$('input:radio').click(function(){
					$("#hidRadio").val($(this).val()) ;						
				});


				// เลือกเมนู Select Modules
				$('#sel_docs_cate_code').change(function(){
					window.location = '?setModule=Uploads&setPage=docs_upload&docs_cate_code='+$(this).val()+'&docs_years='+$('#sel_docs_years').val();
				});
				
				// เลือกเมนู Select Years
				$('#sel_docs_years').change(function(){
					window.location = '?setModule=Uploads&setPage=docs_upload&docs_cate_code='+$('#sel_docs_cate_code').val()+'&docs_years='+$(this).val();
				});
			
			//Button
				$('#btnReset ,#btnSave').button();
			
				$(".doAction button:first").button({
				icons: {
					primary: 'ui-icon-circle-arrow-n'
				}				
				}).click( function() {
					$('#dialog-form-docs_upload').dialog('open');	
					var iNum = $('#sel_docs_cate_code').val();	
					$.get('./modules/Uploads/docs_upload_form.php',		
							{ doAction : 'new' , docs_cate_code : iNum , docs_years : $("#sel_docs_years").val()  },						
									function(data) {													
										$("#dialog-form-docs_upload").html(data);					
									}
							)					
						return false;
				}).next().button({
				icons: {
					primary: 'ui-icon-disk'
				}			
				}).click( function() {
					$('#dialog-form-docs_upload').dialog('open');
					var iNum = $('#hidRadio').val();		
						$.get('./modules/Uploads/docs_upload_form.php',		
							{ doAction : 'edit' , docs_id : iNum  },					
									function(data) {													
										$("#dialog-form-docs_upload").html(data);					
									}
							)		
						return false;
				}).next().button({
				icons: {
					primary: 'ui-icon-trash',					
				}
				}).click( function() {
					$('#dialog').dialog('open');
					$('#dialog-confirm').dialog('open');
						return false;
				}).parent()
					//.buttonset();	
					
					// Dialog		
				//$("#dialog-form-docs_upload").dialog("destroy");	
				$("#dialog-form-docs_upload").dialog({
					autoOpen: false,
					height: 480,
					width: 640,
					modal: true
		});
		

/*******************  Delete ********************/					
		//$("#dialog-confirm").dialog("destroy");	
		$("#dialog-confirm").dialog({
			autoOpen: false,
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				'ยกเลิก': function() {
					$(this).dialog('close');
				},
				'ลบ': function() {
					var iNum = $('#hidRadio').val();
					$.ajax({ // ใช้ ajax ด้วย jQuery ดึงข้อมูลจากฐานข้อมูล  
               			 url:"./modules/Uploads/docs_upload_code.php",  
						data: { doAction: 'delete' , docs_id : iNum  },  
						async:false,  
						type : 'get',
						success:function(getData){  
						//alert(getData);
									if(getData == '1'){
										$("#dialog-confirm").dialog('close');
										setTimeout("window.location.reload(true)",500);	
									}else{
										//alert('มีข้อผิดพลาด!!');
										$('#dialog-confirm').html('<font color=red>มีข้อผิดพลาด!!</font>' + getData);
									} // End if
							}  // End function : success
						});						
				}
			}
		});
		
/******************* End Delete ********************/
			
		
			
		
	   });

