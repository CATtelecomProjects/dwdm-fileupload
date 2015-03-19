<?php
	header('Content-Type: text/html; charset=utf-8');

	include('includes/config.inc.php');	

	// นับจำนวนครั้งที่ Download
	$sqlCountDownload = "update tbl_documents set docs_downloads = docs_downloads + 1 where docs_id= ".$_GET['docs_id'];
	$rsCountDownload = $db ->  Execute($sqlCountDownload);
	
	exit;
	
	// หาชื่อไฟล์เพื่อทำการ Download
	$sqldownload = "select docs_filename,docs_cate_code,docs_years from tbl_documents where docs_id = ".$_GET['docs_id'];
	$rsdownload = $db -> GetRow($sqldownload);	
		
	//downloadfile("./uploads_dir/FI/".iconv('UTF-8','TIS620',$rsdownload['docs_filename']));
	
	$filePath = "./".UPLOADS_DIR."/".$rsdownload['docs_cate_code']."/".$rsdownload['docs_years']."/".iconv('UTF-8','TIS620',$rsdownload['docs_filename']);
	
	downloadFiles($filePath);
	
	
	
	// function for download file
	function downloadFiles( $fullPath ){ 
				  // Must be fresh start 
				  if( headers_sent() ) 
					die('Headers Sent'); 
				
				  // Required for some browsers 
				  if(ini_get('zlib.output_compression')) 
					ini_set('zlib.output_compression', 'Off'); 

				  // File Exists? 
				  if( file_exists($fullPath) ){ 
					
					// Parse Info / Get Extension 
					$fsize = filesize($fullPath); 
				 	//$path_parts = pathinfo($fullPath); 
						
					//echo date( "D d M Y g:i A", filemtime($fullPath)) ;
				
				
					header("Pragma: public"); // required 
					header("Expires: 0"); 
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
					header("Cache-Control: private",false); // required for certain browsers 
					header("Content-Type: application/force-download"); 
					header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" ); 
					header("Content-Transfer-Encoding: binary"); 
					header("Content-Length: ".$fsize); 
					ob_clean(); 
					flush(); 
					readfile( $fullPath ); 
				
				  } else 
					//die('File Not Found'); 
					pageback('-1' ,'File Not Found !!');
				} 
	
	exit;
	

?>