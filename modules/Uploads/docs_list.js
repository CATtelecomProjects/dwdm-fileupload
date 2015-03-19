// JavaScript Document
$(function(){
			
				var group_id = $('#group_id').val();

				// เลือกเมนู Select Modules
				$('#sel_docs_cate_code').change(function(){
					window.location = '?group_id='+group_id+'&docs_cate_code='+$(this).val()+'&docs_years='+$('#sel_docs_years').val();
				});
				
				// เลือกเมนู Select Years
				$('#sel_docs_years').change(function(){
					window.location = '?group_id='+group_id+'&docs_cate_code='+$('#sel_docs_cate_code').val()+'&docs_years='+$(this).val();
				});
			
		
	   });

