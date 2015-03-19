// JavaScript Document
$(function(){
			
				// กำหนดค่าตอนเลือก Radio เพื่อส่งค่าไปแก้ไข / ลบ
		 		$('input:radio').click(function(){
					$("#hidRadio").val($(this).val()) ;						
				});


				// เลือกเมนู
				$('#mgroup_id').change(function(){
					window.location = '?setModule=Admin&setPage=menu&mgroup_id='+$(this).val();
				});
			
			//Button
				$('#btnReset ,#btnSave').button();
			
				$(".doAction button:first").button({
				icons: {
					primary: 'ui-icon-plusthick'
				}			
				}).click( function() {
					$('#dialog-form-menu').dialog('open');	
					$.get('./modules/Admin/menu_form.php',		
							{ doAction : 'new'   },						
									function(data) {													
										$("#dialog-form-menu").html(data);					
									}
							)					
						return false;
				}).next().button({
				icons: {
					primary: 'ui-icon-disk'
				}			
				}).click( function() {
					$('#dialog-form-menu').dialog('open');
					var iNum = $('#hidRadio').val();		
						$.get('./modules/Admin/menu_form.php',		
							{ doAction : 'edit' , menu_id : iNum  },					
									function(data) {													
										$("#dialog-form-menu").html(data);					
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
				//$("#dialog-form-menu").dialog("destroy");	
				$("#dialog-form-menu").dialog({
					autoOpen: false,
					height: 340,
					width: 470,
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
               			 url:"./modules/Admin/menu_code.php",  
						data: { action: 'delete' , menu_id : iNum  },  
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
							}  // End function : success
						});						
				}
			}
		});
		
/******************* End Delete ********************/
			
		
	   });

