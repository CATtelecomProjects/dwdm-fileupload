<?php

	class Auth {
		
	var $user_id;	
	var $db;
	
		
		// function ในการตรวจสอบสิทธิ์การเข้าถึงหน้าเพจ
		public function checkPageAuth($menu_file){
				$sql = "	SELECT
								  COUNT(*) AS count_menu
								FROM tbl_menu_auth a,
								  tbl_menu b
								WHERE a.menu_id = b.menu_id
									AND b.menu_file = '$menu_file'
									AND a.group_id IN(SELECT
														group_id
													  FROM tbl_user_auth
													  WHERE user_id = $this->user_id) ";
				
				$result = $this->db->GetRow($sql);
						if($result['count_menu'] > 0){
							return 1;	
						}else{
							return 0;
						}				
				
			} // End function
			
			// ฟังก์ชั่นในการหาหมวดหมู่ตามสิทธิ์
			public function getKnowledgeCate(){
					$sql = "SELECT
								  DISTINCT b.*
								FROM tbl_knowledge_auth a
								   JOIN tbl_knowledge_cate b
									ON a.knowledge_cate_id = b.id
								WHERE group_id IN(SELECT
													group_id
												  FROM tbl_user_auth
												  WHERE user_id = $this->user_id)
								AND active = 'Y' 
								ORDER BY b.menu_order";
					return 	$result = $this->db->GetAll($sql);
			} // End function 
		
		
	} // End Class

?>