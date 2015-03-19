<?php
// Title Menu from function.php
$tbl = new dataTable();
$tbl->id = 'docs_upload';
$tbl->title = title_menu('docs_upload');
//$tbl->menu = MENU_ACTION;
$tbl->order = 5;
$tbl->module = 'Uploads';
$tbl->page = 'docs_upload';
$tbl->orderType = "desc";
$tbl->openTable();


$db->debug =0;

//show_session();

$user_id = $_SESSION['sess_user_id'];

// หาค่า Doc years
$sql_doc_years = "SELECT
							  DISTINCT(docs_years)
							FROM tbl_documents
							WHERE docs_cate_code IN(SELECT
													  a.docs_cate_code
													FROM tbl_docs_category a,
													  tbl_docs_auth b
													WHERE a.docs_cate_id = b.docs_cate_id
														AND b.group_id IN(SELECT
																			group_id
																		  FROM tbl_user_auth
																		  WHERE user_id = $user_id)
													GROUP BY a.docs_cate_code, a.docs_cate_name)
							ORDER BY docs_years DESC ";
$rs_doc_years = $db->GetAll($sql_doc_years);

// หาค่า Doc Group
/*
$sql_doc_group = "SELECT
								 docs_cate_code,
								 docs_cate_name
							FROM tbl_docs_category 
							ORDER BY docs_cate_name";
							*/
$sql_doc_group = "SELECT
							  a.docs_cate_code,
							  a.docs_cate_name
							FROM tbl_docs_category a,
							  tbl_docs_auth b
							WHERE a.docs_cate_id = b.docs_cate_id
								AND b.group_id IN(SELECT
													group_id
												  FROM tbl_user_auth
												  WHERE user_id = $user_id)
							GROUP BY a.docs_cate_code, a.docs_cate_name
							ORDER BY a.docs_cate_name";							
$rs_doc_group = $db->GetAll($sql_doc_group);

//ถ้ามีการเลือกให้ where ตามค่าที่เลือก ถ้าไม่ ให้เอาค่า docs_cate_code มา where
$get_docs_cate_code = $_GET['docs_cate_code'] ? $_GET['docs_cate_code'] : $rs_doc_group[0]['docs_cate_code'];

//ถ้ามีการเลือกให้ where ตามค่าที่เลือก ถ้าไม่ ให้เอาค่า docs_years มา where

if(!isset($_GET['docs_years']) || $_GET['docs_years'] == "null"){
	$get_docs_years =  $rs_doc_years[0]['docs_years'];
}else{
	$get_docs_years = $_GET['docs_years'];
}

//$docs_years = $_GET['docs_years'] ? $_GET['docs_years'] : $rs_doc_years[0]['docs_years'];


//$get_docs_years = $docs_years != 'null' ? $rs_doc_years[0]['docs_years'] :  $_GET['docs_years'];

// List Document
  $sql_list = "SELECT
			  a.*,
			  b.docs_cate_name
			FROM tbl_documents a,
			  tbl_docs_category b
			WHERE a.docs_cate_code = b.docs_cate_code
			AND a.docs_cate_code = '$get_docs_cate_code'
			AND a.docs_years = '$get_docs_years'
			ORDER BY a.docs_updatetime DESC";
$rs_list = $db->GetAll($sql_list);


?>
<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td width="54%" align="left" valign="middle">  Years : 
      <select name="sel_docs_years" id="sel_docs_years" class="input">
      
          <?php					  
		  			// $docs_years = isset($_GET['docs_years']) ? $_GET['docs_years'] :  ;
					  genOptionSelect($rs_doc_years,'docs_years','docs_years',$get_docs_years);
		  ?>
        </select>
    
     Modules :
      <label>
        <select name="sel_docs_cate_code" id="sel_docs_cate_code" class="input">
          <?php					  
					  genOptionSelect($rs_doc_group,'docs_cate_code','docs_cate_name',$_GET['docs_cate_code']);
		  ?>
        </select>
      </label></td>
    <td width="46%" align="right" valign="top"><?php //=MENU_ACTION?><div class='doAction'>
    <button> Upload File </button> <button>&nbsp;&nbsp;Edit&nbsp;&nbsp;</button> <button>Delete</button></div></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="display" id="<?=$tbl->id;?>">
  <thead>
    <tr>
      <th width="4%"  class="header_height">Action</th>
      <th width="17%">Documents name</th>
      <th width="28%">Descriptions</th>
      <th width="16%">Documents Owner</th>
      <th width="12%">Uploaded by</th>
      <th width="11%">Update time</th>
      <th width="7%"> Downloads</th>
      <th width="5%">Publish</th>
    </tr>
  </thead>
  <tbody>
    <?php for($i=0;$i<count($rs_list);$i++){ 

		$docs_filename = $rs_list[$i]['docs_filename'];
		$docs_cate_code = $rs_list[$i]['docs_cate_code'];
		$docs_id = $rs_list[$i]['docs_id'];
		$docs_desc = $rs_list[$i]['docs_desc'];
		$docs_owner = $rs_list[$i]['docs_owner'];
		$docs_updatetime = $rs_list[$i]['docs_updatetime'];
		$docs_uploadby = $rs_list[$i]['docs_uploadby'];
		$docs_downloads = $rs_list[$i]['docs_downloads'];
		$docs_publish = $rs_list[$i]['docs_publish'];
		$docs_years = $rs_list[$i]['docs_years'];
		
		
		
		
		//$filename = "./DOWNLOADS/".$docs_cate_code."/".iconv('TIS620' ,'UTF-8',$docs_filename);
		
		$arrPublish = array("Y" => array("icons" => "./images/on.gif",
														"title" => "เผยแพร่"),
									"N" => array("icons" => "./images/off.gif",
														"title" => "ไม่เผยแพร่"));					
		
		$publish_img = $arrPublish[$docs_publish]['icons'];
		$publish_title = $arrPublish[$docs_publish]['title'];
		
		$filePath = "./".UPLOADS_DIR."/".$docs_cate_code."/".$docs_years."/".$docs_filename;
		
	?>
    <tr>
      <td align="center" valign="top"><label for="selID"><input type="radio" name="selID" id="selID_<?=$docs_id?>" value="<?=$docs_id?>" <?=$i== 0 ?'checked':''?>/></label></td>
      <td valign="top"><?=show_icon($docs_filename);?> <a href="<?=$filePath;?>" class="downloads" id="<?=$docs_id;?>" target="_blank"><?=$docs_filename;?></a></td>
      <td valign="top"><?=$docs_desc;?></td>
      <td valign="top"><?=$docs_owner;?></td>
      <td valign="top"><?=$docs_uploadby;?></td>
      <td align="center" valign="top"><?=showdateTimeThai($docs_updatetime);?></td>
      <td align="center" valign="top"><?=$docs_downloads;?></td>
      <td align="center" valign="top"><img src="<?=$publish_img?>" title="<?=$publish_title?>" class="tooltips" style="cursor:pointer"></td>
    </tr>
    <?php } // End For ?>
  </tbody>
</table>
<?php 
	$tbl->closeTable(); 
?>
<div id="dialog-form-<?=$tbl->page;?>" title="<?=$tbl->title?>" style="display:none"></div>
<div id="dialog-confirm" title="Comfirm!!">ยืนยันการลบข้อมูล ?</div>
<input type="hidden" name="hidRadio" id="hidRadio" value="<?=$rs_list[0]['docs_id']?>" />
<div id="test"></div>