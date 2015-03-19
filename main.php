<?php
$sess_site_id = $_SESSION['sess_site_id'];
// All JS call file js/main_index.js

$db->debug=false;

?>
<script type="text/javascript">
			$(function(){
				// Accordion
				$("#accordion").accordion({ header: "h3" });
				
				/************************************/
				$('img').css('cursor','pointer');
				
				$('.view').tipsy({gravity: 's'});
				$('.manage').tipsy({gravity: 's'});	
				
				
			});
</script>

<table width="100%" border="0" cellpadding="0" cellspacing="2" class="ui-widget-content">
  <tr>
    <td valign="top"><div id="accordion">
<?php
 // เอกสารสร้างใหม่ รอการอนุมัติ
$chk_group_app =  chk_group('1,3'); // ตรวจสอบกลุ่มว่าเป็น Approve หรือไม่
if($chk_group_app){
		
		$rs_new_wait = docs_request_approve('N');
		$row_new = count($rs_new_wait);
		
		// เอกสารแก้ไข รอการอนุมัติ
		$rs_edit_wait = docs_request_approve('E');
		$row_edit = count($rs_edit_wait);
		
		$req_new_total = ($row_new+$row_edit);
	   ?>
       
        <h3><a href="#">เอกสารรอการอนุมัติ (<u><?=$req_new_total?></u>)</a></h3>
        <div>
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td width="50%" valign="top"><b>+ เอกสารสร้างใหม่ (<u><?=$row_new;?></u>)</b>
                <ul type="square">
                  <?php			
			if(count($rs_new_wait)>0){
				for($i=0;$i<count($rs_new_wait);$i++){
					$req_id = $rs_new_wait[$i]['req_id'];
				 echo " <li><a href='#' class='request' id='$req_id' ref='req_new'>".$rs_new_wait[$i][docs_name]."</a> <span class='font-small'>(<i>โดย</i> ".$rs_new_wait[$i][fullname]." <i>เมื่อ</i> ".$rs_new_wait[$i][docs_requestdate].")</span></li>";
				}
			}else{
				echo " <li><i>ไม่มีคำขอ !!</i></li>";
			}
			?>
                </ul></td>
              <td width="50%" valign="top"><b>+ เอกสารขอแก้ไข (<u><?=$row_edit;?></u>)</b>
                <ul type="square">
                  <?php			
			if(count($rs_edit_wait)>0){
				for($i=0;$i<count($rs_edit_wait);$i++){
				 echo " <li><a href='#' class='request' id='$req_id' ref='req_edit'>".$rs_edit_wait[$i][docs_name]."</a> <span class='font-small'>(<i>โดย</i> ".$rs_eidt_wait[$i][fullname]." <i>เมื่อ</i> ".$rs_edit_wait[$i][docs_requestdate].")</span></li>";
				}
			}else{
				echo " <li><i>ไม่มีคำขอ !!</i></li>";
			}
			?>
                </ul></td>
            </tr>
          </table>
        </div>
        
<?php } // End ตรวจสอบกลุ่มว่าเป็น Approve หรือไม่ ?>        

<?php
// เอกสารรอการจัดทำ (Document Control)
$chk_group_app =  chk_group('1,2'); // ตรวจสอบกลุ่มว่าเป็น Document Control หรือไม่
if($chk_group_app){
	
			
		// เอกสารจัดทำำใหม่
		$rs_do_new = docs_request_do('N');
		$row_do_new = count($rs_do_new);
		
		// เอกสารแก้ไข
		$rs_do_edit = docs_request_do('E');
		$row_do_edit = count($rs_do_edit);
		
		$row_do = ($row_do_new+$row_do_edit);

?>
        <h3><a href="#">เอกสารรอการจัดทำ (<u><?=$row_do;?></u>)</a></h3>
        <div>
          <table width="100%" border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td width="50%" valign="top"><b>+ เอกสารสร้างใหม่ (<u><?=$row_do_new;?></u>)</b>
                <ul type="square">
                  <?php			
			if(count($rs_do_new)>0){
				for($i=0;$i<count($rs_do_new);$i++){
					$docs_id = $rs_do_new[$i]['docs_id'];
				 echo " <li>";
				 echo "<img src='./images/icon-view.png' title='ดูรายละเอียดเอกสาร' align='absmiddle' name='$docs_id' class='view'/> ";				 
				 echo "<a href='#' class='manage' id='$docs_id' ref='do_new' title='จัดทำเอกสาร'>".$rs_do_new[$i][docs_code]." : ".$rs_do_new[$i][docs_name]."</a> <span class='font-small'><br>(<i>โดย</i> ".$rs_do_new[$i][fullname]." <i>เมื่อ</i> ".$rs_do_new[$i][docs_requestdate].")</span>";
				 
				 echo "</li>";
				}
			}else{
				echo " <li><i>ไม่มีคำขอ !!</i></li>";
			}
			?>
                </ul></td>
              <td width="50%" valign="top"><b>+ เอกสารขอแก้ไข (<u><?=$row_do_edit;?></u>)</b>
                <ul type="square">
                  <?php			
			if(count($rs_do_edit)>0){
				for($i=0;$i<count($rs_do_edit);$i++){
					$docs_id = $rs_do_edit[$i]['docs_id'];
				 echo " <li><a href='#' class='manage' id='$docs_id' ref='do_edit'>".$rs_do_edit[$i][docs_name]."</a> <span class='font-small'>(<i>โดย</i> ".$rs_do_edit[$i][fullname]." <i>เมื่อ</i> ".$rs_do_edit[$i][docs_requestdate].")</span></li>";
				}
			}else{
				echo " <li><i>ไม่มีคำขอ !!</i></li>";
			}
			?>
                </ul></td>
            </tr>
          </table>
        </div>
        <?php } // End ตรวจสอบกลุ่มว่าเป็น Document Control หรือไม่ ?>        
<h3><a href="#">เอกสารที่เกี่ยวข้อง (3)</a></h3>
        <div>
          <ul type="square">
            <li>xxx-xxx-xxx-xxx : test1 <span class="font-small">(30-10-2010 12:34 pm)</span></li>
            <li>xxx-xxx-xxx-xxx : test2 <span class="font-small">(30-10-2010 12:34 pm)</span></li>
            <li>xxx-xxx-xxx-xxx : test3 <span class="font-small">(30-10-2010 12:34 pm)</span></li>
          </ul>
        </div>
        
      </div></td>
  </tr>
</table>
<div id="dialog-form-approve" title="อนุมัติเอกสาร" style="display:block"></div>
<div id="dialog-form-docs_control" title="ควบคุมเอกสาร &gt; จัดทำเอกสาร" style="display:block"></div>
<div id="view_docs_detail" title="แสดงรายละเอียดเอกสาร" style="display:block"></div>
