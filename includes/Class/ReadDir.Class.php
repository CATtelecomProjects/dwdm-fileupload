<?php
class ReadDir{
	
	var $dir;
	var $years;
	var $img_ext = array('png','gif','jpg','jepg','bmp');
	
#=====================================================
function get_year(){

		$dir_year = scandir($this->dir ,1);
		
		foreach($dir_year as $year){
			
			$chk_dir  = is_dir($this->dir.'/'.$year);
			if($chk_dir === true && $year != "." && $year != ".."){
				$arrYear[] = $year;	
				
			}
		}
		return $arrYear;
}



#=====================================================
function scan_Dir() {
	$path = $this->dir.'/'.$this->years;
    $arrfiles = array();
    if (is_dir($path)) {
        if ($handle = opendir($path)) {
            chdir($path);
            while (false !== ($file = readdir($handle))) { 
                if ($file != "." && $file != "..") { 
                    if (is_dir($file)) { 
                        $arr = $this->scan_Dir($file);
                        foreach ($arr as $value) {
                            $arrfiles[] = $path."/".$value;
                        }
                    } else {
                        $arrfiles[] = $path."/".$file;
                    }
                }
            }
            chdir("../");
        }
        closedir($handle);
    }
    return $arrfiles;
}
#=====================================================

function scanDir() {
	$path = $this->dir;
    $arrfiles = array();
    if (is_dir($path)) {
        if ($handle = opendir($path)) {
            chdir($path);
            while (false !== ($file = readdir($handle))) { 
                if ($file != "." && $file != "..") { 
                    if (is_dir($file)) { 
                        $arr = $this->scan_Dir($file);
                        foreach ($arr as $value) {
                            $arrfiles[] = $path."/".$value;
                        }
                    } else {
                        $arrfiles[] = $path."/".$file;
                    }
                }
            }
            chdir("../");
        }
        closedir($handle);
    }
    return $arrfiles;
}
#=====================================================	
}// End Class
?>