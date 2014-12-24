<?php
	header("Content-type:text/html;charset=utf-8");
	session_start();
	require('mysql.php');
	
	$conn = connect();
	function getdata($mydir){
		if (false != ($handle = opendir ( $mydir ))) {
        $i=0;
        while (false !== ($file = readdir ( $handle )) ) {
                $i++;
        }
        //关闭句柄
        closedir ( $handle );
		
		return $i-2;
		}
	}
	if(isset($_COOKIE['usercookies'])){
		if($_FILES["file"]["error"]==0){
			$errorcode = $_FILES["file"]["error"];
			$filename = $_FILES["file"]["name"];
			$filetype = $_FILES["file"]["type"];
			$filesize = ($_FILES["file"]["size"] / 1024);
			$filetemp = $_FILES["file"]["tmp_name"];
			echo $filename . $filesize . $filetemp . $filetype .'<br>';
			$dir ="userimg/".$_COOKIE['usercookies'];
			//echo getdata($dir);
			//echo $dir;
			if($filetype =="image/jpg"||$filetype == "image/png"||$filetype == "image/bmg"||$filetype == "image/gif"||$filetype=="image/jpeg"){
			
				if($filesize > 2048){
					if($filesize <= 4096){
					
					}
					imagepng($filetemp,$filename,2);
				}elseif(is_dir($dir)){
					$newname = getdata($dir);
					$filename = $newname.".jpg";
					move_uploaded_file($filetemp,$dir."/".$filename);
				}else{
				//echo"no dir";
					mkdir("userimg/".$_COOKIE['usercookies']);
					move_uploaded_file($_COOKIE['usercookies'],"userimg/");
					$newname = getdata($dir);
					$filename = $newname.".jpg";
					move_uploaded_file($filetemp,$dir."/".$filename);
				}
				$userdes = $dir."/".$filename;
				$moredes = "HTTP://128.128.0.26/welog/".$userdes;
				$sql = "update user set user_img = '{$userdes}' where user_name = '{$_COOKIE['usercookies']}'";
			
				$res = mysqli_query($conn,$sql);
				date_default_timezone_set('PRC');
				$showtime=date('Y-m-d H:i:s',time());
				$sql2 = "insert into image (user_name,image_src,image_time) values('$_COOKIE[usercookies]','$moredes','$showtime')";
			
				$res2 = mysqli_query($conn,$sql2);
			
			//var_dump($moredes);
				header("location:index.php");
			}else{
				echo"<script>alert('文件格式貌似不被允许哟！')</script>";
				echo"<script>window.location.href='index.php'</script>";
			}
		}else{
			switch($_FILES['file']['error']){
				case '1':
				case '2': echo "<script>alert('文件大小超过限制')</script>"."<script>window.location.href='index.php'</script>";
				case '3': echo "<script>alert('文件上传不完整')</script>"."<script>window.location.href='index.php'</script>";
				case '4': echo "<script>alert('请选择上传文件')</script>"."<script>window.location.href='index.php'</script>";
			}
		}
	}else{
		echo"<script>alert('Please login!')</script>";
		echo"<script>window.location.href='login.php'</script>";
	}
	
?>