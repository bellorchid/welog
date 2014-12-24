<?php
	header("Content-type:text/html; charset = utf-8");
	session_start();
	require('mysql.php');
	$conn = connect();
	$username = trim($_POST['user']);
	$password = MD5(trim($_POST['pwd']));
	$authcode = strtolower($_POST['authcode']);
	$myauthcode = strtolower($_SESSION['authcode']);
	if($authcode==$myauthcode){
		$sql = "select user_id from user where user_name='{$username}' and user_pwd='{$password}'";
		$row=mysqli_query($conn,$sql);
		$res = mysqli_fetch_array($row);
		print_r($res);
		if($res){
			$ref = $_SERVER['HTTP_REFERER'];
			$_SESSION['name']= $username;
			$_SESSION['id'] = $res['user_id'];
			setcookie("usercookies",$username,time()+60*60*24*30);
			header("location:index.php");
			
			
			//print_r($_SESSION['id']);
		}
		else{
			//echo"<script>alert('error')<??/script>";
            setcookie("loginError" ,"Username or password is wrong.");
			echo"<script>window.location.href='login.php'</script>";
		}
	}else{
		setcookie("loginError","Authcode Error");
		header("location:login.php");
	}
?>