// JavaScript Document
$(function(){
	
			ajaxLoading();
	
	// กำหนดค่าตอนเลือก Radio เพื่อส่งค่าไปแก้ไข / ลบ
		 		$('input:radio').click(function(){
					$("#hidRadio").val($(this).val()) ;						
				});
			
				$(".doAction button:first").button({
				icons: {
					primary: 'ui-icon-plusthick'
				}				  
				}).click( function() {
					$('#dialog-form-users').dialog('open');			
					$.get('./modules/Admin/users_form.php',		
							{ doAction : 'new'   },						
									function(data) {													
										$("#dialog-form-users").html(data);					
									}
							)				
						return false;
				}).next().button({
				icons: {
					primary: 'ui-icon-disk'
				}				
				}).click( function() {
					$('#dialog-form-users').dialog('open');
					var iNum = $('#hidRadio').val();		
						$.get('./modules/Admin/users_form.php',		
							{ doAction : 'edit' , user_id : iNum  },					
									function(data) {													
										$("#dialog-form-users").html(data);					
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
				//$("#dialog-form-users").dialog("destroy");	
				$("#dialog-form-users").dialog({
					autoOpen: false,
					height: 290,
					width: 600,
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
               			 url:"./modules/Admin/users_code.php",  
						data: { action: 'delete' , user_id : iNum  },  
						async:false,  
						type : 'get',
						success:function(data){  
						$("#dialog-confirm").html('ลบข้อมูลเรียบร้อย!!');
							$("#dialog-confirm").dialog('close');
							setTimeout("window.location.reload(true)",500);	 
							}  
						});						
				}
			}
		});
/******************* End Delete ********************/
		
		// เลือกเมนู
				$('#group_id').change(function(){
					window.location = '?setModule=Admin&setPage=users&group_id='+$(this).val();
				});
		
		
	   });

