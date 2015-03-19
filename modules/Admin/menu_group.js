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
					$('#dialog-form-menu_group').dialog('open');	
					$.get('./modules/Admin/menu_group_form.php',		
							{ doAction : 'new'   },						
									function(data) {													
										$("#dialog-form-menu_group").html(data);					
									}
							)			
						return false;
				}).next().button({
				icons: {
					primary: 'ui-icon-disk'
				}			
				}).click( function() {
					$('#dialog-form-menu_group').dialog('open');
					var iNum = $('#hidRadio').val();		
						$.get('./modules/Admin/menu_group_form.php',		
							{ doAction : 'edit' , mgroup_id : iNum  },					
									function(data) {													
										$("#dialog-form-menu_group").html(data);					
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
				//$("#dialog-form-menu_group").dialog("destroy");	
				$("#dialog-form-menu_group").dialog({
					autoOpen: false,
					height: 320,
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
               			 url:"./modules/Admin/menu_group_code.php",  
						data: { action: 'delete' , mgroup_id : iNum  },  
						async:false,  
						type : 'get',
						success:function(getData){  
						//alert(getData);
								if(getData == 1){
									$("#dialog-confirm").dialog('close');
									setTimeout("window.location.reload(true)",500);	
								}else{
									//alert('มีข้อผิดพลาด!!');
									$('#dialog-confirm').html('<font color=red>มีข้อผิดพลาด!!</font>');
								} // End if
							 
							}  
						});						
				}
			}
		});
/******************* End Delete ********************/
			
		
				
	   });

