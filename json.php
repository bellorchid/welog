<?php

	function listDir($dir)
	{
	    if(is_dir($dir))
	    {
	        if ($dh = opendir($dir))
	        {
	            while (($file = readdir($dh)) !== false)
	            {
	                if((is_dir($dir."/".$file)) && $file!="." && $file!="..")
	                {
	                   listDir($dir."/".$file."/");
	                }
	                else{
	                    if($file!="." && $file!="..")
						{	
							echo '"'.substr($dir,-9,8).'"'.":".'"';
	                        echo "http://welog.hduitsata.com/".$dir.$file.'"'.","."<br>";
	                    }
	                }	           
				}

	            closedir($dh);
	        }
	    }
	}
	//��ʼ����
	echo"{"."<br>";
	listDir("userimg/");
	echo"<br>"."}";
	
	return;
?>