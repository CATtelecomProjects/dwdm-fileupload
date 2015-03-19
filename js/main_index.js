$(function(){
		
			ajaxLoading();
		
		// Tooltips tipsy({gravity: 'n'}); // nw | n | ne | w | e | sw | s | se
		$('#txt_search').tipsy({gravity: 'e'});
		
		$(".tooltips").tipsy({gravity: 's'});
		
/******************************************/		
		// Accordio
		$("#accordion").accordion({ header: "h3" });
/******************************************/		
	// Datepicker
		$('#datepicker').datepicker({
		showWeek: true,
		showButtonPanel: true				
		});
		


	// Check menu Auth
		var ck = $('#chkMenuAuth').val();
		if(ck == 0){
			
			var msg = "<div id='dialog-alert' title='Warning..' style='padding: 0 .7em;color:red;text-align:center'><br><p><h2><img src='images/iconError.gif' align='absmiddle'><strong > Authorize not allow!!</strong></h2></p><p><br><a href='index.php' id='dialog_link' class='ui-state-default ui-corner-all'><span class='ui-icon ui-icon-circle-close'></span> OK </a></p></div>";
			
			$("body").append(msg);
			
			$("#divPage").html("");
			
			// Dialog		
				$("#dialog-alert").dialog({
					autoOpen: false,
					height: 180,
					width: 350,
					modal: true,
			        close: function(event, ui) { location.href = 'index.php' }
					});
			
			
			$('#dialog-alert').dialog('open');
				return false;		
		
		}
		
		

			// Check data if no data disabled edit,delete button
		var chkLen = $('#hidRadio').length;
		if(chkLen > 0){
			// Set Disable Button
			if($("#hidRadio").val() == ""){
					$( ".doAction button:eq( 1 ) , button:eq( 2 )" ).prop( "disabled", true );
			}
		}


// For Update stat from download file
			
			$('.downloads').click(function(){
					var docs_id = $(this).attr('id');
					$.get('downloads.php?docs_id='+docs_id , function(data){
						//$('#aaa').html(data);
					});
			});
			
	
		
		
							
});
/******************************************/		





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

		