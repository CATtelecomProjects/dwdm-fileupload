// JavaScript Document
$(function(){
			
			// กำหนดค่าตอนเลือก Radio เพื่อส่งค่าไปแก้ไข / ลบ
		 		$('input:radio').click(function(){
					$("#hidRadio").val($(this).val()) ;						
				});
			
			//Button
				$('#btnReset ,#btnSave').button();
			
				$(".doAction button:first").button({
				icons: {
					primary: 'ui-icon-plusthick'
				}			
				}).click( function() {
					$('#dialog-form-docs_category').dialog('open');	
					$.get('./modules/Admin/docs_category_form.php',		
							{ doAction : 'new'   },						
									function(data) {													
										$("#dialog-form-docs_category").html(data);					
									}
							)				
						return false;
				}).next().button({
				icons: {
					primary: 'ui-icon-disk'
				}			
				}).click( function() {
					$('#dialog-form-docs_category').dialog('open');
					var iNum = $('#hidRadio').val();		
						$.get('./modules/Admin/docs_category_form.php',		
							{ doAction : 'edit' , docs_cate_id : iNum  },					
									function(data) {													
										$("#dialog-form-docs_category").html(data);					
									}
							)		
						return false;
				}).next().button({
				icons: {
					primary: 'ui-icon-trash',					
				}
				}).click( function() {
					$('#dialog-confirm').dialog('open');
						return false;
				}).parent()
					//.buttonset();	
					
					// Dialog		
				//$("#dialog-form-docs_category").dialog("destroy");	
				$("#dialog-form-docs_category").dialog({
					autoOpen: false,
					height: 200,
					width: 450,
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
               			 url:"./modules/Admin/docs_category_code.php",  
						data: { action: 'delete' , docs_cate_id : iNum  },  
						async:false,  
						type : 'get',
						success:function(getData){  
						//alert(getData);
									if(getData == '1'){
										$("#dialog-confirm").dialog('close');
										
									}else{
										//alert('มีข้อผิดพลาด!!');
										$('#dialog-confirm').html('<font color=red>มีข้อผิดพลาด!! ไม่สามารถลบได้ เนื่องมาจากมีไฟล์ภายใต้กลุ่มเอกสารดังกล่าว</font>' );
											
									} // End if
									
									setTimeout("window.location.reload(true)",3000);	
							}  // End function : success
						});					
				}
			}
		});
/******************* End Delete ********************/
			
		
		
	   });

